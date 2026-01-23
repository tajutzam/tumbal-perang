@extends('layouts.game')

@section('content')

<div class="build-container">

    <h1 class="build-title">🏰 Kerajaan — Bangunan Kamu</h1>

    {{-- RESOURCE --}}
    <div class="resource-box">
        <p>💰 Gold: <span>{{ $resources->gold }}</span></p>
        <p>⚔ Troops: <span>{{ $resources->troops }}</span></p>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <h2 class="sub-title">🔧 Bangunan Kamu</h2>

    <table class="build-table">
        <thead>
            <tr>
                <th>Bangunan</th>
                <th>Level</th>
                <th>Produksi</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
        @foreach ($buildings as $ub)
            <tr>
                <td>{{ $ub->building->name }}</td>
                <td>Lv {{ $ub->level }}</td>

                <td>
                    @if($ub->building->gold_per_minute > 0)
                        +{{ $ub->building->gold_per_minute }} gold/min
                    @endif

                    @if($ub->building->troop_per_minute > 0)
                        +{{ $ub->building->troop_per_minute }} troops/min
                    @endif
                </td>

                <td>
                    @if($ub->building->name != 'Bangunan Utama')
                        <form method="POST"
                              action="{{ route('buildings.destroy', $ub->id) }}"
                              onsubmit="return confirm('Yakin ingin menghapus bangunan ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete">Hapus</button>
                        </form>
                    @else
                        -
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <h2 class="sub-title">➕ Bangun Bangunan Baru</h2>

    <div class="build-options">
        @foreach ($allBuildings->where('name', '!=', 'Bangunan Utama') as $b)
            <div class="build-card">
                <h3>{{ $b->name }}</h3>

                <p>💰 Biaya: {{ $b->price }} gold</p>

                @if($b->gold_per_minute)
                    <p>+{{ $b->gold_per_minute }} gold/min</p>
                @endif

                @if($b->troop_per_minute)
                    <p>+{{ $b->troop_per_minute }} troops/min</p>
                @endif

                <form method="POST" action="{{ route('buildings.build', $b->id) }}">
                    @csrf
                    <button class="btn-build">Bangun</button>
                </form>
            </div>
        @endforeach
    </div>
</div>

@endsection


<style>
.build-container {
    max-width: 900px;
    margin: 40px auto;
    padding: 30px;
    background: rgba(0,0,0,0.45);
    border: 1px solid #D4AF37;
    border-radius: 10px;
    font-family: 'Cinzel';
    color: #f5e9c6;
}

.build-title {
    color: #D4AF37;
    text-align: center;
    margin-bottom: 20px;
}

.sub-title {
    color: #D4AF37;
    margin-top: 30px;
}

.resource-box {
    display: flex;
    justify-content: space-between;
    background: rgba(255,255,255,0.1);
    padding: 15px;
    border-radius: 8px;
    border: 1px solid #D4AF37;
}

.build-table {
    width: 100%;
    margin-top: 15px;
    border-collapse: collapse;
}

.build-table th {
    color: #D4AF37;
    padding: 10px;
    background: #2a221b;
}

.build-table td {
    padding: 10px;
    border-bottom: 1px solid rgba(212,175,55,0.3);
}

.build-card {
    border: 1px solid #D4AF37;
    border-radius: 10px;
    padding: 15px;
    width: 260px;
    background: rgba(0,0,0,0.35);
    margin: 15px;
}

.build-options {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
}

.btn-build {
    background: #D4AF37;
    color: #2a221b;
    padding: 8px 15px;
    border-radius: 6px;
    border: none;
    font-weight: bold;
    cursor: pointer;
}

.btn-build:hover {
    background: #f3d675;
}

.btn-delete {
    background: #a83232;
    color: #fff;
    padding: 8px 15px;
    border-radius: 6px;
    border: none;
    font-weight: bold;
    cursor: pointer;
}

.btn-delete:hover {
    background: #d64545;
}

.alert-success {
    background: rgba(0,255,0,0.2);
    padding: 10px;
    margin-bottom: 15px;
}

.alert-error {
    background: rgba(255,0,0,0.2);
    padding: 10px;
    margin-bottom: 15px;
}
</style>
