<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reciever extends Model
{
    use HasFactory;
    protected $table = 'recievers';
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'order_id',
        'comment'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
