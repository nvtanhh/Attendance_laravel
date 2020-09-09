<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'Api\UserAuthControler@login');
    Route::post('register', 'Api\UserAuthControler@register');

    Route::group([
        'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'Api\UserAuthControler@logout');
        Route::get('user', 'Api\UserAuthControler@user');
        Route::post('uploadimage','Api\UserUploadImage@storeImage');
        Route::get('alreadytrain', 'Api\UserUploadImage@changeStatusIsTrain');
        Route::get('addface', 'Api\StudentAttendance@addFaceForStudent');
        Route::get('getlistclass','Api\StudentAttendance@getListClass');
        Route::post('attendance','Api\StudentAttendance@attendance');
        Route::get('train','Api\StudentAttendance@train');
        Route::get('sttrain','Api\StudentAttendance@statusTrain');
        Route::get('satusattendance','Api\StudentAttendance@getStatusAtendace');

    });
});
