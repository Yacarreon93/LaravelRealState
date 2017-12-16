<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes related to the estates.
|
*/
Route::get('estates/trashed', 'EstateController@trashed')->name('estates.trashed');
Route::put('estates/{estates}/trash', 'EstateController@trash')->name('estates.trash');
Route::put('estates/{estates}/restore', 'EstateController@restore')->name('estates.restore');

Route::resource('estates', 'EstateController');
