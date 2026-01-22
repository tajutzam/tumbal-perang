@extends('layouts.game')

@section('content')

<div class="admin-container">

    <h1 class="title-main">🏰 Panel Admin – Pengaturan Bangunan</h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table class="building-table">
        <thead>
            <tr>
                <th>Nama Bangunan</th>
                <th>Harga (Gold)</th>
                <th>Gold / Menit</th>
                <th>Troops / Menit</th>
                <th>Defense Bonus</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($buildings as $building)
            <tr>
                <td>{{ $building->name }}</td>
                <td>{{ $building->price }}</td>
                <td>{{ $building->gold_per_minute }}</td>
                <td>{{ $building->troop_per_minute }}</td>
                <td>{{ $building->defense_bonus }}</td>
                <td>
                    <a href="{{ route('admin.buildings.edit', $building->id) }}" class="btn-edit">
                        Edit
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection


<style>

.admin-container {
    max-width: 1000px;
    margin: 50px auto;
    background: rgba(0,0,0,0.45);
    padding: 30px;
    border: 1px solid #D4AF37;
    border-radius: 10px;
    color: #f5e9c6;
    font-family: 'Cinzel';
}

.title-main {
    text-align: center;
    color: #D4AF37;
    font-size: 30px;
    margin-bottom: 25px;
}

.building-table {
    width: 100%;
    border-collapse: collapse;
}

.building-table th {
    background: #2a221b;
    color: #D4AF37;
    padding: 12px;
    border-bottom: 2px solid #D4AF37;
    text-align: center;
}

.building-table td {
    padding: 12px;
    border-bottom: 1px solid rgba(212,175,55,0.3);
    text-align: center;
}

.btn-edit {
    background: #D4AF37;
    padding: 6px 12px;
    color: #2a221b;
    font-weight: bold;
    border-radius: 6px;
    text-decoration: none;
}

.btn-edit:hover {
    background: #f3d675;
}

.alert-success {
    background: rgba(0,255,0,0.15);
    border: 1px solid #28ff28;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 15px;
    color: #b7ffb7;
}

</style>
