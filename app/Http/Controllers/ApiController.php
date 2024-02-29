<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Hash;
use Session;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class ApiController extends Controller
{
    public function iisLogin($username, $password, $id_number, $email , $token)
    {
        // http://127.0.0.1:8000/api/login/iis/ebcreencia/$2y$10$TWs46asy8HUoJWUeDyhcEODCIES96vmFSYRsYQRXCB0lDyWRaLw0a/EMBCO-202104667/eric.creencia25@gmail.com/466760e6a6104f0cf
        $check = DB::table('users')->where([
            ['email', $email],
            ['password', $password],
            ['iis_token', $token],
        ])->first();


        if(!empty($check))
        {
            Session::put('username', $username);
            Session::put('password', $password);
            Session::put('id_number', $id_number);
            Session::put('email', $email);
            Session::put('token', $token);

            return redirect('iis-login');

        } else {
            Session::put('username', $username);
            Session::put('password', $password);
            Session::put('id_number', $id_number);
            Session::put('email', $email);
            Session::put('token', $token);

            return redirect('iis-confirmation');

        }
    }

    public function createIISaccount(Request $request)
    {
        $username = $request->username;
        $password = $request->password;
        $id_number = $request->id_number;
        $email = $request->email;
        $remember_token = $request->iis_token;
        $now = new \DateTime();

        $data = DB::table('users')->insert([
            'id_number' => $id_number,
            'username' => $username,
            'password' => $password,
            'iis_token' => $remember_token,
            'email' => $email,
            'type' => 1,
            'active' => 1,
            'created_at' => $now->format('Y-m-d H:i:s'),
            'updated_at' => $now->format('Y-m-d H:i:s'),
        ]);


        return 'success';

    }

    public function loginIISaccount(Request $request)
    {
        $username = Session::get('username');
        $password = $request->password; 
        $id_number = Session::get('id_number');
        $email = Session::get('email');
        $iis_token = Session::get('token');

        if(auth()->attempt(array('email' => $email, 'password' => $password, 'iis_token' => $iis_token, 'active' => 1)))
        {
            $now = new \DateTime();

            $data = DB::table('users')
            ->where('id', auth()->user()->id)
            ->update([
                'last_seen' => $now->format('Y-m-d H:i:s')
            ]);

            if (auth()->user()->type == 'admin') {
                return redirect()->route('admin.home');
            }else if (auth()->user()->type == 'manager') {
                return redirect()->route('manager.home');
            }else{
                return redirect()->route('home');
            }
        } else {
            Session::put('username', $username);
            Session::put('password', $password);
            Session::put('id_number', $id_number);
            Session::put('email', $email);
            Session::put('token', $token);

            return redirect('iis-confirmation');
        }
    }
}
