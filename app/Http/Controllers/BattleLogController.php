<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\BattleLog;

class BattleLogController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil semua log yang melibatkan user
        $logs = BattleLog::where('attacker_id', $user->id)
            ->orWhere('defender_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->with(['attacker', 'defender'])
            ->get();

        return view('battle.logs', compact('logs'));
    }
}
