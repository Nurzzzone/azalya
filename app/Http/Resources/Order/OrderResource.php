<?php

namespace App\Http\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'code' => $this->code,
            'city' => $this->city,
            'date' => $this->date,
            'time' => $this->time,
            'total_price' => $this->total_price,
            'delivery' => $this->delivery,
            'comment' => $this->comment,
            'status' => $this->status,
            'count' => $this->count
        ];
    }
}
