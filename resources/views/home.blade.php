@extends('layouts.game')

@section('content')

<div class="dashboard-container">

    {{-- PANEL KIRI: Ringkasan Resources --}}
    <div class="side-panel left-panel animated-fade">
        <h3 class="panel-title">📦 Resources</h3>

        <div class="resource-item">
            <span>💰 Gold</span>
            <strong>{{ $resources->gold }}</strong>
        </div>

        <div class="resource-item">
            <span>⚔ Troops</span>
            <strong>{{ $resources->troops }}</strong>
        </div>

        <div class="resource-item">
            <span>🏰 Suku</span>
            <strong>{{ $user->tribe ? $user->tribe->name : '-' }}</strong>
        </div>
    </div>



    {{-- PANEL TENGAH: Kerajaan --}}
    <div class="center-panel animated-rise">

        <h2 class="center-title glow-text">Kerajaan Kamu</h2>

        <p class="center-subtext">
            Selamat datang,
            <strong class="highlight">{{ $user->name }}</strong>!
        </p>

        {{-- IMAGE --}}
        <div class="kingdom-image-box">
            <img src="{{ asset('tribes/' . ($user->tribe->image ?? 'default.png')) }}"
                 class="kingdom-image hover-glow">
        </div>
    </div>



    {{-- PANEL KANAN: Menu --}}
    <div class="side-panel right-panel animated-fade">

        <h3 class="panel-title">⚙ Menu Kerajaan</h3>

        <a href="{{ route('battle.targets') }}" class="menu-btn">⚔ Serang Kerajaan</a>
        <a href="{{ url('/buildings') }}" class="menu-btn">🏰 Bangunan</a>
        <a href="{{ route('battle.logs') }}" class="menu-btn">📜 Riwayat Perang</a>
        <a href="{{ url('/leaderboard') }}" class="menu-btn">🏆 Leaderboard</a>
        <a href="{{ url('/stats') }}" class="menu-btn">📊 Statistik</a>
        <a href="{{ url('/reward') }}" class="menu-btn">🎁 Hadiah Harian</a>

    </div>

</div>

@endsection


<style>

body {
    background: linear-gradient(#0e0b07, #1d160f);
}

/* ========== ANIMATIONS ========== */
@keyframes rise {
    from { opacity:0; transform: translateY(30px); }
    to { opacity:1; transform: translateY(0); }
}
@keyframes fade {
    from { opacity:0; }
    to { opacity:1; }
}
.animated-rise { animation: rise 1.1s ease-out; }
.animated-fade { animation: fade 1.4s ease-out; }

/* ========== LAYOUT UTAMA ========== */
.dashboard-container {
    display: grid;
    grid-template-columns: 1fr 1.5fr 1fr;
    gap: 25px;
    max-width: 1200px;
    margin: 40px auto;
    padding: 20px;
}

/* ========== SIDE PANELS ========== */
.side-panel {
    background: rgba(25,20,16,0.55);
    border: 1px solid #D4AF37;
    border-radius: 12px;
    padding: 20px;
    color: #f5e9c6;
    box-shadow: 0 0 18px rgba(212,175,55,0.18);
    height: fit-content;
}

.panel-title {
    font-size: 24px;
    color: #FFD36A;
    text-align: center;
    margin-bottom: 18px;
}

/* ========== RESOURCE LIST ========== */
.resource-item {
    display: flex;
    justify-content: space-between;
    padding: 8px 0;
    border-bottom: 1px dashed rgba(255,215,100,0.4);
}

/* ========== CENTER PANEL (KINGDOM) ========== */
.center-panel {
    background: rgba(30,25,18,0.7);
    border: 2px solid #D4AF37;
    border-radius: 15px;
    text-align: center;
    padding: 30px;
    box-shadow: 0 0 25px rgba(212,175,55,0.25);
}

.center-title {
    font-size: 36px;
    margin-bottom: 8px;
    color: #FFD36A;
}
.center-subtext { font-size: 20px; }


/* ========== IMAGE KINGDOM ========== */
.kingdom-image-box {
    margin-top: 20px;
}
.kingdom-image {
    width: 300px;
    border: 3px solid #D4AF37;
    border-radius: 12px;
    transition: 0.3s;
}
.hover-glow:hover {
    box-shadow: 0 0 25px rgba(255,215,120,0.9);
    transform: scale(1.05);
}

/* ========== MENU BUTTONS ========== */
.menu-btn {
    display: block;
    text-align: center;
    padding: 12px;
    margin-bottom: 12px;
    background: #D4AF37;
    color: #2a1e0a;
    border-radius: 8px;
    text-decoration: none;
    font-weight: bold;
    transition: 0.3s;
    font-size: 18px;
}
.menu-btn:hover {
    background: #ffe8a5;
    box-shadow: 0 0 12px rgba(255,215,100,0.7);
    transform: translateY(-3px);
}

/* Highlight Text */
.highlight {
    color: #FFD36A;
    text-shadow: 0 0 8px rgba(255,210,100,0.8);
}

.glow-text {
    text-shadow: 0 0 12px rgba(255,228,150,0.9);
}

</style>
