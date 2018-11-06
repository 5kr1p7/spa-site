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

//Auth::routes();
Route::post('login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/api/user', 'SpaController@curr_user')->name('curr_user');
Route::post('register', 'Auth\RegisterController@register');

Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');

Route::get('/{any}', 'SpaController@index')->where('any', '.*');

//App\Http\Controllers\LoginController
//