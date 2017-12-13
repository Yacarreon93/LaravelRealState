<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes related to the owners.
|
*/

Route::get('owners/trashed', 'OwnerController@trashed')->name('owners.trashed');
Route::put('owners/{owners}/trash', 'OwnerController@trash')->name('owners.trash');
Route::get('owners/{owners}/restore', 'OwnerController@restore')->name('owners.restore');

Route::resource('owners', 'OwnerController');
