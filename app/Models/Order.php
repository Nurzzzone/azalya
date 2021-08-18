<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'code',
        'city',
        'date',
        'time',
        'count',
        'total_price',
        'delivery',
        'comment',
        'status',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_has_products')
            ->withPivot('count', 'format', 'size');
    }

    public function reciever()
    {
        return $this->hasOne(Reciever::class);
    }
}
