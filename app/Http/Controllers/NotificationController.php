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

class NotificationController extends Controller
{
    public function getNotifications(Request $request)
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

        $data = [];

        $count = DB::table('concerns')
        ->whereIn('online_system', $newArr)
        ->where('seen', 0)
        ->count();

        array_push($data, $count);

        $date = DB::table('concerns')
        ->select('created_date')
        ->whereIn('online_system', $newArr)
        ->where('seen', 0)
        ->orderBy('id', 'DESC')
        ->first();

        array_push($data, $date);


        $resolved = DB::table('concerns')
        ->whereIn('online_system', $newArr)
        ->where('resolved', null)
        ->count();

        array_push($data, $resolved);

        $resolveddate = DB::table('concerns')
        ->select('created_date')
        ->whereIn('online_system', $newArr)
        ->where('resolved', null)
        ->orderBy('id', 'DESC')
        ->first();

        array_push($data, $resolveddate);
            
        return $data;
    }
}
