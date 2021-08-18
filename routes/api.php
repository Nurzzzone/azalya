<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1', 'namespace' => 'Api\\V1'], function() {
    Route::view('/routes', 'api.v1.pages.routes');

    Route::group(['prefix' => 'auth'], function() {
        Route::post('/register', 'AuthController@register');
        Route::post('/login', 'AuthController@login');
        Route::post('/reset', 'AuthController@reset');
        Route::post('/access-token', 'AuthController@getToken');
    });

    Route::group(['prefix' => 'page'], function() {
        Route::get('/home', 'HomepageController@page');
        Route::get('/about', 'AboutController@page');
        Route::get('/products', 'ProductsController@page');
        Route::get('/product/{product}', 'ProductsController@show');
        Route::get('/delivery', 'DeliveryController@page');
        Route::get('/promotions', 'PromotionController@page');
        Route::get('/contacts', 'ContactsController@page');
    });
    
    Route::get('/categories/{category_slug}', 'CategoriesController@show');
    Route::post('/products/filter', 'ProductsController@filter');

    Route::group(['middleware' => ['jwt', 'auth:api']], function() {
        Route::post('/products/{product}/favorites', 'ProductsController@toggleFavorite');
        Route::get('/user/{user}/favorites', 'UserController@list');
        Route::post('/checkout', 'OrderController@checkout');
    });
});