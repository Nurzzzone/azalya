<?php 

use Illuminate\Support\Facades\Route;

Route::view('/pages', 'backend.pages.homepage.index');
Route::resource('/benefit', 'BenefitController');
Route::patch('/user/{user}/password', 'UserController@update')->name('password.update');