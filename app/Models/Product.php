<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'discount',
        'in_stock',
        'is_active',
        'is_popular',
        'in_homepage',
        'format_id',
        'category_id'
    ];

    protected $casts = [
        'in_stock' => 'boolean',
        'is_active' => 'boolean',
        'is_popular' => 'boolean',
        'in_homepage' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function formats()
    {
        return $this->belongsToMany(Format::class, 'products_has_formats');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'products_has_sizes');
    }
}
