<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Order;
use App\Models\Reciever;
use App\Traits\HasJsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Api\V1\Controller;
use App\Http\Requests\Order\CreateOrderRequest;

class OrderController extends Controller
{
    use HasJsonResponse;

    public function checkout(CreateOrderRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $order = Order::create($data = $request->validated());
                foreach($data['products'] as $product) {
                    $pivots = ['count' => $product['count'], 'format' => $product['format'], 'size' => $product['size']];
                    $order->products()->attach($product['id'], $pivots);
                }
                if ($request->has('reciever')) {
                    $data['reciever']['order_id'] = $order->id;
                    Reciever::create($data['reciever']);
                }
            });
        } catch (\Exception $exception) {
            return $this->sendErrorMessage($exception->getMessage());
        }
        return $this->sendSuccessMessage();
    }
}
