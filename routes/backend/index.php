<?php 

use Illuminate\Support\Facades\Route;

Route::view('/pages', 'backend.pages.homepage.index');

Route::resource('/products/about', 'ProductAboutController', ['names' => 'product.about', 'only' => ['edit', 'update']]);
Route::get('/products/about', 'ProductAboutController@show')->name('product.about.show');

Route::resource('/products', 'ProductsController');
Route::resource('/categories', 'CategoriesController');
Route::resource('/formats', 'FormatsController');
Route::resource('/size', 'SizesController');
Route::resource('/type', 'TypeController');
Route::resource('/homepage/slider', 'HomepageSliderController', ['names' => 'homepage.slider']);
Route::resource('/homepage/about', 'HomepageAboutController', ['names' => 'homepage.about', 'only' => ['edit', 'update']]);
Route::get('/homepage/about', 'HomepageAboutController@show')->name('homepage.about.show');
Route::resource('/homepage/card', 'HomepageCardController', ['names' => 'homepage.card']);
Route::resource('/member', 'MemberController');

Route::resource('/about', 'AboutController', ['only' => ['edit', 'update']]);
Route::get('/about', 'AboutController@show')->name('about.show');

Route::resource('/delivery', 'DeliveryController', ['only' => ['edit', 'update']]);
Route::get('/delivery', 'DeliveryController@show')->name('delivery.show');

Route::resource('/contacts', 'ContactsController', ['parameters' => ['contacts' => 'contacts']]);
Route::resource('/map', 'MapController', ['only' => ['edit', 'update']]);
Route::get('/map', 'MapController@show')->name('map.show');