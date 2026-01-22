@extends('layouts.game')

@section('content')

<div class="admin-dashboard">

    <h1 class="title-main">✏️ Edit Pengguna</h1>

    <form class="form-box" method="POST" action="{{ route('admin.users.update', $user->id) }}">
        @csrf
        @method('PUT')

        <label>Nama</label>
        <input type="text" name="name" value="{{ $user->name }}" required>

        <label>Email</label>
        <input type="email" name="email" value="{{ $user->email }}" required>

        <button class="btn-save">💾 Simpan Perubahan</button>
    </form>

</div>

@endsection


<style>
.form-box {
    background: rgba(25,20,16,0.9);
    padding: 25px;
    border: 1px solid #D4AF37;
    border-radius: 10px;
    color: #f5e9c6;
    font-family: 'Cinzel';
}

.form-box label {
    display: block;
    margin-bottom: 6px;
    color: #FFD966;
    font-size: 18px;
}

.form-box input {
    width: 100%;
    padding: 10px;
    background: #2e251a;
    border: 1px solid #D4AF37;
    border-radius: 6px;
    color: #fff3d2;
    margin-bottom: 15px;
}

.btn-save {
    background: #D4AF37;
    padding: 12px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    color: #2a1e0a;
    font-weight: bold;
    width: 100%;
}

.btn-save:hover {
    background: #f8d878;
}
</style>
