<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;
use PDF;
use File;

use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function sendMessage(Request $request)
    {
        $now = new \DateTime();

        $data = DB::table('concerns')
        ->orderBy('id', 'DESC')
        ->first();

        $tix = 'Tix-' . $now->format('Y-m') . "-" . str_pad($data->id + 1, 8, "0", STR_PAD_LEFT);

        $data = DB::table('concerns')->insert([
            'ticket_number' => $tix,
            'company_name' => $request['company-name'],
            'client_name' => $request['client-name'],
            'email' => $request['e-mail'],
            'online_system' => $request['online-system'],
            'subject' => $request['subject'],
            'message' => $request['message'],
            'seen' => 0,
            'created_date' => $now->format('Y-m-d H:i:s')
        ]);

        if($data) {

            DB::table('logs')->insert([
                'ticket_number' => $tix,
                'action' => 'sent a message',
                'function' => 'client concern',
                'name' => $request['client-name'],
                'user_type' => 0,
                'date' => $now->format('Y-m-d'),
                'time' => $now->format('H:i:s')
            ]);

        }
    }

    public function getConcernList(Request $request) 
    {
        $newArr = [];

        if(Auth::user()->ecc == 1) {
            array_push($newArr, 'ECC');
        }

        if(Auth::user()->cnc == 1) {
            array_push($newArr, 'CNC');
        }

        if(Auth::user()->eiais == 1) {
            array_push($newArr, 'EIAIS');
        }

        if(Auth::user()->opms == 1) {
            array_push($newArr, 'OPMS');
        }

        if(Auth::user()->crs == 1) {
            array_push($newArr, 'CRS');
        }

        if(Auth::user()->smr == 1) {
            array_push($newArr, 'SMR');
        }

        if(Auth::user()->cmr == 1) {
            array_push($newArr, 'CMR');
        }

        if(Auth::user()->iis == 1) {
            array_push($newArr, 'IIS');
        }

        if(Auth::user()->hazwaste == 1) {
            array_push($newArr, 'HAZWASTE');
        }

        $data = DB::table('concerns')
        ->whereIn('online_system', $newArr)
        ->orderBy('id', 'DESC')
        ->get();

        return DataTables::of($data)
            ->addColumn('ticket_num', function ($data) {
                $details = '<em><b><p class="text">' . $data->ticket_number . '</a></b></em>';
                return $details;
            })
            ->addColumn('company_name', function ($data) {
                $details = $data->company_name;
                return $details;
            })
            ->addColumn('client_company', function ($data) {
                $details = $data->client_name;
                return $details;
            })
            ->addColumn('email', function ($data) {
                $details = $data->email;
                return $details;
            })
            ->addColumn('online_system', function ($data) {
                $details = $data->online_system;
                return $details;
            })
            ->addColumn('subject', function ($data) {
                $details = $data->subject;
                return $details;
            })
            ->addColumn('message', function ($data) {
                $details = '<span id="span">' . $data->message . '</span>';
                return $details;
            })
            ->addColumn('attachment', function ($data) {
                $details = '<button type="button" class="btn btn-outline-secondary"><i class="fas fa-paperclip"></i></button>';

                return $details;
            })
            ->addColumn('created_date', function ($data) {
                $details = '<span id="span">' . date("d M. Y", strtotime($data->created_date)) . '</span>';

                return $details;
            })
            ->addColumn('resolved_action', function ($data) {
                $details = '<span id="span">' . $data->action . '</span>';
                return $details;
            })
            ->addColumn('resolved_date', function ($data) {
                $details = isset($data->resolved_date) ? '<span id="span">' . date("d M. Y", strtotime($data->resolved_date)) . '</span>' : '';
                return $details;
            })
            ->addColumn('action', function ($data) {
                $details1 = '<button class="form-control" onclick="view('.$data->id.')">
                <i class="fa-solid fa-arrow-right-to-bracket"></i>
                </button>';

                if($data->seen == 0) {
                    $details = '<button type="button" class="btn btn-dark" title="view" onclick="view('.$data->id.', 0)" id="view-concern-'.$data->id.'" name="view-concern"><i class="fa-solid fa-arrow-right-to-bracket"></i></button>';
                } else {
                    $details = '<button type="button" class="btn btn-outline-secondary" title="view" onclick="view('.$data->id.', 1)" id="view-concern-'.$data->id.'" name="view-concern"><i class="fa-solid fa-arrow-right-to-bracket"></i></button>';
                }
                
                

                return $details;
            })
            ->rawColumns(['ticket_num', 'company_name', 'client_company', 'email', 'online_system', 'subject', 'message', 'action', 'attachment', 'created_date', 'resolved_action', 'resolved_date'])
            ->make(true);
    }

    public function getTicketData(Request $request)
    {
        $data = DB::table('concerns')
            ->where('id', $request->id)
            ->first();

        return $data;
    }

    public function resolveTicket(Request $request)
    {
        $now = new \DateTime();
        $data = DB::table('concerns')
        ->where('id', $request->id)
        ->update([
            'action' => $request->action,
            'resolved' => 1,
            'resolved_date' => $now->format('Y-m-d H:i:s'),
        ]);

        if($data) {
            DB::table('logs')->insert([
                'ticket_number' => $request->ticket,
                'action' => 'resolved',
                'function' => 'support action',
                'name' => Auth::user()->name,
                'user_id' => Auth::user()->id,
                'user_type' => 1,
                'date' => $now->format('Y-m-d'),
                'time' => $now->format('H:i:s')
            ]);
        }
    }

    public function updateSeen(Request $request)
    {
        $data = DB::table('concerns')
        ->where('id', $request->id)
        ->update([
            'seen' => 1
        ]);

        return 'Success';
    }

    public function getTimeline(Request $request)
    {
        $id = isset($request->user_id) ? $request->user_id : '';
        $now = new \DateTime();

        if(!empty($id)) {

            $data = DB::table('logs')
            ->select('date')
            ->where('user_id', $id)
            ->orderBy('date', 'DESC')
            ->groupBy('date')
            ->get();

        } else {

            $data = DB::table('logs')
            ->select('date')
            ->orderBy('date', 'DESC')
            ->groupBy('date')
            ->get();

        }

        $newArr = [];
        foreach ($data as $key => $value) {
            $newData = [];

            if($now->format('Y-m-d') == date("Y-m-d", strtotime($value->date))) {
                $date = 'Today';
            } else {
                $date = date("d M. Y", strtotime($value->date));
            }

            $newData['date'] =  $date;

            if(!empty($id)) {

                $data1 = DB::table('logs')
                ->where('date', $value->date)
                ->where('user_id', $id)
                ->orderBy('time', 'DESC')
                ->get();

            } else {

                $data1 = DB::table('logs')
                ->where('date', $value->date)
                ->orderBy('time', 'DESC')
                ->get();

            }

            $newData['data'] = $data1;

            $newArr[] = $newData;
        }

        return $newArr;
    }

    public function uploadFile(Request $request)
    {
        $now = new \DateTime();
        
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf,jpeg,png,jpg,gif,csv,docx'
            // |max:2048
        ]);

        $file = $request->file('file');

        if ($validator->fails()) {
            $rtrn['success'] = 0;
            $rtrn['message'] = $validator->errors()->first('file'); // Error response

            return $rtn;

        } else {
            if ($request->file('file')) {
                $file = $request->file('file');
                $filename = $file->getClientOriginalName();

                // $filename = $NewGUID;

                // filesize
                $size = $file->getSize();
                $filesize = $size * 0.001;
                // File extension
                $extension = $file->getClientOriginalExtension();

                $path = public_path('Files/Upload/'. $now->format('Y-m-d') . '/');
                // $savedFiles = $pdf->saveAs($urlSavePDF);

                if (!File::exists($path)) {
                    File::makeDirectory($path, $mode = 0755, true, true);

                    // File upload location
                    $location = 'Files/Upload/'. $now->format('Y-m-d') . '/';

                    // // Upload file
                    $file->move($location, $filename . '.' . $extension);

                } else {
                    $location = 'Files/Upload/'. $now->format('Y-m-d') . '/';

                    $file->move($location, $filename . '.' . $extension);
                }

                // File path
                // $filepath = public_path('files/'.$NewGUID.'.'.$extension);
                $filepath = 'Files/Upload/'. $now->format('Y-m-d') . '/' . $filename . '.' . $extension;

                // Response
                $rtrn['success'] = 1;
                $rtrn['message'] = 'Uploaded Successfully!';

                $data['directory'] = public_path();
                $data['file_name'] = $filename;
                $data['file_path'] = $filepath;
                $data['file_extension'] = $extension;
                $data['file_size_in_kb'] = $filesize;
                $data['created_date'] = $now->format('Y-m-d H:i:s');

                $save = DB::table('upload_file_raw')->insert($data);

                if ($save) {
                    $rtrn['success'] = 1;
                    $rtrn['message'] = 'File uploaded.';
                }
            } else {
                // Response
                $rtrn['success'] = 2;
                $rtrn['message'] = 'File not uploaded.';
            }
        }
    }
}
