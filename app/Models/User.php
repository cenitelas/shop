<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'email', 'password','role_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::deleting(function (User $user){
            foreach ($user->products() as $product)
                $product->deleteImage();
        });
    }

    function role(){
        return $this->belongsTo(Role::class);
    }

    function categories(){
        return $this->hasMany(Category::class);
    }

    function carts(){
        return $this->hasMany(Cart::class);
    }

    function orders(){
        return $this->hasMany(Order::class);
    }

    function products(){
        return $this->hasMany(Product::class);
    }
}
