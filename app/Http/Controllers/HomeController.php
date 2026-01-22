<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserResource;   // <- WAJIB

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard (home player).
     */
    public function index()
    {
        $user = auth()->user();

        // Ambil gold & troops user
        $resources = UserResource::where('user_id', $user->id)->first();

        return view('home', compact('user', 'resources'));
    }
}
