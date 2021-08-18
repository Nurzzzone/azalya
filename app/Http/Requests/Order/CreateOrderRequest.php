<?php

namespace App\Http\Requests\Order;

use App\Models\Order;
use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    protected const ORDER_CREATED = "Оформлен";

    /**
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'city' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date', 'after:yesterday'],
            'time' => ['required', 'string', 'max:255'],
            'delivery' => ['required', 'string', 'max:255'],
            'products' => ['required', 'array'],
            'products.*.id' => ['required', 'integer'],
            'products.*.count' => ['required', 'integer'],
            'products.*.size' => ['required', 'string', 'max:10'],
            'products.*.format' => ['required', 'string', 'max: 90'],
            'reciever' => ['required', 'array'],
            'reciever.name' => ['required', 'string', 'max:255'],
            'reciever.phone_number' => ['required', 'string', 'max:255'],
            'reciever.email' => ['required', 'string', 'email'],
            'total_price' => ['required', 'numeric'],
            'comment' => ['required', 'string', 'max:8000'],
        ];
    }

    public function validated()
    {
        $request = $this->validator->validated();
        $request['count'] = array_reduce($request['products'], function($carry, $product) {
            $carry = $product['count'] + $carry;
            return $carry;
        }, 0);
        $latestOrder = Order::orderBy('created_at','DESC')->first()->id ?? 0;
        $request['code'] = str_pad($latestOrder + 1, 7, "0", STR_PAD_LEFT);
        $request['status'] = self::ORDER_CREATED;
        return $request;
    }
}
