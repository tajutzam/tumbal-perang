<?php

namespace App\Http\Controllers;

use App\Models\BattleLog;

class StatsController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $total_attacks = BattleLog::where('attacker_id', $user->id)->count();
        $total_defends = BattleLog::where('defender_id', $user->id)->count();

        $wins = BattleLog::where('attacker_id', $user->id)
                         ->where('attacker_won', 1)
                         ->count();

        $losses = $total_attacks - $wins;

        $win_rate = $total_attacks > 0 
            ? round(($wins / $total_attacks) * 100, 2)
            : 0;

        return view('stats.index', compact(
            'total_attacks', 'total_defends', 'wins', 'losses', 'win_rate'
        ));
    }
}
        