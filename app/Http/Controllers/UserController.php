<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getUserList(Request $request) 
    {

        $data = DB::table('users')
            ->get();

        return DataTables::of($data)
            ->addColumn('name', function ($data) {
                $details = '<em><b><p class="text">' . $data->name . '</a></b></em>';
                return $details;
            })
            ->addColumn('user_type', function ($data) {
                if($data->type == 1) {
                    $type = 'support';
                } else {
                    $type = 'admin';
                }
                $details = $type;
                return $details;
            })
            ->addColumn('email', function ($data) {
                $details = $data->email;
                return $details;
            })
            ->addColumn('last_activity', function ($data) {
                $details = date("M d, Y h:i a", strtotime($data->last_seen));
                return $details;
            })
            ->addColumn('status', function ($data) {
                if($data->active == 1) {
                    $status = '<span class="badge badge-success">Active</span>';
                } else {
                    $status = '<span class="badge badge-danger">Deactive</span>';
                }
                
                return $status;
            })
            ->addColumn('action', function ($data) {
                $details = '<button type="button" class="btn btn-outline-secondary" onclick="editAccount('.$data->id.')"><i class="fa-solid fa-user"></i></button>';

                $details .= '<button type="button" class="btn btn-outline-secondary" onclick="viewAccount('.$data->id.')"><i class="fa-solid fa-arrow-right-to-bracket"></i></button>';

                $details .= '<button type="button" class="btn btn-outline-secondary" onclick="resetPassword('.$data->id.')"><i class="fa-solid fa-key"></i></button>';

                return $details;
            })
            ->rawColumns(['name', 'user_type', 'email','action', 'status'])
            ->make(true);
    }

    public function getAcount(Request $request)
    {
        $data = DB::table('users')
        ->where('id', $request->id)
        ->first();

        return $data;
    }


    public function resetPassword(Request $request)
    {
        $now = new \DateTime();

        $data = DB::table('users')
        ->where('id', $request->id)
        ->update([
            'password' => Hash::make('0123456789*'),
            'updated_at' => $now->format('Y-m-d H:i:s')
        ]);

        $existing = DB::table('users')
        ->where('id', $request->id)
        ->first();

        if($data) {
            DB::table('logs')->insert([
                'ticket_number' => '',
                'action' => 'reset password of ' . $existing->name . ' into default password.',
                'function' => 'manage accounts',
                'name' => Auth::user()->name,
                'user_id' => Auth::user()->id,
                'user_type' => 2,
                'date' => $now->format('Y-m-d'),
                'time' => $now->format('H:i:s')
            ]);
        }

        if($data) {
            return 'Success';
        }
    }

    public function changePassword(Request $request)
    {
        $now = new \DateTime();
        $old_password = $request->old_password;
        $new_password = $request->new_password;
        $confirm_password = $request->confirm_password;
        $user_id = Auth::user()->id;

        $existingPass = DB::table('users')
        ->where('id', $user_id)
        ->first();

        if(Hash::check($old_password , $existingPass->password ) )
        {
            $data = DB::table('users')
            ->where('id', $user_id)
            ->update([
                'password' => Hash::make($confirm_password),
                'updated_at' => $now->format('Y-m-d H:i:s')
            ]);

            $existing = DB::table('users')
            ->where('id', $user_id)
            ->first();

            if($data) {
                DB::table('logs')->insert([
                    'ticket_number' => '',
                    'action' => 'changed password.',
                    'function' => 'manage accounts',
                    'name' => Auth::user()->name,
                    'user_type' => 1,
                    'user_id' => Auth::user()->id,
                    'date' => $now->format('Y-m-d'),
                    'time' => $now->format('H:i:s')
                ]);
            }

            if($data) {
                return 'Success';
            }
        } else {
            return "old password doesn't match"; 
            

        }


        
    }

    public function updateOnlineSystem(Request $request)
    {

        $now = new \DateTime();

        $data = DB::table('users')
        ->where('id', $request->id)
        ->update([
            $request->type => $request->value,
            'updated_at' =>  $now->format('Y-m-d H:i:s')
        ]);

        if($data) {
            DB::table('logs')->insert([
                'ticket_number' => '',
                'action' => 'update user online system coverage - ' . $request->type . ' into ' . $request->value,
                'function' => 'manage accounts',
                'name' => Auth::user()->name,
                'user_id' => Auth::user()->id,
                'user_type' => 2,
                'date' => $now->format('Y-m-d'),
                'time' => $now->format('H:i:s')
            ]);
        }

        if($data) {
            return 'Success';
        }
    }

    public function addUser(Request $request)
    {
        $now = new \DateTime();

        if($request->user_id == 0 ) {

            $middle_name = isset($request->middle_name) ? $request->middle_name . ' ' : '';
            $name = Str::ucfirst($request->first_name) . ' ' . Str::ucfirst($middle_name)  . Str::ucfirst($request->last_name);

            $existing = DB::table('users')->where([
                'email' => $request->email
            ])->first();

            if(empty($existing)){

                try {
                    $data = DB::table('users')->insert([
                        'first_name' => Str::ucfirst($request->first_name),
                        'middle_name' => Str::ucfirst($request->middle_name),
                        'last_name' => Str::ucfirst($request->last_name),
                        'name' => $name,
                        'type' => $request->user_type,
                        'email' => $request->email,
                        'id_number' => $request->emb_id,
                        'active' => $request->user_status,
                        'password' => Hash::make('0123456789*'),
                        'created_at' => $now->format('Y-m-d H:i:s'),
                        'updated_at' => $now->format('Y-m-d H:i:s')
                    ]);

                    if($data) {

                        DB::table('logs')->insert([
                            'ticket_number' => '',
                            'action' => 'insert user ' . $name . ' into the system.',
                            'function' => 'manage accounts',
                            'name' => Auth::user()->name,
                            'user_id' => Auth::user()->id,
                            'user_type' => 2,
                            'date' => $now->format('Y-m-d'),
                            'time' => $now->format('H:i:s')
                        ]);

                    }

                    return 'success';

                } catch (\Throwable $e) {
                    report($e);

                    return false;
                    
                }

                
            } else {
                return 'Existing Email';
            }

        } else {

            $middle_name = isset($request->middle_name) ? $request->middle_name . ' ' : '';
            $name = Str::ucfirst($request->first_name) . ' ' . Str::ucfirst($middle_name)  . Str::ucfirst($request->last_name);

            try {
                $data = DB::table('users')
                ->where('id', $request->user_id)
                ->update([
                    'first_name' => Str::ucfirst($request->first_name),
                    'middle_name' => Str::ucfirst($request->middle_name),
                    'last_name' => Str::ucfirst($request->last_name),
                    'name' => $name,
                    'type' => $request->user_type,
                    'email' => $request->email,
                    'id_number' => $request->emb_id,
                    'active' => $request->user_status,
                    'updated_at' => $now->format('Y-m-d H:i:s')
                ]);

                if($data) {

                        DB::table('logs')->insert([
                            'ticket_number' => '',
                            'action' => 'update user details of ' . $name,
                            'function' => 'manage accounts',
                            'name' => Auth::user()->name,
                            'user_id' => Auth::user()->id,
                            'user_type' => 2,
                            'date' => $now->format('Y-m-d'),
                            'time' => $now->format('H:i:s')
                        ]);

                    }

                return 'success';

            } catch (\Throwable $e) {
                    report($e);

                    return false;
                    
                }

        }

        

    }
}
