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
use Mail; 

use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function postSendMessage(Request $request)
    {

    }

    public function sendMessage(Request $request)
    {
        $now = new \DateTime();

        $validator = $this->validate( $request, 
            [
                
                'g-recaptcha-response' => 'required|captcha',
                'company-name' => 'required',
                'client-name' => 'required',
                'online-system' => 'required',
                'e-mail' => 'required|email',
                'subject' => 'required',
                'message' => 'required'
                
            ]
        );

        $data = DB::table('concerns')
        ->orderBy('id', 'DESC')
        ->first();

        $nextdata = isset($data) ? $data->id : 0;

        $tix = 'TIX-' . $now->format('Y-m') . "-" . str_pad($nextdata + 1, 8, "0", STR_PAD_LEFT);
        $client_name = $request['client-name'];


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

            $ticket_number = $tix;
            $email = $request['e-mail'];

            Mail::send('email', compact('client_name', 'ticket_number'), function($message){
                $message->to('eric.creencia25@gmail.com');
                $message->subject('Support Ticket Confirmation');
              });

            return redirect('contact-us')->with('success', $tix);
        }
    }

    
    public function getSurveyList(Request $request) 
    {
        $data = DB::table('survey')
        ->orderBy('id', 'DESC')
        ->get();

        return DataTables::of($data)
            ->addColumn('name', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. $data->name .'</span></center>';
                return $details;
            })
            ->addColumn('position_designation', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. $data->position_designation .'</span></center>';
                return $details;
            })
            ->addColumn('educational_attainment', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. $data->educational_attainment .'</span></center>';
                return $details;
            })
            ->addColumn('company_name', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. $data->company_name .'</span></center>';
                return $details;
            })
            ->addColumn('industry_type', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. $data->industry_type .'</span></center>';
                return $details;
            })
            ->addColumn('location', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. $data->location .'</span></center>';
                return $details;
            })
            ->addColumn('gender', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. $data->gender .'</span></center>';
                return $details;
            })
            ->addColumn('permit_type', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. $data->permit_type .'</span></center>';
                return $details;
            })
            ->addColumn('responsiveness', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. $data->responsiveness .'</span></center>';
                return $details;
            })
            ->addColumn('reliability', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. $data->reliability .'</span></center>';
                return $details;
            })
            ->addColumn('access_facilities', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. $data->access_facilities .'</span></center>';
                return $details;
            })
            ->addColumn('communication', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. $data->communication .'</span></center>';
                return $details;
            })
            ->addColumn('costs', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. $data->costs .'</span></center>';
                return $details;
            })
            ->addColumn('integrity', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. $data->integrity .'</span></center>';
                return $details;
            })
            ->addColumn('assurance', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. $data->assurance .'</span></center>';
                return $details;
            })
            ->addColumn('outcome', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. $data->outcome .'</span></center>';
                return $details;
            })
            ->addColumn('suggestions', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. $data->suggestions .'</span></center>';
                return $details;
            })
            ->addColumn('created_date', function ($data) {
                $details = '<center><span class="info-box-number text-center text-muted mb-0" >'. date("d M. Y", strtotime($data->created_date)) .'</span></center>';
                return $details;
            })
            ->rawColumns(['name', 'position_designation', 'educational_attainment', 'company_name', 'industry_type', 'location', 'gender', 'permit_type', 'responsiveness', 'reliability', 'access_facilities', 'communication', 'outcome', 'suggestions', 'costs', 'integrity', 'assurance', 'created_date'])
            ->make(true);
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
            ->addColumn('status', function ($data) {
                if($data->status == 1){
                    // $status = '<span class="badge badge-info">On going</span>';
                    $status = '<span class="badge badge-info">Processing</span>';
                } else if($data->status == 2){
                    $status = '<span class="badge badge-success">Resolved</span>';
                } else {
                    $status = '<span class="badge badge-warning">Pending</span>';
                }
                $details = '<span id="span">' . $status . '</span>';
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
                    $details = '<button type="button" class="btn btn-dark border rounded-pill shadow-sm mb-1" data-toggle="modal" data-target="#right_modal_lg" onclick="view('.$data->id.', 0)" id="view-concern-'.$data->id.'" name="view-concern"><i class="fa-solid fa-arrow-right-to-bracket"></i></button>';
                } else {
                    $details = '<button type="button" class="btn btn-light border rounded-pill shadow-sm mb-1" data-toggle="modal" data-target="#right_modal_lg" onclick="view('.$data->id.', 1)" id="view-concern-'.$data->id.'" name="view-concern"><i class="fa-solid fa-arrow-right-to-bracket"></i></button>';
                }
                
                

                return $details;
            })
            ->rawColumns(['ticket_num', 'company_name', 'client_company', 'email', 'online_system', 'subject', 'message', 'action', 'attachment', 'created_date', 'resolved_action', 'resolved_date', 'status'])
            ->make(true);
    }

    public function getTicketHistory(Request $request) 
    {
        
        $data = DB::table('concerns_history')
                ->where('ticket_number', $request->ticket_number)
                ->orderBy('id', 'DESC')
                ->get();

        return $data;
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

        if($request->status == 2) {

            $data = DB::table('concerns')
            ->where('id', $request->id)
            ->update([
                'action' => $request->action,
                'status' => $request->status,
                'resolved_date' => $now->format('Y-m-d H:i:s'),
            ]);

        } else if($request->status == 1) {

            $data = DB::table('concerns')
            ->where('id', $request->id)
            ->update([
                'status' => $request->status,
                'resolved_date' => $now->format('Y-m-d H:i:s'),
            ]);

        }

        $concerns_history = DB::table('concerns_history')->insert([
            'ticket_number' => $request->ticket,
            'status' => $request->status,
            'remarks' => $request->action,
            'created_by' => Auth::user()->name,
            'date' => $now->format('Y-m-d'),
            'time' => $now->format('H:i:s')
        ]);
        

        if($concerns_history) {

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

    public function email(Request $request)
    {
        $client_name = 'Josh Kyle';
        $ticket_number = 'TIX';
        return view('email', compact('client_name', 'ticket_number'));
    }

    public function sendSurvey(Request $request)
    {
        $validator = $this->validate( $request, 
            [
                
                'g-recaptcha-response' => 'required|captcha',
                'educational-attainment' => 'required',
                'type-of-industry' => 'required',
                'location' => 'required',
                'gender' => 'required',
                'permit-type' => 'required',
                'first-row' => 'required',
                'second-row' => 'required',
                'third-row' => 'required',
                'fourth-row' => 'required',
                'fifth-row' => 'required',
                'sixth-row' => 'required',
                'seventh-row' => 'required',
                'eight-row' => 'required',
            ]
        );

        $name = $request['name'];
        $position_designation = $request['position-designation'];
        $educational_attainment = $request['educational-attainment'];
        $company_name = $request['company-name'];
        $industry_type = $request['type-of-industry'];
        $location = $request['location'];
        $gender = $request['gender'];
        $permit_type = $request['permit-type'];
        $responsiveness = $request['first-row'];
        $reliability = $request['second-row'];
        $access_facilities = $request['third-row'];
        $communication = $request['fourth-row'];
        $costs = $request['fifth-row'];
        $integrity = $request['sixth-row'];
        $assurance = $request['seventh-row'];
        $outcome = $request['eight-row'];
        $suggestions = $request['suggestions'];
        $now = new \DateTime();

        $data = DB::table('survey')->insert([
            'name' => $name,
            'position_designation' => $position_designation,
            'educational_attainment' => $educational_attainment,
            'company_name' => $company_name,
            'industry_type' => $industry_type,
            'location' => $location,
            'gender' => $gender,
            'permit_type' => $permit_type,
            'responsiveness' => $responsiveness,
            'reliability' => $reliability,
            'access_facilities' => $access_facilities,
            'communication' => $communication,
            'costs' => $costs,
            'integrity' => $integrity,
            'assurance' => $assurance,
            'outcome' => $outcome,
            'suggestions' => $suggestions,
            'created_date' => $now->format('Y-m-d H:i:s'),
        ]);

        if($data) {
            // DB::table('logs')->insert([
            //     'ticket_number' => $request->ticket,
            //     'action' => 'resolved',
            //     'function' => 'support action',
            //     'name' => Auth::user()->name,
            //     'user_id' => Auth::user()->id,
            //     'user_type' => 1,
            //     'date' => $now->format('Y-m-d'),
            //     'time' => $now->format('H:i:s')
            // ]);

            return redirect('survey')->with('success');
        }
    }

    public function getSurveyRate(Request $request)
    {
        $arr = [];

        $totsurveycount = DB::table('survey')->count();

        $responsiveness = DB::table('survey')->sum('responsiveness');
        $reliability = DB::table('survey')->sum('reliability');
        $access_facilities = DB::table('survey')->sum('access_facilities');
        $communication = DB::table('survey')->sum('communication');
        $costs = DB::table('survey')->sum('costs');
        $integrity = DB::table('survey')->sum('integrity');
        $assurance = DB::table('survey')->sum('assurance');
        $outcome = DB::table('survey')->sum('outcome');
        
        $arr['responsiveness'] = $responsiveness / $totsurveycount;
        $arr['reliability'] = $reliability / $totsurveycount;
        $arr['access_facilities'] = $access_facilities / $totsurveycount;
        $arr['communication'] = $communication / $totsurveycount;
        $arr['costs'] = $costs / $totsurveycount;
        $arr['integrity'] = $integrity / $totsurveycount;
        $arr['assurance'] = $assurance / $totsurveycount;
        $arr['outcome'] = $outcome / $totsurveycount;

        return $arr;
    }

    public function getStatusCount(Request $request)
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

        $tot = DB::table('concerns')
        ->whereIn('online_system', $newArr)
        ->count();

        $pending = DB::table('concerns')
        ->whereIn('online_system', $newArr)
        ->where('status', 0)
        ->count();

        $processing = DB::table('concerns')
        ->whereIn('online_system', $newArr)
        ->where('status', 1)
        ->count();

        $resolved = DB::table('concerns')
        ->whereIn('online_system', $newArr)
        ->where('status', 2)
        ->count();

        $arr = [];

        $arr['pending'] = $pending;
        $arr['processing'] = $processing;
        $arr['resolved'] = $resolved;
        $arr['tot'] = $tot;

        return $arr;
    }
}
