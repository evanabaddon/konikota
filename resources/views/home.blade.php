@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card-header"><strong>Daftar Event</span></div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('admin.events.create') }}" class="btn btn-primary">Tambah Event</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nama Event</th>
                                    <th>Tanggal Mulai</th>
                                    <th>Tanggal Selesai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $event)
                                    <tr>
                                        <td class="font-weight-normal">{{ $event->name }}</td>
                                        <td class="font-weight-normal">{{ $event->tgl_selesai }}</td>
                                        <td class="font-weight-normal">{{ $event->tgl_selesai }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                  </div>
            </div>
            <div class="card mb-4">
                <div class="card-header"><strong>Daftar Pertandingan</strong></div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('admin.pertandingans.create') }}" class="btn btn-primary">Tambah Pertandingan</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Tanggal Selesai</th>
                                    <th>Cabang Olahraga</th>
                                    <th>Tempat</th>
                                    <th>Kota / Kab</th>
                                    <th>Aksi</th> <!-- Kolom Aksi untuk tombol Edit -->
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pertandingans as $pertandingan)
                                    <tr>
                                        <td class="font-weight-normal">{{ $pertandingan->tgl_mulai }}</td>
                                        <td class="font-weight-normal">{{ $pertandingan->tgl_selesai }}</td>
                                        <td class="font-weight-normal">{{ $pertandingan->cabor->name }}</td>
                                        <td class="font-weight-normal">{{ $pertandingan->venue->name }}</td>
                                        <td class="font-weight-normal">{{ $pertandingan->venue->kota }}</td>
                                        <td>
                                            <a href="{{ route('admin.pertandingans.edit', $pertandingan->id) }}" class="btn btn-sm btn-primary">Update</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    // Pemanggilan data JSON dari URL API
    fetch('http://127.0.0.1:8000/api')
        .then(response => response.json())
        .then(data => {
            // Tampilkan judul event
            document.querySelector('h1').textContent = data.latestEvent.name;

            // Tampilkan total medali
            document.querySelector('#perolehan-medali').innerHTML = `
                <h2>Total Medali</h2>
                <p>Total Emas: ${data.totalEmas}</p>
                <p>Total Perak: ${data.totalPerak}</p>
                <p>Total Perunggu: ${data.totalPerunggu}</p>
            `;

            // Tampilkan jadwal pertandingan
            document.querySelector('#jadwal-pertandingan').innerHTML = `
                <h2>Jadwal Pertandingan</h2>
            `;
            data.pertandingans.forEach(pertandingan => {
                document.querySelector('#jadwal-pertandingan').innerHTML += `
                    <p>Pertandingan: ${pertandingan.cabor.name}</p>
                    <p>Tanggal Mulai: ${pertandingan.tgl_mulai}</p>
                    <p>Tanggal Selesai: ${pertandingan.tgl_selesai}</p>
                    <p>Tempat: ${pertandingan.venue.name}</p>
                `;
            });

            // Tampilkan perolehan medali untuk setiap cabang olahraga
            document.querySelector('#perolehan-medali').innerHTML += `
                <h2>Perolehan Medali per Cabang Olahraga</h2>
            `;
            data.cabors.forEach(cabang => {
                document.querySelector('#perolehan-medali').innerHTML += `
                    <h3>${cabang.name}</h3>
                    <p>Emas: ${cabang.emas}</p>
                    <p>Perak: ${cabang.perak}</p>
                    <p>Perunggu: ${cabang.perunggu}</p>
                `;
            });
        })
        .catch(error => {
            console.error('Gagal mengambil data dari API:', error);
        });
</script>
@parent
@endsection
