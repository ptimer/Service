<?php

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

// main page and others

Route::get('/', 'HomeController@index')->name('welcome');

Auth::routes();

// client

Route::get('/home', 'ClientController@index')->name('home');

// admin hq

Route::get('hq/dashboard', 'AdminController@index')->name('admin.dashboard');
Route::get('hq/', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('hq/', 'Auth\AdminLoginController@login')->name('admin.login.submit');


// operator mg

Route::get('mg/dashboard', 'OperatorController@index')->name('operator.dashboard');
Route::get('mg/', 'Auth\OperatorLoginController@showLoginForm')->name('operator.login');
Route::post('mg/', 'Auth\OperatorLoginController@login')->name('operator.login.submit');

Route::post('mg/register', 'Auth\RegisterOperatorController@register')->name('operator.register');
Route::delete('mg/destroyOperator', 'AdminController@destroyOperator')->name('admin.destroyOperator');
Route::patch('mg/updateOperator', 'AdminController@updateOperator')->name('admin.updateOperator');

// password reset routes admin

Route::post('hq/password/email', 'Auth\AdminForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('hq/password/reset', 'Auth\AdminForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::post('hq/password/reset', 'Auth\AdminResetPasswordController@reset');
Route::get('hq/password/reset{token}', 'Auth\AdminResetPasswordController@showResetForm')->name('admin.password.reset');

// password reset routes operator

Route::post('mg/password/email', 'Auth\OperatorForgotPasswordController@sendResetLinkEmail')->name('operator.password.email');
Route::get('mg/password/reset', 'Auth\OperatorForgotPasswordController@showLinkRequestForm')->name('operator.password.request');
Route::post('mg/password/reset', 'Auth\OperatorResetPasswordController@reset');
Route::get('mg/password/reset{token}', 'Auth\OperatorResetPasswordController@showResetForm')->name('operator.password.reset');