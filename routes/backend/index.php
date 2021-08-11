<?php 

use Illuminate\Support\Facades\Route;

Route::resource('/products', 'ProductsController');
Route::resource('/categories', 'CategoriesController');
Route::resource('/formats', 'FormatsController');
Route::resource('/size', 'SizesController');
Route::resource('/homepage/slider', 'HomepageSliderController', [
    'names' => 'homepage.slider',
]);
Route::resource('/homepage/about', 'HomepageAboutController', [
    'names' => 'homepage.about',
]);