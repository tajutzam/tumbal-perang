<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function __construct()
    {
        
        $this->middleware('auth')->only('logout');
    }

    protected function redirectTo()
    {
        if (auth()->user()->role === 'admin') {
        return '/admin/dashboard';
    }


        return '/home';
    }

}
