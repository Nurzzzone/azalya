<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'in_homepage',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function scopeInHome($query)
    {
        return $query
            ->where('in_homepage', true)->take(4);
    }
}
