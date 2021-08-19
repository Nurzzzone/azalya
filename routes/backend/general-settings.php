<?php

use Illuminate\Support\Facades\Route;

Route::get('/general', 'GeneralSettingsController@show')->name('general.settings.show');
Route::resource('/general', 'GeneralSettingsController', ['only' => ['edit', 'update'], 'names' => 'general.settings', 'parameters' => ['general' => 'settings']]);