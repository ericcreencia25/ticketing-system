<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
        
    }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('admin.adminHome');
    }
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function managerHome()
    {
        return view('superadmin.managerHome');
    }


    public function timelineLogs()
    {
        return view('superadmin.logs');
    }

    public function manageAccounts()
    {
        return view('superadmin.manage-account');
    }

    public function profile()
    {
        return view('profile');
    }

    public function managerSurvey()
    {
        return view('superadmin.survey-list');
    }

    public function adminSurvey()
    {
        return view('admin.survey-list');
    }


    


    


}