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
}
