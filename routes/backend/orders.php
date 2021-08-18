<?php

use Illuminate\Support\Facades\Route;

Route::resource('/orders', 'OrderController', ['only' => ['index', 'show', 'update']]);
