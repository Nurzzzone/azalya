<?php

use Illuminate\Support\Facades\Route;

Route::resource('/homepage/slider', 'HomepageSliderController', ['names' => 'homepage.slider']);
Route::resource('/homepage/about', 'HomepageAboutController', ['names' => 'homepage.about', 'only' => ['edit', 'update']]);
Route::get('/homepage/about', 'HomepageAboutController@show')->name('homepage.about.show');
Route::resource('/homepage/card', 'HomepageCardController', ['names' => 'homepage.card']);