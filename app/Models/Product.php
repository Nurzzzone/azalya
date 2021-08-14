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
        $category = Category::where('slug', $request['category'])->first();
        $query->where('category_id', $category->id);

        if ($request->has('price_from') && $request->has('price_to')) {
            $price_between = $request->only('price_from', 'price_to');
            $query->whereBetween("price", $price_between);
        } elseif ($request->has('price_from')) {
            $query->where('price', '>=', $request['price_from']);
        } elseif ($request->has('price_to')) {
            $query->where('price', '<=', $request['price_to']);
        }

        if ($request->has('type')) {
            $type = Type::where('slug', $request['type'])->first();
            $query->where('type_id', $type->id);
        }

        if ($request->has('size')) {
            $size = Size::where('slug', $request['size'])->first();
            $query->whereHas('sizes', fn($query) => 
                $query->where('sizes.id', $size->id));
        }

        if ($request->has('format')) {
            $format = Format::where('slug', $request['format'])->first();
            $query->whereHas('formats', fn($query) => 
                $query->where('formats.id', $format->id));
        }

        return $query;
    }
}
