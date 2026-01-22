<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tumbal Perang</title>

    <!-- Medieval Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Cinzel', serif;
            background: #000;
            color: #f8e7b5;
            height: 100vh;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background: rgba(25, 18, 12, 0.88);
            border: 2px solid #c8a34e;
            padding: 40px 60px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0,0,0,0.7);
        }

        .title {
            font-size: 40px;
            margin-bottom: 10px;
            color: #d4af37;
            text-shadow: 0 2px 6px black;
        }

        .subtitle {
            margin-bottom: 25px;
            font-size: 16px;
        }

        .btn {
            display: inline-block;
            margin: 10px;
            padding: 12px 25px;
            background: #d4af37;
            color: #2a1b11;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            font-size: 18px;
            transition: 0.2s;
            box-shadow: 0 0 10px rgba(0,0,0,0.5);
        }

        .btn:hover {
            background: #f4d87b;
            transform: translateY(-3px);
        }
    </style>
</head>

<body>

    <div class="card">

        <h1 class="title">TUMBAL PERANG</h1>
        <p class="subtitle">Pilih jalanmu, Pejuang Kerajaan...</p>

        @if (Route::has('login'))
            @auth
                <a href="{{ url('/home') }}" class="btn">Masuk Kerajaan</a>
            @else
                <a href="{{ route('login') }}" class="btn">Login</a>
                <a href="{{ route('register') }}" class="btn">Daftar</a>
            @endauth
        @endif

    </div>

</body>
</html>
