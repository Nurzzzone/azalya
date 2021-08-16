<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\Controller;
use App\Models\Delivery;
use App\Traits\HasJsonResponse;

class DeliveryController extends Controller
{
    use HasJsonResponse;

    protected const MODEL = Delivery::class;

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function page()
    {
        return $this->sendSuccessMessage([
            'delivery' => Delivery::first(),
        ]);
    }
}
