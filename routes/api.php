<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api\\V1'], function() {
    Route::get('/products', 'ProductsController@index');
    Route::get('/categories', 'CategoriesController@index');
});