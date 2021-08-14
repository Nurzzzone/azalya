<?php

use Illuminate\Support\Facades\Route;

Route::resource('/products/about', 'ProductAboutController', ['names' => 'product.about', 'only' => ['edit', 'update']]);
Route::get('/products/about', 'ProductAboutController@show')->name('product.about.show');
Route::resource('/products', 'ProductsController');
Route::resource('/categories', 'CategoriesController');
Route::resource('/formats', 'FormatsController');
Route::resource('/size', 'SizesController');
Route::resource('/type', 'TypeController');