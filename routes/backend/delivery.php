<?php

use Illuminate\Support\Facades\Route;

Route::resource('/delivery', 'DeliveryController', ['only' => ['edit', 'update']]);
Route::get('/delivery', 'DeliveryController@show')->name('delivery.show');