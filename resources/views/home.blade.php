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
@parent
@endsection
