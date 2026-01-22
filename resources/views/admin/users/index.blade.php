@extends('layouts.game')

@section('content')

<div class="admin-dashboard">

    <h1 class="title-main">👥 Daftar Pengguna</h1>

    <div class="table-wrapper">
        <table class="user-table">
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Bergabung</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->created_at->format('d M Y') }}</td>

                    <td>
                        <a href="{{ route('admin.users.edit', $user->id) }}" class="btn-edit">✏️ Edit</a>

                        <form action="{{ route('admin.users.destroy', $user->id) }}" 
                              method="POST" 
                              style="display:inline-block;"
                              onsubmit="return confirm('Hapus pengguna ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn-delete">🗑️ Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

@endsection


<style>
.admin-dashboard {
    max-width: 900px;
    margin: 40px auto;
    padding: 30px;
    background: rgba(0,0,0,0.35);
    border: 1px solid #D4AF37;
    border-radius: 12px;
    color: #f5e9c6;
    font-family: 'Cinzel';
}

.title-main {
    text-align: center;
    margin-bottom: 25px;
    font-size: 30px;
    color: #D4AF37;
}

.table-wrapper {
    overflow-x: auto;
}

.user-table {
    width: 100%;
    border-collapse: collapse;
    background: rgba(25,20,16,0.9);
}

.user-table th {
    background: rgba(212,175,55,0.25);
    padding: 12px;
    color: #FFD966;
    font-size: 18px;
}

.user-table td {
    padding: 12px;
    border-bottom: 1px solid rgba(212,175,55,0.2);
}

.user-table tr:hover {
    background: rgba(212,175,55,0.15);
}

/* Buttons */
.btn-edit {
    background: #D4AF37;
    padding: 8px 14px;
    border-radius: 6px;
    text-decoration: none;
    color: #2a1e0a;
    font-weight: bold;
    margin-right: 8px;
}

.btn-edit:hover {
    background: #f8d878;
}

.btn-delete {
    background: #800000;
    padding: 8px 14px;
    border-radius: 6px;
    color: #fff;
    border: none;
    cursor: pointer;
    font-weight: bold;
}

.btn-delete:hover {
    background: #b30000;
}
</style>
