<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; // Make sure this is 'users'

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // Ensure 'role' is fillable
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    // --- Add these methods to your User model ---

    /**
     * Check if the user has the 'owner' role.
     *
     * @return bool
     */
    public function isOwner(): bool
    {
        return $this->role === 'owner';
    }

    /**
     * Check if the user has the 'admin' role.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    /**
     * Check if the user has the 'pembeli' role.
     *
     * @return bool
     */
    public function isPembeli(): bool
    {
        return $this->role === 'pembeli';
    }

    // --- You might also have relationships here, e.g. ---
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}