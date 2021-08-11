<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    /**
     * Table name
     * @var string
     */
    protected $table = 'users_profile';

    /**
     * Mass-assignable attributes
     * @var string[]
     */
    protected $fillable = [
        'name',
        'surname',
        'middle_name',
        'image'
    ];

    /**
     * User related to profile
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
