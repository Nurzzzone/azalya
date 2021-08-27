<?php

namespace App\Http\Controllers\Backend;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Traits\HasJsonResponse;

class OrderController extends Controller
{
    use HasJsonResponse;

    protected const MODEL = Order::class;
    protected const COLUMNS = ['code', 'date', 'time', 'delivery', 'total_price', 'status'];
    protected const ORDER_CREATED = "Оформлен";
    protected const ORDER_IN_PROCESSING = "В обработке";
    protected const ORDER_SENT = "Отправлено";
    protected const ORDER_STATUS = ['В обработке' => 'В обработке', 'Отправлен' => 'Отправлен', 'Доставлено' => 'Доставлено'];

    public function __construct()
    {
        $this->route = 'order';
        $this->object = 'order';
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view("backend.pages.{$this->route}.index",
        [
            $this->object => (self::MODEL)::orderBy('id', 'desc')->paginate(10),
            'columns' => self::COLUMNS
        ]);
    }

    /**
     * @param  Order $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order)
    {
        $statuses = self::ORDER_STATUS;
        if ($order->status === self::ORDER_CREATED) {
            $order->update(['status' => self::ORDER_IN_PROCESSING]);
        }
        return view("backend.pages.{$this->route}.show", compact($this->object, 'statuses'));
    }


    /**
     * @param  UpdateOrderRequest $request
     * @param  Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        try {
            $order->update($request->validated());
        } catch (\Throwable $th) {
            return $this->sendErrorMessage();
        }
        return $this->sendSuccessMessage();
    }
}
