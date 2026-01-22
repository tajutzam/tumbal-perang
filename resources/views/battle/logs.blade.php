@extends('layouts.game')

@section('content')

<div class="log-container">

    <h1 class="title-main">⚔️ Riwayat Peperangan</h1>

    @if ($logs->isEmpty())
        <p class="no-log">Belum ada riwayat peperangan.</p>
    @else

    <table class="log-table">
        <thead>
        <tr>
            <th>Waktu</th>
            <th>Penyerang</th>
            <th>Pertahanan</th>
            <th>Hasil</th>
            <th>Gold</th>
            <th>Detail</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($logs as $log)
        <tr>
            <td>{{ $log->created_at->format('d M Y H:i') }}</td>

            <td>
                <span class="attacker-name">
                    🗡️ {{ $log->attacker->name }}
                </span>
            </td>

            <td>
                <span class="defender-name">
                    🛡️ {{ $log->defender->name }}
                </span>
            </td>

            <td>
                <span class="{{ $log->attacker_won ? 'result-win' : 'result-lose' }}">
                    {{ $log->attacker_won ? 'MENANG' : 'KALAH' }}
                </span>
            </td>

            <td>
                <span class="gold">
                    💰 {{ $log->gold_transferred }}
                </span>
            </td>

            <td>
                <button class="btn-detail"
                        onclick='showDetail(@json($log))'>
                    📜 Detail
                </button>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    @endif
</div>


{{-- ============================= --}}
{{-- MODAL DETAIL LENGKAP --}}
{{-- ============================= --}}
<div id="battleModal" class="modal">
    <div class="modal-content animate">

        <span class="modal-close" onclick="closeModal()">✖</span>

        <h2 class="modal-title">📜 Laporan Peperangan</h2>

        <div id="modal-body" class="modal-body"></div>
    </div>
</div>

@endsection


{{-- ============================= --}}
{{-- CSS MEDIEVAL THEME --}}
{{-- ============================= --}}
<style>

.log-container {
    max-width: 950px;
    margin: 40px auto;
    padding: 25px;
    background: rgba(20,14,10,0.65);
    border: 2px solid #C9A86A;
    border-radius: 12px;
    color: #f5e9c6;
    box-shadow: 0 0 15px #000 inset;
    font-family: 'Cinzel';
}

.title-main {
    text-align: center;
    font-size: 32px;
    color: #D4AF37;
    margin-bottom: 25px;
    text-shadow: 0 0 8px #D4AF37;
}

.log-table {
    width: 100%;
    border-collapse: collapse;
}

.log-table th {
    background: #3b2d22;
    padding: 12px;
    color: #D4AF37;
    border-bottom: 2px solid #D4AF37;
    letter-spacing: 1px;
}

.log-table td {
    padding: 12px;
    border-bottom: 1px solid rgba(212,175,55,0.3);
    text-align: center;
}

.attacker-name, .defender-name {
    font-weight: bold;
}

.result-win {
    color: #4CFF4C;
    font-weight: bold;
    text-shadow: 0 0 6px #4cff4c;
}

.result-lose {
    color: #FF4444;
    font-weight: bold;
    text-shadow: 0 0 6px #ff4444;
}

.gold {
    color: #FFD86B;
    font-weight: bold;
}

.btn-detail {
    padding: 8px 14px;
    background: #D4AF37;
    color: #2a221b;
    border-radius: 6px;
    border: none;
    font-weight: bold;
    cursor: pointer;
}

.btn-detail:hover {
    background: #f2d78a;
}


/* ========================= */
/* MODAL CUSTOM MEDIEVAL */
/* ========================= */
.modal {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    display: none;
    background: rgba(0,0,0,0.8);
    align-items: center;
    justify-content: center;
    z-index: 8000;
}

.modal-content {
    width: 520px;
    background: #1e1a16;
    border: 3px solid #D4AF37;
    padding: 25px;
    border-radius: 12px;
    color: #f5e9c6;
    box-shadow: 0 0 20px #000, 0 0 15px #D4AF37 inset;
}

.modal-title {
    text-align: center;
    color: #D4AF37;
    margin-bottom: 15px;
}

.modal-close {
    float: right;
    cursor: pointer;
    font-size: 20px;
    color: #D4AF37;
}

.modal-close:hover {
    color: #ffffff;
}

.modal-body p {
    margin: 8px 0;
}

.modal-body hr {
    border: 0;
    border-top: 1px solid #D4AF37;
    margin: 12px 0;
}

</style>


{{-- ============================= --}}
{{-- JAVASCRIPT --}}
{{-- ============================= --}}
<script>
function showDetail(log) {

    let html = `
        <p><b>Penyerang:</b> ⚔️ ${log.attacker.name}</p>
        <p><b>Pertahanan:</b> 🛡️ ${log.defender.name}</p>

        <hr>

        <p><b>Pasukan Penyerang (Sebelum):</b> ${log.attacker_troops_before}</p>
        <p><b>Pasukan Bertahan (Sebelum):</b> ${log.defender_troops_before}</p>

        <p><b>Pasukan Penyerang (Setelah):</b> ${log.attacker_troops_after}</p>
        <p><b>Pasukan Bertahan (Setelah):</b> ${log.defender_troops_after}</p>

        <hr>

        <p><b>Total Attack Power:</b> 🔥 ${log.attack_power}</p>
        <p><b>Total Defense Power:</b> 🛡️ ${log.defense_power}</p>
        <p><b>Bonus Pertahanan Bangunan:</b> +${log.building_bonus}</p>

        <hr>

        <p><b>Kerugian Penyerang:</b> ${log.attacker_losses}</p>
        <p><b>Kerugian Bertahan:</b> ${log.defender_losses}</p>

        <hr>

        <p><b>Gold Diambil:</b> 💰 ${log.gold_transferred}</p>

        <hr>

        <p><b>Catatan:</b><br>${log.notes}</p>
    `;

    document.getElementById('modal-body').innerHTML = html;
    document.getElementById('battleModal').style.display = "flex";
}

function closeModal() {
    document.getElementById('battleModal').style.display = "none";
}
</script>
