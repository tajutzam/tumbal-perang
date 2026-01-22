@extends('layouts.game')

@section('content')

<div class="stats-container">

    <h1 class="title-main">📊 Statistik Peperangan Saya</h1>

    <ul class="stats-list">
        <li><strong>Total Serangan Dilakukan:</strong> {{ $total_attacks }}</li>
        <li><strong>Total Diserang:</strong> {{ $total_defends }}</li>
        <li><strong>Menang:</strong> <span class="green">{{ $wins }}</span></li>
        <li><strong>Kalah:</strong> <span class="red">{{ $losses }}</span></li>
        <li><strong>Win Rate:</strong> {{ $win_rate }}%</li>
    </ul>

</div>

@endsection

<style>

.stats-container {
    max-width: 700px;
    margin: 40px auto;
    padding: 30px;
    font-family: 'Cinzel';
    background: rgba(25,20,16,0.6);
    border: 1px solid #D4AF37;
    border-radius: 10px;
    color: #f5e9c6;
}

.title-main {
    text-align: center;
    color: #ffd86b;
    margin-bottom: 20px;
    font-size: 32px;
}

.stats-list {
    list-style: none;
    padding: 0;
}

.stats-list li {
    padding: 12px;
    border-bottom: 1px solid rgba(212,175,55,0.3);
    font-size: 20px;
}

.green { color: #4CAF50; }
.red { color: #d9534f; }

</style>
