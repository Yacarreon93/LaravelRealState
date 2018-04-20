<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes related to the estates.
|
*/

Route::get('estates/search', 'EstateController@search')->name('estates.search');
Route::get('estates/filter/{type_name}', 'EstateController@filter')->name('estates.filter');

Route::get('estates/trashed', 'EstateController@trashed')->name('estates.trashed');
Route::put('estates/{id}/trash', 'EstateController@trash')->name('estates.trash');
Route::put('estates/{id}/restore', 'EstateController@restore')->name('estates.restore');

Route::resource('estates', 'EstateController');
