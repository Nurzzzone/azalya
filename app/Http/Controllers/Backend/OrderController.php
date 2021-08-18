<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\UpdateOrderRequest;

class OrderController extends Controller
{
    protected const MODEL = Order::class;
    protected const COLUMNS = ['id', 'date', 'time', 'delivery', 'total_price', 'status'];
    protected const ORDER_CREATED = "Оформлен";
    protected const ORDER_IN_PROCESSING = "В обработке";
    protected const ORDER_SENT = "Отправлено";
    protected const ORDER_DELIVERED = "Доставлено";

    public function __construct()
    {
        $this->route = 'order';
        $this->object = 'order';
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("backend.pages.{$this->route}.index", 
        [
            $this->object => (self::MODEL)::paginate(10),
            'columns' => self::COLUMNS
        ]);
    }

    /**
     * @param  Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        if ($order->status === self::ORDER_CREATED) {
            $order->update(['status' => self::ORDER_IN_PROCESSING]);
        }
        return view("backend.pages.{$this->route}.show", compact($this->object));
    }


    /**
     * @param  UpdateOrderRequest $request
     * @param  Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }
}
