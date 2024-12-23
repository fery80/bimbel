@extends('layoutsiswa')

@section('konten')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<style>
            body {
            background-image: url("{{ asset('image/bg.halaman.murid.png') }}");
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }
</style>
<div class="container mt-4">
    <div class="row">
        <div class=" col-md-6 mb-4">
            <img src="{{ asset('image/smp.png') }}" alt="Gambar Murid" class="mt login-foto">
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <div class="mt w-100">
                
                <!-- Jadwal Table -->
                <table class="table mt-3">
    <thead>
        <tr>
            <th colspan="4">Jadwal Hari Ini</th>
        </tr>
        <tr>
            <th>Waktu</th>
            <th>Mata Pelajaran</th>
            <th>Tempat</th>
            <th>Guru</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($jadwalHariIni as $jadwal)
            <tr>
                <td>{{ $jadwal->jam->jam_masuk }}-{{ $jadwal->jam->jam_keluar }}</td>
                <td>{{ $jadwal->mapel->nama_mapel }}</td>
                <td>{{ $jadwal->ruangan->nama_ruangan}}</td>
                <td>{{ $jadwal->pengajar->user->nama}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="4">Tidak ada jadwal untuk hari ini</td>
            </tr>
        @endforelse
    </tbody>
</table>
                
                <!-- Absen Table -->
                <table class="table mt-3">
                    <thead class="custom-header">
                        <tr><th>Absen Hari Ini</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center align-middle">Masih Belum Waktunya Absen</td>
                        </tr>
                    </tbody>
                </table>

                <!-- Kuis Table -->
                <table class="table mt-3">
                    <thead class="custom-header">
                        <tr><th>Kuis</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center align-middle">Masih Belum Ada Kuis</td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>

@endsection