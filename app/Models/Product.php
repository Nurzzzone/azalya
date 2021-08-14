<?php

namespace App\Models;

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

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_has_favourite_products');
    }

    public function types()
    {
        return $this->belongsTo(Type::class);
    }

    public function scopeFilter($query, $request)
    {
        $category = Category::where('slug', $request('category_slug'))->first();
        $query->where('category', $category->id);

        if ($request('price_from') && $request('price_to')) {
            $query->whereBetween($request('price_from'), $request('price_to'));
        } elseif ($request('price_from')) {
            $query->where('price', '>=', $request('price_from'));
        } elseif ($request('price_to')) {
            $query->where('price', '<=', $request('price_to'));
        }

        if ($request('product_type')) {
            $type = Type::where('slug', $request('product_type'))->first();
            $query->where('type', '>=', $type->id);
        }

        if ($request('product_size')) {
            $size = Size::where('slug', $request('product_size'))->first();
            $query->where('size', '>=', $size->id);
        }

        if ($request('product_format')) {
            
        }
        return $query;
    }
}
