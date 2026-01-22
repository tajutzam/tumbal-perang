@extends('layouts.auth')

@section('content')
<link rel="stylesheet" href="/css/auth-game.css">

<div class="auth-container">
    <div class="auth-card">

        <h2 class="auth-title">Konfirmasi Password</h2>

        <p>Masukkan password Anda untuk melanjutkan.</p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="mb-3 text-start">
                <label>Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>

            <button type="submit" class="btn-gold">Konfirmasi</button>
        </form>

    </div>
</div>
@endsection
