<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Format extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug'];
    protected $hidden = ['pivot'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'products_has_formats');
    }
}
