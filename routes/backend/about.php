<?php

use Illuminate\Support\Facades\Route;

Route::resource('/about', 'AboutController', ['only' => ['edit', 'update']]);
Route::get('/about', 'AboutController@show')->name('about.show');
Route::resource('/member', 'MemberController');
