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

Route::get('/', 'StaticPagesController@home')->name('home');
Route::get('/help', 'StaticPagesController@help')->name('help');
Route::get('/about', 'StaticPagesController@about')->name('about');
Route::get('signup', 'UsersController@signup')->name('signup');

Route::resource('users', 'UsersController');
Route::get('users/{user}/fans', 'UsersController@fans')->name('users.fans'); //粉丝列表
Route::get('users/{user}/followers', 'UsersController@followers')->name('users.followers'); //关注的人
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email'); //邮件激活
Route::post('users/friend/{user}', 'UsersController@friend')->name('users.friend');
Route::post('users/unfriend/{user}', 'UsersController@unfriend')->name('users.unfriend');

Route::get('login', 'SessionsController@login')->name('login');
Route::post('login', 'SessionsController@store')->name('login');
Route::delete('logout', 'SessionsController@destroy')->name('logout');

Route::resource('statuses', 'StatusesController', ['only' => ['store', 'destroy']]);
