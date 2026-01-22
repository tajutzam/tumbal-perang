@extends('layouts.auth')
@section('content')

<link rel="stylesheet" href="/css/auth-game.css">
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">

<div class="auth-container">
    <div class="auth-card" style="width: 450px;">

        <h2 class="auth-title">Daftar Kerajaan</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- USERNAME --}}
            <div class="mb-3 text-start">
                <label>Username</label>
                <input id="name" 
                       type="text" 
                       class="form-control" 
                       name="name" 
                       value="{{ old('name') }}" 
                       required autofocus>
            </div>

            {{-- EMAIL --}}
            <div class="mb-3 text-start">
                <label>Email</label>
                <input id="email" 
                       type="email" 
                       class="form-control" 
                       name="email" 
                       required>
            </div>

            {{-- PASSWORD --}}
            <div class="mb-3 text-start">
                <label>Password</label>
                <input id="password" 
                       type="password" 
                       class="form-control" 
                       name="password" 
                       required>
            </div>

            {{-- CONFIRM PASSWORD --}}
            <div class="mb-3 text-start">
                <label>Konfirmasi Password</label>
                <input id="password-confirm" 
                       type="password" 
                       class="form-control" 
                       name="password_confirmation" 
                       required>
            </div>

            {{-- PILIH SUKU --}}
            <div class="mb-3 text-start">
                <label>Pilih Suku</label>
                <select id="tribe_id" 
                        name="tribe_id" 
                        class="form-control" 
                        required>

                    <option value="">-- Pilih Suku --</option>

                    @foreach ($tribes as $tribe)
                        <option value="{{ $tribe->id }}">
                            {{ $tribe->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- TOMBOL --}}
            <button type="submit" class="btn-gold mt-3">Daftar</button>

            <p class="mt-3">
                Sudah punya akun? 
                <a href="{{ route('login') }}" style="color: var(--gold)">Login</a>
            </p>

        </form>

    </div>
</div>

@endsection
