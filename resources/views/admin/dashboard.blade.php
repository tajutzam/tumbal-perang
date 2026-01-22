@extends('layouts.game')

@section('content')

<div class="admin-dashboard">

    <h1 class="title-main">⚔️ Panel Admin — Dashboard</h1>

    <div class="admin-grid">

        <a href="{{ route('admin.tribes') }}" class="admin-card">
            <div class="icon">🏹</div>
            <h2>Kelola Suku</h2>
            <p>Edit atribut dan gambar suku.</p>
        </a>

        <a href="{{ route('admin.buildings') }}" class="admin-card">
            <div class="icon">🏰</div>
            <h2>Kelola Bangunan</h2>
            <p>Atur harga & produksi bangunan.</p>
        </a>

        <a href="{{ route('admin.users') }}" class="admin-card">
            <div class="icon">👤</div>
            <h2>Kelola Pengguna</h2>
            <p>Lihat, edit, dan hapus pengguna.</p>
        </a>
    </div>

</div>

@endsection


<style>

.admin-dashboard {
    max-width: 900px;
    margin: 50px auto;
    padding: 30px;
    background: rgba(0,0,0,0.35);
    border: 1px solid #D4AF37;
    border-radius: 12px;
    font-family: 'Cinzel';
    text-align: center;
    color: #f5e9c6;
}

.title-main {
    font-size: 32px;
    color: #D4AF37;
    margin-bottom: 30px;
}

.admin-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 25px;
}

.admin-card {
    background: rgba(25, 20, 16, 0.9);
    border: 1px solid #D4AF37;
    border-radius: 10px;
    padding: 25px;
    text-decoration: none;
    color: #f5e9c6;
    transition: 0.3s;
}

.admin-card:hover {
    background: rgba(212,175,55,0.15);
    border-color: #f8d878;
    transform: translateY(-5px);
}

.icon {
    font-size: 45px;
    margin-bottom: 10px;
}

.disabled {
    opacity: 0.5;
    pointer-events: none;
}

</style>
