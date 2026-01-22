<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Tribe;
use App\Models\UserResource;
use App\Models\UserBuilding;
use App\Models\Building;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $tribes = Tribe::all();
        return view('auth.register', compact('tribes'));
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:3', 'confirmed'],
            'tribe_id' => ['required', 'exists:tribes,id'],
        ]);
    }

    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'tribe_id' => $data['tribe_id'],
        ]);

        // Resource awal
        UserResource::create([
            'user_id' => $user->id,
            'gold' => 0,
            'troops' => 0,
            'last_updated' => now(),
        ]);

        // Tambahkan bangunan utama
        $mainBuilding = Building::where('name', 'Bangunan Utama')->first();

        if ($mainBuilding) {
            UserBuilding::create([
                'user_id' => $user->id,
                'building_id' => $mainBuilding->id,
                'level' => 1,
            ]);
        }

        return $user;
    }

    protected function registered(Request $request, $user)
    {
        auth()->logout();
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
    }
}
