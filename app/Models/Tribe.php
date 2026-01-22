<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tribe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'attack_magic',
        'attack_range',
        'attack_melee',
        'def_magic',
        'def_range',
        'def_melee',
        'head',
        'body',
        'legs',
        'hands',
        'image',
        'troops_per_barrack'
    ];
}
