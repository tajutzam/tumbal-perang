@extends('layouts.game')

@section('content')

<div class="leaderboard-container">

    <h1 class="title-main">🏆 Leaderboard Peperangan</h1>

    <!-- Leaderboard Kemenangan -->
    <h2 class="sub-title">⚔ Top Kemenangan</h2>
    <table class="medieval-table">
        <thead>
            <tr>
                <th>Pemain</th>
                <th>Kemenangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($wins as $u)
            <tr>
                <td>{{ $u->name }}</td>
                <td>{{ $u->win_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Leaderboard Serangan -->
    <h2 class="sub-title">🗡 Jumlah Serangan</h2>
    <table class="medieval-table">
        <thead>
            <tr>
                <th>Pemain</th>
                <th>Serangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($attacks as $u)
            <tr>
                <td>{{ $u->name }}</td>
                <td>{{ $u->attack_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@endsection


<style>

.leaderboard-container {
    max-width: 900px;
    margin: 40px auto;
    padding: 30px;
    background: rgba(25, 20, 16, 0.6);
    border: 1px solid #D4AF37;
    border-radius: 12px;
    color: #f5e9c6;
    font-family: 'Cinzel';
}

.title-main {
    text-align: center;
    color: #ffd86b;
    font-size: 36px;
    margin-bottom: 20px;
}

.sub-title {
    margin-top: 25px;
    color: #D4AF37;
    font-size: 24px;
    margin-bottom: 10px;
}

.medieval-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 25px;
}

.medieval-table th {
    background: rgba(212,175,55,0.25);
    padding: 12px;
    border-bottom: 1px solid #D4AF37;
}

.medieval-table td {
    padding: 12px;
    border-bottom: 1px solid rgba(212,175,55,0.2);
}

.medieval-table tr:hover {
    background: rgba(212,175,55,0.1);
}

</style>
