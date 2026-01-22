<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyReward extends Model
{
    use HasFactory;

    protected $table = 'daily_rewards';

    protected $fillable = [
        'user_id',
        'last_claim',
    ];
}
