@extends('layouts.game')

@section('content')

<div class="battle-container">

    <h1 class="battle-title">⚔️ Target Penyerangan</h1>

    @if(session('success'))
        <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert-error">{{ session('error') }}</div>
    @endif

    <table class="battle-table">
        <thead>
            <tr>
                <th>Pemain</th>
                <th>Suku</th>
                <th>Gold</th>
                <th>Troops</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @forelse($targets as $t)
            <tr>
                <td>{{ $t->name }}</td>
                <td>{{ $t->tribe->name }}</td>
                <td>{{ $t->resource->gold }}</td>
                <td>{{ $t->resource->troops }}</td>
                <td>
                    <a href="{{ route('battle.confirm', $t->id) }}" class="btn-attack">
                        Serang!
                    </a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; padding:20px;">
                    Tidak ada target yang memenuhi syarat.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

</div>

@endsection


<style>
.battle-container {
    max-width: 850px;
    margin: 40px auto;
    background: rgba(0,0,0,0.45);
    padding: 30px;
    border-radius: 10px;
    border: 1px solid #D4AF37;
    color: #f5e9c6;
    font-family: 'Cinzel';
}

.battle-title {
    text-align: center;
    font-size: 32px;
    color: #D4AF37;
    margin-bottom: 20px;
}

.battle-table {
    width: 100%;
    border-collapse: collapse;
}

.battle-table th {
    padding: 10px;
    background: #2a221b;
    color: #D4AF37;
}

.battle-table td {
    padding: 10px;
    border-bottom: 1px solid rgba(212,175,55,0.3);
    text-align: center;
}

.btn-attack {
    background: #b32424;
    padding: 8px 15px;
    border-radius: 6px;
    color: white;
    font-weight: bold;
    text-decoration: none;
}

.btn-attack:hover {
    background: #ff4d4d;
}
</style>
