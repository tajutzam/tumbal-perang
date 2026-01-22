@extends('layouts.auth')

@section('content')
<link rel="stylesheet" href="/css/auth-game.css">

<div class="auth-container">
    <div class="auth-card">

        <h2 class="auth-title">Verifikasi Email</h2>

        @if (session('resent'))
            <div class="alert alert-success">
                Link verifikasi baru telah dikirim ke email Anda.
            </div>
        @endif

        <p>Periksa email Anda dan klik link verifikasi.</p>
        <p>Belum menerima email?</p>

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn-gold">Kirim Ulang Verifikasi</button>
        </form>
    </div>
</div>
@endsection
