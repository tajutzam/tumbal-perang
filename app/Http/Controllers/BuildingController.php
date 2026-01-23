<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserResource;
use App\Models\UserBuilding;
use App\Models\Building;

class BuildingController extends Controller
{
    /**
     * HALAMAN BANGUNAN USER
     */
    public function index()
    {
        $user = Auth::user();

        $resources = UserResource::where('user_id', $user->id)->firstOrFail();

        $buildings = UserBuilding::where('user_id', $user->id)
            ->with('building')
            ->get();

        $allBuildings = Building::all();

        return view('buildings.index', compact(
            'user',
            'resources',
            'buildings',
            'allBuildings'
        ));
    }

    /**
     * BUILD BANGUNAN
     */
    public function build($building_id)
    {
        $user = Auth::user();

        $res = UserResource::where('user_id', $user->id)->firstOrFail();
        $building = Building::findOrFail($building_id);

        // ❌ LARANG BANGUN BANGUNAN UTAMA
        if ($building->name === 'Bangunan Utama') {
            return back()->with('error', 'Bangunan utama sudah tersedia dari awal.');
        }

        // CEK EMAS
        if ($res->gold < $building->price) {
            return back()->with('error', 'Emas tidak cukup!');
        }

        // KURANGI EMAS
        $res->gold -= $building->price;
        $res->save();

        // SIMPAN BANGUNAN
        UserBuilding::create([
            'user_id'     => $user->id,
            'building_id' => $building_id,
            'level'       => 1,
        ]);

        return back()->with('success', 'Bangunan berhasil dibuat!');
    }

    /**
     * HAPUS BANGUNAN USER
     */
    public function destroy($user_building_id)
    {
        $user = Auth::user();

        $userBuilding = UserBuilding::where('id', $user_building_id)
            ->where('user_id', $user->id)
            ->with('building')
            ->firstOrFail();

        // ❌ LARANG HAPUS BANGUNAN UTAMA
        if ($userBuilding->building->name === 'Bangunan Utama') {
            return back()->with('error', 'Bangunan utama tidak bisa dihapus.');
        }

        $userBuilding->delete();

        return back()->with('success', 'Bangunan berhasil dihapus.');
    }

    // =====================
    // ADMIN
    // =====================

    public function adminIndex()
    {
        $buildings = Building::all();
        return view('admin.buildings.index', compact('buildings'));
    }

    public function adminEdit($id)
    {
        $building = Building::findOrFail($id);
        return view('admin.buildings.edit', compact('building'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $building = Building::findOrFail($id);

        $request->validate([
            'price'            => 'required|integer|min:0',
            'gold_per_minute'  => 'required|integer|min:0',
            'troop_per_minute' => 'required|integer|min:0',
            'defense_bonus'    => 'required|integer|min:0',
        ]);

        $building->update($request->only([
            'price',
            'gold_per_minute',
            'troop_per_minute',
            'defense_bonus'
        ]));

        return redirect()
            ->route('admin.buildings')
            ->with('success', 'Bangunan berhasil diperbarui!');
    }
}
