@extends('layouts.game')

@section('content')

<div class="reward-container">

    <h1 class="title-main">🎁 Hadiah Harian</h1>

    <p class="reward-text">
        Login setiap hari untuk mendapatkan hadiah perang yang berguna!
    </p>

    <a href="{{ route('reward.claim') }}" class="reward-btn">
        Ambil Hadiah Hari Ini
    </a>

</div>

@endsection

<style>

.reward-container {
    max-width: 600px;
    margin: 40px auto;
    padding: 30px;
    text-align: center;
    background: rgba(25,20,16,0.6);
    border: 1px solid #D4AF37;
    border-radius: 10px;
    font-family: 'Cinzel';
    color: #f5e9c6;
}

.reward-text {
    font-size: 20px;
    margin: 15px 0 25px;
}

.reward-btn {
    display: inline-block;
    padding: 12px 25px;
    background: #D4AF37;
    color: #2a1e0a;
    font-weight: bold;
    text-decoration: none;
    border-radius: 8px;
    transition: 0.3s;
}

.reward-btn:hover {
    background: #f5d97d;
}

.title-main {
    color: #ffd86b;
    margin-bottom: 15px;
    font-size: 32px;
}

</style>
