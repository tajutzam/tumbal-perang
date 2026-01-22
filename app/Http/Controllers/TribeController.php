<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tribe;

class TribeController extends Controller
{
    public function showChooseTribe()
    {
        $tribes = Tribe::all();
        return view('choose-tribe', compact('tribes'));
    }

    public function storeTribe(Request $request)
    {
        $request->validate([
            'tribe_id' => 'required|exists:tribes,id'
        ]);

        $user = Auth::user();
        $user->tribe_id = $request->tribe_id;
        $user->save();

        return redirect('/home')->with('success', 'Suku berhasil dipilih!');
    }

    // =====================
    // ADMIN PANEL
    // =====================

    public function adminIndex()
    {
        $tribes = Tribe::all();
        return view('admin.tribes.index', compact('tribes'));
    }

    public function edit($id)
    {
        $tribe = Tribe::findOrFail($id);
        return view('admin.tribes.edit', compact('tribe'));
    }

    public function update(Request $request, $id)
    {
        $tribe = Tribe::findOrFail($id);

        $request->validate([
            'attack_magic' => 'required|integer',
            'attack_range' => 'required|integer',
            'attack_melee' => 'required|integer',
            'def_magic'    => 'required|integer',
            'def_range'    => 'required|integer',
            'def_melee'    => 'required|integer',
            'troops_per_barrack' => 'required|integer|min:1',  // <= DITAMBAHKAN
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:20480'
        ]);

        // UPDATE ATTRIBUTE TERMASUK troops_per_barrack
        $tribe->update([
            'attack_magic' => $request->attack_magic,
            'attack_range' => $request->attack_range,
            'attack_melee' => $request->attack_melee,
            'def_magic'    => $request->def_magic,
            'def_range'    => $request->def_range,
            'def_melee'    => $request->def_melee,
            'troops_per_barrack' => $request->troops_per_barrack, // <= DITAMBAHKAN
        ]);

        // Upload gambar
        if ($request->hasFile('image')) {

            if ($tribe->image && file_exists(public_path('tribes/'.$tribe->image))) {
                unlink(public_path('tribes/'.$tribe->image));
            }

            $file = $request->file('image');
            $filename = strtolower($tribe->name) . '_' . time() . '.' . $file->getClientOriginalExtension();

            if (!file_exists(public_path('tribes'))) {
                mkdir(public_path('tribes'), 0755, true);
            }

            $file->move(public_path('tribes'), $filename);

            $tribe->image = $filename;
            $tribe->save();
        }

        return redirect()->route('admin.tribes')->with('success', 'Atribut suku & gambar berhasil diperbarui!');
    }
}
