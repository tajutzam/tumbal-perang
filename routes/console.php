<?php
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Models\UserResource;
use App\Models\UserBuilding;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');


Schedule::call(function () {

    $users = UserResource::all();

    foreach ($users as $res) {

        $buildings = UserBuilding::where('user_id', $res->user_id)
                                 ->with('building')
                                 ->get();

        // Default
        $goldPerMinute = 5;
        $troopPerMinute = 0;

        $user = \App\Models\User::find($res->user_id);
        $tribe = $user->tribe;

        foreach ($buildings as $b) {

            // ---- GOLD DARI BUILDING ----
            $goldPerMinute += $b->building->gold_per_minute;

            // ---- TROOPS DARI BARAK ----
            if ($b->building->name === 'Barak') {
                $troopPerMinute += $tribe->troops_per_barrack;
            }
        }

        // Simpan hasil
        $res->gold   += $goldPerMinute;
        $res->troops += $troopPerMinute;
        $res->save();
    }

})->everyMinute();
