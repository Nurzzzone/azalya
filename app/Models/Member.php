<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $fillable = [
        'fullname',
        'position',
        'image',
        'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean'
    ];
}
