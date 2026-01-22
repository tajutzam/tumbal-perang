<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserResource extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'gold',
        'bonus_gold',
        'troops',
        'last_updated',
    ];

    public $timestamps = false;

    public function user() {
        return $this->belongsTo(User::class);
    }
}
