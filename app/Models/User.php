<?php

namespace App\Models;

use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use ChristianKuri\LaravelFavorite\Traits\Favoriteability;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;
    use HasFactory;
    use Favoriteability;
    
    protected $table = 'users';

    /**
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'address'
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
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

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
