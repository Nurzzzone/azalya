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
            if (str_contains($request['type'], ',')) {
                $request['type'] = explode(',', $request['type']);
                $types = Type::whereIn('slug', $request['type'])->pluck('id');
                $query->whereIn('type_id', $types);
            } else {
                $type = Type::where('slug', $request['type'])->first();
                $query->where('type_id', $type->id);
            }
        }

        if ($request->has('size')) {
            if (str_contains($request['size'], ',')) {
                $request['size'] = explode(',', $request['size']);
                $sizes = Size::whereIn('slug', $request['size'])->pluck('id');
                $query->whereHas('sizes', fn($query) => 
                    $query->whereIn('sizes.id', $sizes));
            } else {
                $size = Size::where('slug', $request['size'])->first();
                $query->whereHas('sizes', fn($query) => 
                    $query->where('sizes.id', $size->id));
            }
        }

        if ($request->has('format')) {
            if (str_contains($request['format'], ',')) {
                $request['format'] = explode(',', $request['format']);
                $formats = Format::whereIn('slug', $request['format'])->pluck('id');
                $query->whereHas('formats', fn($query) => 
                    $query->whereIn('formats.id', $formats));
            } else {
                $format = Format::where('slug', $request['format'])->first();
                $query->whereHas('formats', fn($query) => 
                    $query->where('formats.id', $format->id));
            }
        }

        return $query;
    }

    public function scopeInHome($query)
    {
        return $query
            ->where('is_active', true)
            ->where('in_homepage', true)->take(9);
    }
}
