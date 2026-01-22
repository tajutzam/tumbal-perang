<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    protected $fillable = [
        'name',
        'price',
        'gold_per_minute',
        'troop_per_minute',
        'defense_bonus',
    ];
}
