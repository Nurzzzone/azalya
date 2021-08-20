<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/admin', 301);
Route::group(['middleware' => ['auth', 'get.menu']], function () {
    Route::get('/admin', function () { return view('backend.pages.dashboard.index'); });
    
    Route::group(['prefix' => 'admin', 'namespace' => 'Backend', 'as' => 'backend.'], function() {
        include_route_files(__DIR__ . '/backend/');
    });

    // Route::resource('users',        'UsersController')->except( ['create', 'store'] );
    // Route::resource('mail',        'MailController');
    // Route::get('prepareSend/{id}',        'MailController@prepareSend')->name('prepareSend');
    // Route::post('mailSend/{id}',        'MailController@send')->name('mailSend');

});
