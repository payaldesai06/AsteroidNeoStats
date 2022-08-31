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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'Auth\LoginController@showLoginForm');

Route::group(['middleware' => ['auth']], function () {

    Route::get('home', 'UserController@index')->name('dashboard');
    Route::get('settings', 'UserController@settings')->name('settings');
    Route::post('updateprofile', 'UserController@updateprofile')->name('updateprofile');
    Route::post('changepassword', 'UserController@changePassword')->name('changepassword');
    Route::get('logout', function ()
    {
        auth()->logout();
        Session()->flush();
        return Redirect::to('/');
    })->name('logout');

    Route::post('neostates', 'UserController@getNeoStates')->name('neostates');

});

