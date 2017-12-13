<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes related to the owners.
|
*/

Route::get('owners/trashed', 'OwnerController@trashed');

Route::resource('owners', 'OwnerController');
