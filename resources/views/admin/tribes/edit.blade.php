@extends('layouts.game')

@section('content')

<div class="edit-container">

    <h1 class="edit-title">🛡️ Edit Atribut Suku – {{ $tribe->name }}</h1>

    <form action="{{ route('admin.tribes.update', $tribe->id) }}" 
          method="POST" 
          enctype="multipart/form-data">
          
        @csrf
        @method('PUT')

        <div class="grid-2">

            <div class="input-group">
                <label>Magic Attack</label>
                <input type="number" name="attack_magic" 
                       value="{{ $tribe->attack_magic }}" required>
            </div>

            <div class="input-group">
                <label>Range Attack</label>
                <input type="number" name="attack_range" 
                       value="{{ $tribe->attack_range }}" required>
            </div>

            <div class="input-group">
                <label>Melee Attack</label>
                <input type="number" name="attack_melee" 
                       value="{{ $tribe->attack_melee }}" required>
            </div>

            <div class="input-group">
                <label>Magic Defense</label>
                <input type="number" name="def_magic" 
                       value="{{ $tribe->def_magic }}" required>
            </div>

            <div class="input-group">
                <label>Range Defense</label>
                <input type="number" name="def_range" 
                       value="{{ $tribe->def_range }}" required>
            </div>

            <div class="input-group">
                <label>Melee Defense</label>
                <input type="number" name="def_melee" 
                       value="{{ $tribe->def_melee }}" required>
            </div>
            
            <div class="input-group">
                <label>Pasukan / Menit Per Barak</label>
                <input type="number" name="troops_per_barrack" 
                    value="{{ $tribe->troops_per_barrack }}" required>
            </div>

        </div>

        <hr class="divider">

        <h2 class="edit-subtitle">🎨 Gambar Suku</h2>

        <div class="input-group">
            <label>Upload Gambar Baru</label>
            <input type="file" name="image" accept="image/*">

            @if ($tribe->image)
                <p style="margin-top:10px;">Gambar Saat Ini:</p>

                <img src="{{ asset('tribes/' . $tribe->image) }}"
                     style="width:200px; border:2px solid #D4AF37; border-radius:8px;">
            @endif
        </div>

        <button type="submit" class="btn-save">Simpan Perubahan</button>

        <a href="{{ route('admin.tribes') }}" class="btn-back">Kembali</a>

    </form>

</div>
{{-- DEBUG SECTION --}}
@if ($errors->any())
    <div style="background:#440000; color:#ffb3b3; padding:10px; margin-top:30px; border:1px solid red;">
        <strong>VALIDATION ERRORS FOUND:</strong>
        <ul>
            @foreach ($errors->all() as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(request()->isMethod('post') || request()->isMethod('put'))
    <div style="background:#002244; color:#d6eaff; padding:10px; margin-top:30px; border:1px solid #559;">
        <strong>DEBUG REQUEST INFO:</strong>

        <p><b>Has File?</b> 
            {{ request()->hasFile('image') ? 'YES' : 'NO' }}
        </p>

        @if(request()->hasFile('image'))
            <p><b>Uploaded File Name:</b> {{ request()->file('image')->getClientOriginalName() }}</p>
            <p><b>Uploaded Temp Path:</b> {{ request()->file('image')->getRealPath() }}</p>
            <p><b>Extension:</b> {{ request()->file('image')->getClientOriginalExtension() }}</p>
            <p><b>Size:</b> {{ request()->file('image')->getSize() }} bytes</p>
        @endif

        <p><b>All Request Data:</b></p>
        <pre style="white-space: pre-wrap; color:#fff;">{{ json_encode(request()->all(), JSON_PRETTY_PRINT) }}</pre>
    </div>
@endif

@endsection

<style>
.edit-container {
    max-width: 750px;
    margin: 60px auto;
    background: rgba(0,0,0,0.45);
    padding: 30px;
    border-radius: 10px;
    border: 1px solid #D4AF37;
    color: #f5e9c6;
    font-family: 'Cinzel';
}

.edit-title {
    color: #D4AF37;
    text-align: center;
    margin-bottom: 25px;
}

.edit-subtitle {
    color: #D4AF37;
    margin-top: 20px;
    margin-bottom: 10px;
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
    color: white;
    border-radius: 5px;
}

.divider {
    margin: 25px 0;
    border: none;
    border-top: 1px solid rgba(212,175,55,0.4);
}

.btn-save {
    margin-top: 20px;
    padding: 12px 20px;
    background: #D4AF37;
    border: none;
    border-radius: 6px;
    font-size: 18px;
    color: #2a221b;
    font-weight: bold;
    cursor: pointer;
}

.btn-save:hover {
    background: #f3d675;
}

.btn-back {
    display: inline-block;
    margin-top: 15px;
    color: #D4AF37;
    text-decoration: underline;
}
</style>
