<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\CalendarController;
use App\Http\Controllers\Admin\ChurchAttendanceController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EvangelismCntroller;
use App\Http\Controllers\Admin\FirstTimersController;
use App\Http\Controllers\Admin\MembersController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\VOR\ScheduleController;
use App\Http\Controllers\VOR\SongsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// Route::get('login', [AdminController::class, 'getLoginPage']);

// // Route::get('admin', [AdminController::class, 'home'])->middleware(['admin']);

// Route::post('login', [AuthController::class, 'login_post']);
  
// Route::get('logout', [AuthController::class, 'auth_logout_admin']);

   

// Route::middleware('admin')->group(function () {

//     Route::get('admin', [AdminController::class, 'home']);
//     Route::get('dashboard', [AdminController::class, 'dashboard']);

// });





Route::get('login', function () {
    return view('admin.auth.login');
});

Route::post('login_post', [AuthController::class, 'login_post']);

Route::get('forgot', [UsersController::class, 'forgot_page']);
Route::post('forgot_password', [UsersController::class, 'forgot_password']);
Route::get('reset/', [UsersController::class, 'reset_password']);
Route::get('pincode', [UsersController::class, 'pincode_page']);
Route::get('send_pincode', [UsersController::class, 'send_pincode']);
Route::get('create_new_password', [UsersController::class, 'create_new_password']);


// Admins Group 
Route::group(['middleware' => 'admins'], function () {

    // Dashboard 
    Route::get('admin', [DashboardController::class, 'dashboard']);
    Route::get('admin/fetch_birthdates', [DashboardController::class, 'dashboard']);
    Route::get('get_dashboard_items', [DashboardController::class, 'get_dashboard_items']);



    // Admin Church Attendance Dashboard
    Route::get('admin/fetch_church_attendance', [ChurchAttendanceController::class, 'fetch_church_attendance']);
    Route::get('fetch_church_att_yr', [ChurchAttendanceController::class, 'fetch_church_att_yr']);
    



    // Calendar 
    Route::get('admin/calendar/home', [CalendarController::class, 'home']);
    Route::get('admin/calendar/fetch_calendar_items', [CalendarController::class, 'fetch_calendar_items']);
    Route::get('admin/calendar/update_church_events', [CalendarController::class, 'update_church_events']);
    Route::get('admin/calendar/fetch_cal_title_names', [CalendarController::class, 'fetch_cal_title_names']);
    Route::get('admin/calendar/pem_delete_ft', [CalendarController::class, 'pem_delete_ft']);

    // namespace App\Models\Admin\Nations;
    // namespace App\Models\VOR;


    // Admin Users 
    Route::get('admin/users/list', [UsersController::class, 'list']);
    Route::get('admin/users/edit_user/{id}', [UsersController::class, 'edit_user']);
    Route::get('admin/users/change_status', [UsersController::class, 'change_status']);
    Route::post('add_user', [UsersController::class, 'add_user']);
    Route::post('update_user', [UsersController::class, 'update_user']);
    Route::get('admin/users/reset_user_password/{id}', [UsersController::class, 'reset_user_password']);
    Route::get('admin/users/delete_user/{id}', [UsersController::class, 'delete_user']);
    Route::get('admin/users/recycle', [UsersController::class, 'recycle']);
    Route::get('admin/users/restore_user/{id}', [UsersController::class, 'restore_user']);
    Route::get('admin/users/online_user/{id}', [UsersController::class, 'online_user']);
    Route::post('admin/user/update_image', [UsersController::class, 'update_user_image']);
    Route::get('admin/users/pem_delete_user/{id}', [UsersController::class, 'pem_delete_user']);
    Route::get('verify_email/{id}', [UsersController::class, 'verify_email']);
    Route::get('verify/', [UsersController::class, 'verify_now']);





    // Admin First Timers 
    Route::get('admin/first_timers/list', [FirstTimersController::class, 'list']);
    Route::get('admin/first_timers/edit_first_timer/{id}', [FirstTimersController::class, 'edit_first_timer']);
    Route::post('add_first_timer', [FirstTimersController::class, 'add_first_timer']);
    Route::post('update_first_timer', [FirstTimersController::class, 'update_first_timer']);
    Route::get('admin/first_timers/delete_ft/{id}', [FirstTimersController::class, 'delete_ft']);
    Route::get('admin/first_timers/recycle', [FirstTimersController::class, 'recycle']);
    Route::get('admin/first_timers/restore_ft/{id}', [FirstTimersController::class, 'restore_ft']);
    Route::get('admin/first_timers/pem_delete_ft/{id}', [FirstTimersController::class, 'pem_delete_ft']);
    Route::get('admin/first_timers/selected_action', [FirstTimersController::class, 'seletedAction']);


    // Admin Members
    Route::get('admin/members/list', [MembersController::class, 'list']);
    Route::get('admin/members/edit_member/{id}', [MembersController::class, 'edit_member']);
    Route::post('add_members', [MembersController::class, 'add_members']);
    Route::post('update_member', [MembersController::class, 'update_member']);
    Route::get('admin/members/delete_member/{id}', [MembersController::class, 'delete_member']);
    Route::get('admin/members/recycle', [MembersController::class, 'recycle']);
    Route::get('admin/members/restore_member/{id}', [MembersController::class, 'restore_member']);
    Route::get('admin/members/pem_delete_member/{id}', [MembersController::class, 'pem_delete_member']);
    Route::get('admin/members/selected_action', [MembersController::class, 'seletedAction']);
    Route::get('admin/members/change_status', [MembersController::class, 'change_status']);
    Route::get('admin/members/get_state_country', [MembersController::class, 'get_state_country']);
    Route::get('admin/members/reset_member_password/{id}', [MembersController::class, 'reset_member_password']);
    Route::post('/admin/member/update_image', [MembersController::class, 'update_member_image']);


    // Admin Evangelism
    Route::get('admin/evangelism/list', [EvangelismCntroller::class, 'list']);
    Route::get('admin/evangelism/edit_new_soul/{id}', [EvangelismCntroller::class, 'edit_new_soul']);
    Route::post('add_new_soul', [EvangelismCntroller::class, 'add_new_soul']);
    Route::post('update_new_soul', [EvangelismCntroller::class, 'update_new_soul']);
    Route::get('admin/evangelism/delete_new_soul/{id}', [EvangelismCntroller::class, 'delete_new_soul']);
    Route::get('admin/evangelism/recycle', [EvangelismCntroller::class, 'recycle']);
    Route::get('admin/evangelism/restore_new_soul/{id}', [EvangelismCntroller::class, 'restore_new_soul']);
    Route::get('admin/evangelism/pem_delete_new_soul/{id}', [EvangelismCntroller::class, 'pem_delete_new_soul']);
    Route::get('admin/evangelism/selected_action', [EvangelismCntroller::class, 'seletedAction']);


    // Admin Church Attendance Page
    Route::get('admin/attendance/list', [ChurchAttendanceController::class, 'list']);
    Route::get('admin/attendance/fetch_curhch_attendance', [ChurchAttendanceController::class, 'fetch_curhch_attendance_page']);
    Route::get('admin/attendance/fetch_event_date_cal', [ChurchAttendanceController::class, 'fetch_event_date_cal']);
    Route::get('admin/attendance/add_event_date_cal', [ChurchAttendanceController::class, 'add_event_date_cal']);
    Route::get('admin/attendance/get_single_attendance_data', [ChurchAttendanceController::class, 'getSingleAttendance']);
    Route::get('admin/attendance/update_single_attendance_data', [ChurchAttendanceController::class, 'update_single_attendance_data']);
    // Route::get('admin/attendance/restore_new_soul/{id}', [EvangelismCntroller::class, 'restore_new_soul']);
    // Route::get('admin/attendance/pem_delete_new_soul/{id}', [EvangelismCntroller::class, 'pem_delete_new_soul']);
    // Route::get('admin/attendance/selected_action', [EvangelismCntroller::class, 'seletedAction']);




    Route::get('logout', [AuthController::class, 'auth_logout_admin']);


    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////        ************************      EVANGELISM      GROUP       *************************       ///////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    // Evangelism Dashboard 
    Route::get('evangelism', [DashboardController::class, 'dashboard']);
    Route::get('evangelism/fetch_birthdates', [DashboardController::class, 'dashboard']);


    // Evangelism Church Attendance Dashboard
    Route::get('evangelism/fetch_church_attendance', [ChurchAttendanceController::class, 'fetch_church_attendance']);
    Route::get('fetch_church_att_yr', [ChurchAttendanceController::class, 'fetch_church_att_yr']);
    


});

// Evangelism Group 
Route::group(['middleware' => 'evangelism'], function () {


});



    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////        ************************          VOR         GROUP       *************************       ///////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    

// Route::get('vor', function () {
//     return view('vor.home.home');
// });

Route::get('vor', [SongsController::class, 'vor_home']);
Route::get('get_all_songs', [SongsController::class, 'get_all_songs']);
Route::get('download_song_file', [SongsController::class, 'download_song_file']);
Route::get('downloads_files/{id}', [SongsController::class, 'downloads_files']);
Route::get('played_song_info/{id}', [SongsController::class, 'add_played_song_info']);
Route::get('get_all_schedules', [ScheduleController::class, 'get_all_schedules']);
Route::get('edit_song_details', [SongsController::class, 'edit_song_details']);