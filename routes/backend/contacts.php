<?php

use Illuminate\Support\Facades\Route;

Route::resource('/contacts', 'ContactsController', ['parameters' => ['contacts' => 'contacts']]);
Route::resource('/map', 'MapController', ['only' => ['edit', 'update']]);
Route::get('/map', 'MapController@show')->name('map.show');