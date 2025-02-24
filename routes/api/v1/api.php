<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\VOR\ScheduleController;
use App\Http\Controllers\VOR\SongsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "myApi" middleware group. Make something great!
|
*/

    Route::group(['prefix' => 'songs'], function() {

        Route::get('list', [SongsController::class, 'get_all_songs']);
        Route::get('artistes', [SongsController::class, 'get_dist_artiste']);
        Route::post('add', [SongsController::class, 'appAddSong']);
        Route::post('played_song', [SongsController::class, 'appAddPlayed_song']);
        Route::post('update', [SongsController::class, 'appUpdateSong']);
        Route::post('delete', [SongsController::class, 'appDeleteSong']);
        Route::post('download', [SongsController::class, 'app_download_song_file']);
        Route::post('upload', [SongsController::class, 'app_upload_song_file']);

    });


    Route::group(['prefix' => 'auth'], function() {
        Route::post('register', [AuthController::class, 'appRegister']);
        Route::post('login', [AuthController::class, 'appLogin']);
        Route::post('send_email', [AuthController::class, 'appSendEmail']);
        Route::post('submit_pin', [AuthController::class, 'appSubmitPin']);
        Route::post('reset_password', [AuthController::class, 'appResetPassword']);
    });

    
    Route::group(['prefix' => 'users'], function() {
        Route::post('user_info', [UsersController::class, 'app_user_info']);
        Route::post('login', [UsersController::class, 'appLogin']);
        Route::post('upload', [UsersController::class, 'app_upload_user_image']);
        Route::post('update', [UsersController::class, 'app_update_user']);
    });


    Route::group(['prefix' => 'schedule'], function() {

        Route::get('list', [ScheduleController::class, 'get_all_schedules']);
        Route::post('add', [ScheduleController::class, 'appAddSchedule']);
        Route::post('update', [ScheduleController::class, 'appUpdateSchedule']);
        Route::post('delete', [ScheduleController::class, 'appDeleteSchedule']);

    });

?>