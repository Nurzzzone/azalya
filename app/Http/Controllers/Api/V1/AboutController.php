<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\About;
use App\Models\Member;
use App\Models\Benefit;
use App\Traits\HasJsonResponse;
use App\Http\Controllers\Controller;

class AboutController extends Controller
{
    use HasJsonResponse;

    /**
     * @return \Illuminate\Http\Response
     */
    public function page()
    {
        return $this->sendSuccessMessage([
            'about' => About::first(['name', 'description', 'image']),
            'benefits' => Benefit::inAbout()->get(['name', 'image']),
            'members' => Member::all(['fullname', 'position', 'image'])
        ]);
    }
}
