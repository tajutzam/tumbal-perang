<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Leaderboard kemenangan
        $wins = User::select(
                'users.id',
                'users.name',
                DB::raw('COUNT(battle_logs.id) as win_count')
            )
            ->leftJoin('battle_logs', function ($join) {
                $join->on('users.id', '=', 'battle_logs.attacker_id')
                     ->where('battle_logs.attacker_won', 1);
            })
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('win_count')
            ->take(20)
            ->get();

        // Leaderboard jumlah serangan
        $attacks = User::select(
                'users.id',
                'users.name',
                DB::raw('COUNT(battle_logs.id) as attack_count')
            )
            ->leftJoin('battle_logs', 'users.id', '=', 'battle_logs.attacker_id')
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('attack_count')
            ->take(20)
            ->get();

        return view('leaderboard.index', compact('wins', 'attacks'));
    }
}
