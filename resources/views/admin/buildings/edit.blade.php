@extends('layouts.game')

@section('content')

<div class="edit-container">

    <h1 class="edit-title">⚒️ Edit Bangunan – {{ $building->name }}</h1>

    <form action="{{ route('admin.buildings.update', $building->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid-2">
            <div class="input-group">
                <label>Harga (Gold)</label>
                <input type="number" name="price" value="{{ $building->price }}" required>
            </div>

            <div class="input-group">
                <label>Gold / Menit</label>
                <input type="number" name="gold_per_minute" value="{{ $building->gold_per_minute }}" required>
            </div>

            <div class="input-group">
                <label>Troops / Menit</label>
                <input type="number" name="troop_per_minute" value="{{ $building->troop_per_minute }}" required>
            </div>

            <div class="input-group">
                <label>Defense Bonus</label>
                <input type="number" name="defense_bonus" value="{{ $building->defense_bonus }}" required>
            </div>
        </div>

        <button type="submit" class="btn-save">Simpan Perubahan</button>
        <a href="{{ route('admin.buildings') }}" class="btn-back">Kembali</a>

    </form>
</div>

@endsection


<style>
.edit-container {
    max-width: 700px;
    margin: 60px auto;
    background: rgba(0,0,0,0.45);
    padding: 30px;
    border-radius: 10px;
    border: 1px solid #D4AF37;
    color: #f5e9c6;
    font-family: 'Cinzel';
}

.edit-title {
    text-align: center;
    color: #D4AF37;
    margin-bottom: 25px;
}

.grid-2 {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.input-group label {
    display: block;
    margin-bottom: 5px;
    color: #D4AF37;
}

.input-group input {
    width: 100%;
    padding: 10px;
    background: rgba(255,255,255,0.1);
    border: 1px solid #D4AF37;
    border-radius: 5px;
    color: white;
}

.btn-save {
    margin-top: 20px;
    padding: 12px 20px;
    background: #D4AF37;
    color: #2a221b;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
}

.btn-save:hover {
    background: #f3d675;
}

.btn-back {
    margin-top: 15px;
    display: inline-block;
    color: #D4AF37;
    text-decoration: underline;
}

</style>
