<?php
 
use Illuminate\Support\Facades\Route;
 
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApiController;
 
Route::get('/', function () {
    return redirect('/contact-us');
});

Route::get('/contact-us', function () {
    return view('message');
});

Route::get('/survey', function () {
    return view('survey');
});

Route::post('/send-message', [MessageController::class, 'sendMessage'])->name('/send-message');
Route::post('/get-concern-list', [MessageController::class, 'getConcernList'])->name('/get-concern-list');
Route::post('/get-ticket-history', [MessageController::class, 'getTicketHistory'])->name('/get-ticket-history');
Route::post('/get-survey-list', [MessageController::class, 'getSurveyList'])->name('/get-survey-list');
Route::post('/resolve-ticket', [MessageController::class, 'resolveTicket'])->name('/resolve-ticket');
Route::post('/get-user-list', [UserController::class, 'getUserList'])->name('/get-user-list');
Route::post('/get-acount', [UserController::class, 'getAcount'])->name('/get-acount');
Route::post('/update-system', [UserController::class, 'updateOnlineSystem'])->name('/update-system');
Route::post('/add-user', [UserController::class, 'addUser'])->name('/add-user');
Route::post('/get-timeline', [MessageController::class, 'getTimeline'])->name('/get-timeline');
Route::post('/upload-file', [MessageController::class, 'uploadFile'])->name('/upload-file');
Route::get('/email', [MessageController::class, 'email'])->name('/email');
Route::post('/send-survey', [MessageController::class, 'sendSurvey'])->name('/send-survey');
Route::post('/get-survey-rate', [MessageController::class, 'getSurveyRate'])->name('/get-survey-rate');
Route::post('/get-status-count', [MessageController::class, 'getStatusCount'])->name('/get-status-count');

Route::get('/api/login/iis/{username}/{password}/{id_number}/{email}/{token}', [ApiController::class, 'iisLogin'])->name('iisLogin');
Route::post('/create/iis-account', [ApiController::class, 'createIISaccount'])->name('/create/iis-account');
Route::post('/login/iis-account', [ApiController::class, 'loginIISaccount'])->name('/login/iis-account');

Route::get('/iis-confirmation', function () {
    return view('auth.iis-confirmation');
});

Route::get('/iis-login', function () {
    return view('auth.iis-login');
});

Auth::routes();

Route::post('/get-notifications', [NotificationController::class, 'getNotifications'])->name('/get-notifications');
Route::post('/get-ticket-data', [MessageController::class, 'getTicketData'])->name('/get-ticket-data');
Route::post('/update-seen', [MessageController::class, 'updateSeen'])->name('/update-seen');
Route::post('/reset-password', [UserController::class, 'resetPassword'])->name('/reset-password');
Route::post('/change-password', [UserController::class, 'changePassword'])->name('/change-password');


Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
   
//Normal Users Routes List
Route::middleware(['auth', 'user-access:user'])->group(function () {
   
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});
   
//Admin Routes List
Route::middleware(['auth', 'user-access:admin'])->group(function () {
   
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/survey', [HomeController::class, 'adminSurvey'])->name('admin.survey');
});
   
//Admin Routes List
Route::middleware(['auth', 'user-access:manager'])->group(function () {

    // Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
   
    Route::get('/manager/home', [HomeController::class, 'managerHome'])->name('manager.home');
    Route::get('/manager/survey', [HomeController::class, 'managerSurvey'])->name('manager.survey');
    Route::get('/manager/logs', [HomeController::class, 'timelineLogs'])->name('manager.logs');
    Route::get('/manager/accounts', [HomeController::class, 'manageAccounts'])->name('manager.accounts');
    

    Route::get('/logs', function () {
        return view('superadmin.logs');
    });
});