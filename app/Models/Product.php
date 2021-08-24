<?php

namespace App\Models;

use Illuminate\Pipeline\Pipeline;
use Illuminate\Database\Eloquent\Model;
use ChristianKuri\LaravelFavorite\Traits\Favoriteable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, Favoriteable;

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
        'type_id',
        'category_id'
    ];

    protected $casts = [
        'in_stock' => 'boolean',
        'is_active' => 'boolean',
        'is_popular' => 'boolean',
        'in_homepage' => 'boolean'
    ];

    protected $appends = ['count', 'format', 'size'];
    protected $hidden = ['pivot'];

    public function getCountAttribute()
    {
        return ($this->pivot)? $this->pivot->count: null;
    }

    public function getFormatAttribute()
    {
        return ($this->pivot)? $this->pivot->format: null;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getSizeAttribute()
    {
        return ($this->pivot)? $this->pivot->size: null;
    }

    public function formats()
    {
        return $this->belongsToMany(Format::class, 'products_has_formats');
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'products_has_sizes');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_has_favourite_products');
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'order_has_products')
            ->withPivot('count', 'format', 'size');
    }

    public function scopeFilter($query)
    {
        return app(Pipeline::class)
            ->send($query)
            ->through([
                \App\QueryFilters\CategoryFilter::class,
                \App\QueryFilters\PriceFilter::class,
                \App\QueryFilters\TypeFilter::class,
                \App\QueryFilters\SizeFilter::class,
                \App\QueryFilters\ActiveFilter::class,
            ])->thenReturn();
    }

    public function scopeInHome($query)
    {
        return $query
            ->where('is_active', true)
            ->where('in_homepage', true)->take(9);
    }
}
