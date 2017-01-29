<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

use App\User;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/users', function() {
        return User::all();
    });
    Route::get('/invoices', function() {
        return \App\Invoice::all();
    });
});


Auth::routes();

Route::get('/home', 'HomeController@index');
