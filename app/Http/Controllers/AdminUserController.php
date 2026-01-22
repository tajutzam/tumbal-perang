<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()->route('admin.users')
            ->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->route('admin.users')
            ->with('success', 'Pengguna berhasil dihapus');
    }
}
