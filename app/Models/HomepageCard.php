<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageCard extends Model
{
    use HasFactory;
    protected $table = 'homepage_cards';
    protected $fillable = [
        'name',
        'image',
    ];

    public function scopeInHome($query)
    {
        return $query
            ->where('is_active', true)
            ->where('in_homepage', true)->get();
    }
}
