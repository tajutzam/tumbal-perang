<?php

namespace App\Http\Controllers;

use App\Models\DailyReward;
use App\Models\UserResource;
use Carbon\Carbon;

class RewardController extends Controller
{
    public function claim()
    {
        $user = auth()->user();
        $today = Carbon::today();

        // Ambil atau buat record reward
        $reward = DailyReward::firstOrCreate(
            ['user_id' => $user->id]
        );

        // Cek claim hari ini
        if ($reward->last_claim && Carbon::parse($reward->last_claim)->isSameDay($today)) {
            return back()->with('error', 'Kamu sudah claim reward hari ini.');
        }

        // Update tanggal claim
        $reward->last_claim = $today;
        $reward->save();

        // Ambil atau buat resource user
        $resources = $user->resource;

        if (!$resources) {
            $resources = UserResource::create([
                'user_id' => $user->id,
                'gold' => 0,
                'troops' => 0,
            ]);
        }

        // Tambah gold
        $resources->gold += 100; 
        $resources->bonus_gold += 100;
        $resources->save();

        return back()->with('success', 'Kamu mendapatkan 100 Gold!');
    }
}
