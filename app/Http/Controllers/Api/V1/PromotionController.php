<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Promotion;
use App\Traits\HasJsonResponse;
use App\Http\Controllers\Api\V1\Controller;

class PromotionController extends Controller
{
    use HasJsonResponse;

    protected const MODEL = Promotion::class;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function page()
    {
        return $this->sendSuccessMessage([
            'promotions' => (self::MODEL)::where('is_active', true)->paginate(9),
        ]);
    }
}
