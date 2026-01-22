<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BattleLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'attacker_id',
        'defender_id',
        'attacker_troops_before',
        'defender_troops_before',
        'attacker_troops_after',
        'defender_troops_after',
        'gold_transferred',
        'attacker_won',
        'notes',
    ];

    public function attacker()
    {
        return $this->belongsTo(User::class, 'attacker_id');
    }

    public function defender()
    {
        return $this->belongsTo(User::class, 'defender_id');
    }
}
