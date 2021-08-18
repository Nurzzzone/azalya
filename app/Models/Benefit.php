<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Benefit extends Model
{
    use HasFactory;
    protected $table = 'benefits';
    protected $fillable = [
        'name', 
        'image',
        'in_homepage',
        'in_about',
        'in_product'
    ];
    protected $casts = [
        'in_homepage' => 'boolean',
        'in_about' => 'boolean',
        'in_product' => 'boolean'
    ];

    public function scopeInHome($query)
    {
        return $query
            ->where('in_homepage', true)->take(4);
    }

    public function scopeInAbout($query)
    {
        return $query
            ->where('in_about', true)->take(10);
    }

    public function scopeInProduct($query)
    {
        return $query
            ->where('in_product', true)->take(5);
    }
}
