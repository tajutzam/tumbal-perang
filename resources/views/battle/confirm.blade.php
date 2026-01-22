@extends('layouts.game')

@section('content')

<div class="confirm-container">

    <h1 class="confirm-title">⚔️ Konfirmasi Serangan</h1>

    <p class="text-center" style="font-size:20px;">
        Apakah kamu yakin ingin menyerang <strong>{{ $target->name }}</strong>?
    </p>

    <p class="text-center">
        Suku: <strong>{{ $target->tribe->name }}</strong>
    </p>

    <p class="text-center">💰 Gold: {{ $target->resource->gold }}</p>
    <p class="text-center">⚔ Troops: {{ $target->resource->troops }}</p>

    <div class="btn-row">
        <form action="{{ route('battle.attack', $target->id) }}" method="POST">
            @csrf
            <button class="btn-attack-big">⚔️ Serang Sekarang</button>
        </form>
        
        <a href="{{ route('battle.targets') }}" class="btn-cancel">Batal</a>
    </div>

</div>

@endsection

<style>
.confirm-container {
    max-width: 600px;
    margin: 50px auto;
    padding: 30px;
    background: rgba(0,0,0,0.5);
    border: 1px solid #D4AF37;
    border-radius: 10px;
    text-align: center;
    font-family: 'Cinzel';
    color: #f5e9c6;
}
.btn-row {
    margin-top: 25px;
}
.btn-attack-big {
    padding: 12px 25px;
    background: #c62828;
    color: white;
    font-size: 18px;
    font-weight: bold;
    border-radius: 8px;
    border: none;
}
.btn-attack-big:hover {
    background: #ff4d4d;
}
.btn-cancel {
    margin-left: 20px;
    font-size: 16px;
    text-decoration: underline;
    color: #D4AF37;
}
</style>
