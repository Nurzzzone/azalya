<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Map;
use App\Models\Contacts;
use App\Traits\HasJsonResponse;
use App\Http\Controllers\Controller;

class ContactsController extends Controller
{
    use HasJsonResponse;

    /**
     * @return \Illuminate\Http\Response
     */
    public function page()
    {
        return $this->sendSuccessMessage([
            'contacts' => Contacts::all(['name', 'value', 'image']),
            'map' => Map::first(['value'])->value,
        ]);
    }
}
