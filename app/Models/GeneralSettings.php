<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSettings extends Model
{
    use HasFactory;
    protected $table = 'general_settings';
    protected $fillable = [
        'name',
        'phone_number',
        'instagram',
        'facebook',
        'image',
        'whatsapp'
    ];
}