@extends('layouts.auth')
@section('content')
<link rel="stylesheet" href="/css/auth-game.css">
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">

<div class="auth-container">
    <div class="auth-card">

        <h2 class="auth-title">Login Kerajaan</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3 text-start">
                <label>Email</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            </div>

            <div class="mb-3 text-start">
                <label>Password</label>
                <input id="password" type="password" class="form-control" name="password" required>
            </div>

            <button type="submit" class="btn-gold">Masuk</button>

            <p class="mt-3">
                Belum punya akun?
                <a href="{{ route('register') }}" style="color: var(--gold)">Daftar</a>
            </p>

        </form>

    </div>
</div>
@endsection
