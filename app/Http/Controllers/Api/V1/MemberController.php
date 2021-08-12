<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Member;
use App\Http\Controllers\Controller;
use App\Http\Resources\MemberCollection;

class MemberController extends Controller
{
    protected const MODEL = Member::class;

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return (new MemberCollection((self::MODEL)::where('is_active', true)->get()))
            ->response()
            ->setEncodingOptions(JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }
}
