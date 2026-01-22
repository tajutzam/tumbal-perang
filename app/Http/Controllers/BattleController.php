<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\UserResource;
use App\Models\UserBuilding;
use App\Models\Tribe;
use App\Models\BattleLog;

class BattleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function targets()
    {
        $me = Auth::user();

        $targets = User::where('id','!=',$me->id)
            ->whereHas('userBuildings', fn($q)=>$q->whereHas('building', fn($b)=>$b->where('name','Tambang')))
            ->whereHas('userBuildings', fn($q)=>$q->whereHas('building', fn($b)=>$b->where('name','Barak')))
            ->with(['tribe','resource','userBuildings.building'])
            ->get();

        return view('battle.index', compact('targets'));
    }


    public function confirm($id)
    {
        $me = Auth::user();
        $target = User::with(['tribe','resource','userBuildings.building'])->findOrFail($id);

        if ($target->id == $me->id) {
            return redirect()->route('battle.targets')->with('error','Tidak bisa menyerang diri sendiri.');
        }

        return view('battle.confirm', compact('target'));
    }


    public function attack(Request $request, $id)
    {
        $attacker = Auth::user();
        $defender = User::with(['tribe','resource','userBuildings.building'])->findOrFail($id);

        if ($attacker->id == $defender->id) {
            return back()->with('error','Tidak bisa menyerang diri sendiri.');
        }

        // syarat barak + tambang
        $hasTambang = $defender->userBuildings->contains(fn($b) => $b->building->name === 'Tambang');
        $hasBarak   = $defender->userBuildings->contains(fn($b) => $b->building->name === 'Barak');

        if (!$hasTambang || !$hasBarak) {
            return back()->with('error','Target tidak punya barak & tambang.');
        }

        $attRes = $attacker->resource;
        $defRes = $defender->resource;

        $attTroops = (int)$attRes->troops;
        $defTroops = (int)$defRes->troops;

        if ($attTroops <= 0) {
            return back()->with('error','Tidak punya pasukan.');
        }

        // tribe stats per 1 pasukan
        $attPower = max(1,
            $attacker->tribe->attack_magic +
            $attacker->tribe->attack_range +
            $attacker->tribe->attack_melee
        );

        $defPower = max(1,
            $defender->tribe->def_magic +
            $defender->tribe->def_range +
            $defender->tribe->def_melee
        );

        // bonus defense dari bangunan
        $buildingBonus = $defender->userBuildings->sum(fn($b) =>
            $b->building->defense_bonus * max(1,$b->level)
        );

        // total power
        $totalAttack  = $attPower * $attTroops;
        $totalDefense = ($defPower * $defTroops) + $buildingBonus;

        DB::beginTransaction();
        try {

            // ===================
            // ATTACKER MENANG
            // ===================
            if ($totalAttack > $totalDefense) {

                $goldTaken = floor($defRes->gold * 0.9);

                $defRes->gold -= $goldTaken;
                $attRes->gold += $goldTaken;

                $defRes->troops = 0;
                $defRes->save();
                $attRes->save();

                // 📝 SIMPAN LOG
                BattleLog::create([
                    'attacker_id' => $attacker->id,
                    'defender_id' => $defender->id,
                    'attacker_troops_before' => $attTroops,
                    'defender_troops_before' => $defTroops,
                    'attacker_troops_after' => $attTroops,
                    'defender_troops_after' => 0,
                    'gold_transferred' => $goldTaken,
                    'attacker_won' => true,
                    'notes' => "Attacker won. totalAttack={$totalAttack}, totalDefense={$totalDefense}"
                ]);

                DB::commit();

                return redirect()->route('battle.targets')
                    ->with('success',"Serangan berhasil! Mendapat {$goldTaken} gold.");
            }

            // ===================
            // ATTACKER KALAH
            // ===================
            $difference = $totalDefense - $totalAttack;

            if ($defTroops > 0) {
                $defensePerTroopEff = $totalDefense / $defTroops;
                $survivors = floor($difference / $defensePerTroopEff);
            } else {
                $survivors = 0;
            }

            $survivors = max(0, min($survivors, $defTroops));

            $attRes->troops = 0;
            $defRes->troops = $survivors;

            $attRes->save();
            $defRes->save();

            // 📝 SIMPAN LOG
            BattleLog::create([
                'attacker_id' => $attacker->id,
                'defender_id' => $defender->id,
                'attacker_troops_before' => $attTroops,
                'defender_troops_before' => $defTroops,
                'attacker_troops_after' => 0,
                'defender_troops_after' => $survivors,
                'gold_transferred' => 0,
                'attacker_won' => false,
                'notes' => "Attacker lost. survivors={$survivors}, totalAttack={$totalAttack}, totalDefense={$totalDefense}"
            ]);

            DB::commit();

            return redirect()->route('battle.targets')
                ->with('error',"Serangan gagal. Pasukan bertahan tersisa {$survivors}.");

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error','Error: '.$e->getMessage());
        }
    }
}
