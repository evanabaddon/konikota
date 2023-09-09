<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KONI KOTA MALANG</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #007BFF;
            color: white;
            text-align: center;
            padding: 20px;
        }
        ul {
            list-style-type: none;
        }
        #cabor {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            text-align: center; /* Center align text */
        }

        /* CSS untuk elemen select */
        .select-container {
            text-align: center;
        }

        select {
            padding: 10px;
            font-size: 16px;
        }

        /* CSS untuk elemen h2 di tengah */
        .centered-text {
            text-align: center;
        }

        #kalender {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            text-align: center; /* Center align text */
            overflow-x: auto; /* Tambahkan overflow-x agar bisa digulir secara horizontal */
        }

        #medali {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            text-align: center; /* Center align text */
            overflow-x: auto; /* Tambahkan overflow-x agar bisa digulir secara horizontal */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        footer {
            text-align: center;
            background-color: #007BFF;
            color: white;
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7f/National_Sports_Committee_of_Indonesia_%28KONI%29_logo.svg/1200px-National_Sports_Committee_of_Indonesia_%28KONI%29_logo.svg.png" alt="Logo KONI" width="100" height="100">
        <h1>KALENDER EVENT KONI KOTA MALANG</h1>
        <h2>Event Terkini</h2>
        <ul>
            <li>{{ $latestEvent->name }} ({{ $latestEvent->tgl_mulai }} - {{ $latestEvent->tgl_selesai }})</li>
        </ul>
    </header>
    
    <section id="cabor">
        <div class="centered-text"> <!-- Tambahkan class centered-text -->
            <h2>Cabang Olahraga</h2>
            <div class="select-container">
                <select id="cabangOlahraga" onchange="tampilkanJadwal()">
                    <option value="Semua">Semua Cabang Olahraga</option>
                    @foreach($cabors as $cabor)
                        <option value="{{ $cabor->name }}">{{ $cabor->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </section>

    <section id="kalender">
        <div class="centered-text"> <!-- Tambahkan class centered-text -->
            <h2>Kalender Pertandingan</h2>
            <div style="overflow-x: auto;"> <!-- Tambahkan div yang dapat digulir secara horizontal -->
                <table>
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Tanggal Selesai</th>
                            <th>Cabang Olahraga</th>
                            <th>Tempat</th>
                            <th>Kota / Kab</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pertandingans as $pertandingan)
                            <tr>
                                <td>{{ $pertandingan->tgl_mulai }}</td>
                                <td>{{ $pertandingan->tgl_selesai }}</td>
                                <td>{{ $pertandingan->cabor->name }}</td>
                                <td>{{ $pertandingan->venue->name }}</td>
                                <td>{{ $pertandingan->venue->kota }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <section id="medali">
        <div class="centered-text">
            <h2>Perolehan Medali</h2>
            <div style="overflow-x: auto;"> <!-- Tambahkan div yang dapat digulir secara horizontal -->
                <table>
                    <thead>
                        <tr>
                            <th>Cabang Olahraga</th>
                            <th>Emas</th>
                            <th>Perak</th>
                            <th>Perunggu</th>
                        </tr>
                        <tr class="total-medali"> <!-- Tambahkan baris total medali -->
                            <th>Total</th>
                            <th>{{ $totalEmas }}</th>
                            <th>{{ $totalPerak }}</th>
                            <th>{{ $totalPerunggu }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cabors as $cabor)
                            <tr class="medali-row"> <!-- Tambahkan class medali-row -->
                                <td>{{ $cabor->name }}</td>
                                <td>{{ $cabor->medaliEmas() }}</td>
                                <td>{{ $cabor->medaliPerak() }}</td>
                                <td>{{ $cabor->medaliPerunggu() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2023 KONI KOTA MALANG. Hak Cipta Dilindungi Undang-undang.</p>
    </footer>

    <script>
        function tampilkanJadwal() {
            var cabangOlahraga = document.getElementById("cabangOlahraga").value;
            var tabelJadwal = document.getElementById("kalender");
            var rowsJadwal = tabelJadwal.getElementsByTagName("tr");
    
            for (var i = 1; i < rowsJadwal.length; i++) {
                var row = rowsJadwal[i];
                var cell = row.getElementsByTagName("td")[1];
                if (cell) {
                    if (cabangOlahraga === "Semua" || cell.textContent === cabangOlahraga) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }
            }
    
            tampilkanPerolehanMedali(); // Tampilkan juga tabel perolehan medali
        }
    
        function tampilkanPerolehanMedali() {
            var cabangOlahraga = document.getElementById("cabangOlahraga").value;
            var tabelMedali = document.getElementById("medali");
            var rowsMedali = tabelMedali.getElementsByClassName("medali-row");
    
            for (var i = 0; i < rowsMedali.length; i++) {
                var row = rowsMedali[i];
                var cell = row.getElementsByTagName("td")[0]; // Kolom pertama adalah nama Cabang Olahraga
    
                if (cell) {
                    if (cabangOlahraga === "Semua" || cell.textContent === cabangOlahraga) {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }
            }
        }
    
        // Panggil fungsi tampilkanJadwal saat halaman dimuat
        window.onload = tampilkanJadwal();
    </script>
    
</body>
</html>
