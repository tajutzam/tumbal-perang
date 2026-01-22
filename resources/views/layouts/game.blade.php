<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tumbal Perang</title>

    <!-- Medieval Theme -->
    <link rel="stylesheet" href="/css/auth-game.css">
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&display=swap" rel="stylesheet">

    <style>
        /* NAVBAR */
        .game-navbar {
            background: rgba(25, 20, 16, 0.9);
            border-bottom: 2px solid rgba(212, 175, 55, 0.4);
            padding: 18px 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .game-navbar-title {
            font-size: 22px;
            color: var(--gold);
            font-family: 'Cinzel';
        }

        .game-navbar-right span {
            color: var(--light);
            font-family: 'Cinzel';
            margin-right: 10px;
        }

        .game-navbar-right a {
            color: var(--gold);
            font-family: 'Cinzel';
            margin-left: 10px;
            text-decoration: none;
        }

        main {
            padding: 40px;
            font-family: 'Cinzel';
        }

        /* NOTIFICATION SYSTEM */
        .notif {
            padding: 12px 18px;
            border-radius: 6px;
            margin: 20px auto;
            width: 90%;
            max-width: 800px;
            font-family: 'Cinzel';
            font-size: 18px;
            animation: fadeOut 3.5s forwards;
            text-align: center;
        }

        .success {
            background: #27632a;
            color: #fff;
            border: 1px solid #4caf50;
        }

        .error {
            background: #6b0000;
            color: #fff;
            border: 1px solid #ff4242;
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            80% { opacity: 1; }
            100% { opacity: 0; }
        }
    </style>
</head>

<body>

    <!-- NAVBAR -->
    <nav class="game-navbar">
        <span class="game-navbar-title">
            🛡️ Tumbal Perang — Kingdom Panel
        </span>

        <div class="game-navbar-right">

            <!-- Nama User -->
            <span>{{ Auth::user()->name }}</span>

            <!-- Jika admin, tampilkan tombol Panel Admin -->
            @if(Auth::user()->role === 'admin')
                <a href="/admin/tribes">Admin Panel</a>
            @endif

            <!-- Logout -->
            <a href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </a>

            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">
                @csrf
            </form>
        </div>
    </nav>

    <!-- 🚨 NOTIFICATION SYSTEM (Tepat setelah navbar) -->
    @if(session('success'))
        <div class="notif success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="notif error">{{ session('error') }}</div>
    @endif

    <!-- CONTENT -->
    <main>
        @yield('content')
    </main>

</body>
</html>
