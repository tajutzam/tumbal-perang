@extends('layouts.game')

@section('content')

<div class="admin-container">

    <h1 class="title-main">⚔️ Panel Admin – Pengaturan Suku</h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    <table class="tribe-table">
        <thead>
        <tr>
            <th>Gambar</th>
            <th>Nama Suku</th>
            <th>Magic Atk</th>
            <th>Range Atk</th>
            <th>Melee Atk</th>
            <th>Magic Def</th>
            <th>Range Def</th>
            <th>Melee Def</th>
            <th>Troops / Barak</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        @foreach ($tribes as $tribe)
        <tr>
            <td>
                @if ($tribe->image)
                    <img src="{{ asset('tribes/' . $tribe->image) }}"
                        style="width:70px; border-radius:6px; border:1px solid #D4AF37;">
                @else
                    <span style="color:#888;">-</span>
                @endif
            </td>

            <td>{{ $tribe->name }}</td>
            <td>{{ $tribe->attack_magic }}</td>
            <td>{{ $tribe->attack_range }}</td>
            <td>{{ $tribe->attack_melee }}</td>
            <td>{{ $tribe->def_magic }}</td>
            <td>{{ $tribe->def_range }}</td>
            <td>{{ $tribe->def_melee }}</td>

            <!-- ⭐ FIELD BARU YANG KAMU TAMBAHKAN -->
            <td>{{ $tribe->troops_per_barrack }}</td>

            <td>
                <a href="{{ route('admin.tribes.edit', $tribe->id) }}" class="btn-edit">
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
    margin-bottom: 25px;
    font-size: 30px;
}

.tribe-table {
    width: 100%;
    border-collapse: collapse;
}

.tribe-table th {
    background: #2a221b;
    color: #D4AF37;
    padding: 10px;
    border-bottom: 2px solid #D4AF37;
    text-align: center;
}

.tribe-table td {
    padding: 10px;
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
    margin-bottom: 15px;
    border-radius: 5px;
    color: #b7ffb7;
}
</style>
