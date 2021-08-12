<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAbout extends Model
{
    use HasFactory;
    protected $table = 'product_about';
    protected $fillable = [
        'name',
        'image',
        'description',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
