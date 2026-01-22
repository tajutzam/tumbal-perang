<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserResource;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'tribe_id',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // ==============================
    // RELASI SUKU
    // ==============================
    public function tribe()
    {
        return $this->belongsTo(Tribe::class);
    }

    // ==============================
    // RELASI RESOURCE (emas & troops)
    // ==============================
    public function resource()
    {
        return $this->hasOne(UserResource::class, 'user_id');
    }

    // ==============================
    // RELASI BANGUNAN USER
    // ==============================
    public function userBuildings()
    {
        return $this->hasMany(UserBuilding::class, 'user_id');
    }

    // ==============================
    // CEK ADMIN
    // ==============================
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
}
