<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('notify', function () {
    return view('notify');
})->name('notify');


Route::get('verify', function () {
    return view('verify-request');
})->name('verify');




Route::get('login', 'Auth\LoginController@showLogin')->name('login');
Route::post('login', 'Auth\LoginController@doLogin')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::post('register', 'Auth\RegisterController@doRegister')->name('register');
Route::get('register', 'Auth\RegisterController@showRegister')->name('register');
Route::get('confirmemail/{email}/{key}', 'Auth\RegisterController@confirmEmail')->name('confirmemail');

Route::get('forgotpass', 'Auth\ForgetPasswordController@showForgetPass')->name('forgotpass');
Route::post('forgotpass', 'Auth\ForgetPasswordController@doForgetPass')->name('forgotpass');
Route::get('confirmforgetpass/{email}/{key}', 'Auth\ForgetPasswordController@doConfirmPassword')->name('doconfirmpass');



Route::post('resetpass/{email}/{key}', 'Auth\ForgetPasswordController@resetPass')->name('resetpass');

Route::get('/auth/redirect/{provider}', 'Auth\SocialController@redirect');
Route::get('/callback/{provider}', 'Auth\SocialController@callback');
