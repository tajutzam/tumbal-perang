@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="/css/auth-game.css">

<div class="auth-container">
    <div class="auth-card">

        <h2 class="auth-title">Reset Password</h2>

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            
            <div class="mb-3 text-start">
                <label>Email</label>
                <input id="email" type="email" class="form-control" name="email" required>
            </div>

            <button type="submit" class="btn-gold">Kirim Link Reset</button>

        </form>

    </div>
</div>
@endsection
