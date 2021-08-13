<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use ChristianKuri\LaravelFavorite\Traits\Favoriteability;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;
    use HasFactory;
    use Favoriteability;
    
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'address'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'deleted_at'
    ];

    protected $attributes = [ 
        'menuroles' => 'user',
    ];

    public function scopeAuthenticated($query, $request)
    {
        return $query->where('email', $request['email'] ?? null)
            ->orWhere('phone_number', $request['phone_number'] ?? null)
            ->first();
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    public function favourites()
    {
        return $this->belongsToMany(Product::class, 'user_has_favourite_products');
    }
}
