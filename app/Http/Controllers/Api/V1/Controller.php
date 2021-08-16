<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Support\Facades\Auth;

class Controller 
{
    public function __construct()
    {
        Auth::setDefaultDriver('api');
    }
}
