<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the main routes of the application.
|
*/

Route::get('/home', ['middleware' => 'auth', function () {
    return view('home'); }
]);

Route::get('/', function () {
    return view('welcome');
});
