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
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
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
<div class="container mt-5">
        <h1 class="mb-4">Jadwal Siswa </h1>

        <!-- Cek apakah jadwal ada atau tidak -->
        @if($jadwals->isEmpty())
            <p>Anda tidak memiliki jadwal yang terdaftar.</p>
        @else
            <!-- Tabel untuk menampilkan jadwal -->
            <table class="table table-bordered">
            <table class="table table-bordered">
    <thead>
        <tr>
            <th>No</th>
            <th>Mata Pelajaran</th>
            <th>Nama Pengajar</th>
            <th>Ruangan</th>
            <th>Jam</th>
            <th>Hari</th>
            <th>Rombongan Belajar</th>
            <th>Tingkatan</th>
            <th>Status Kehadiran</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($jadwals as $key => $jadwal)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $jadwal->mapel->nama_mapel}}</td>
                <td>{{ $jadwal->pengajar->user->nama }}</td>
                <td>{{ $jadwal->ruangan->nama_ruangan }}</td>
                <td>{{ $jadwal->jam->jam_masuk }} - {{ $jadwal->jam->jam_keluar }}</td>
                <td>{{ $jadwal->jam->hari }}</td>
                <td>{{ $jadwal->rombel->kelas }}</td>
                <td>{{ $jadwal->tingkatan->tingkatan }}</td>
                <td>
                    @php
                        // Mengecek apakah absensi sudah ada untuk siswa pada jadwal ini
                        $absensi = \App\Models\Absensi::where('id_jadwal', $jadwal->id)
                                    ->where('id_siswa', auth()->user()->siswa->id)
                                    ->first();
                    @endphp

                    @if($jadwal->waktu_mulai_absen && $jadwal->waktu_selesai_absen)
                        <!-- Jika waktu mulai dan selesai absensi sudah terisi -->
                        @if(!$absensi)
        <!-- Jika absensi belum ada untuk siswa -->
        <span class="badge bg-danger">Tidak Hadir</span>
    @else
        <!-- Jika absensi sudah ada -->
        <span class="badge bg-success">Hadir</span>
    @endif
                    @elseif(!$absensi)
                        <!-- Jika absensi belum ada -->
                        <span class="badge bg-warning">Belum Ada Absensi</span>
                    @else
                        <!-- Jika absensi sudah ada, tampilkan status hadir -->
                        <span class="badge bg-success">Hadir</span>
                    @endif
                </td>
                <td>
                    @if(!$absensi && !$jadwal->waktu_mulai_absensi && !$jadwal->waktu_selesai_absensi)
                        <!-- Form untuk mengisi absensi jika belum hadir dan waktu absensi belum terisi -->
                        <form action="{{ route('siswa.absen', ['id' => $jadwal->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="kode_absensi" class="form-control" placeholder="Masukkan Kode Absensi" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm mt-2">Absensi</button>
                        </form>
                    @endif
                    @php
                               
                                $materi = \App\Models\Materi::where('id_jadwal', $jadwal->id)->first();
                            @endphp

                            @if($materi)
                                <!-- Tombol untuk download materi -->
                                <a href="{{ route('materi.download', ['id' => $materi->id]) }}" class="btn btn-success btn-sm mt-2" download>
    Download Materi
</a>

                            @else
                                <span>Tidak ada materi untuk jadwal ini.</span>
                            @endif

                            
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

        @endif
    </div>
    <!-- Modal untuk Materi -->
<div class="modal fade" id="modalMateri" tabindex="-1" aria-labelledby="modalMateriLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMateriLabel">Materi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="materi-content">
                <p>Memuat materi...</p>
            </div>
        </div>
    </div>
</div>




<script>
    $(document).on('click', '.lihat-materi', function () {
        const jadwalId = $(this).data('id');

        // Memuat konten materi dari server
        $.ajax({
            url: `/siswa/materi/${jadwalId}`,
            type: 'GET',
            success: function (response) {
                $('#materi-content').html(response);
            },
            error: function () {
                $('#materi-content').html('<p>Gagal memuat materi.</p>');
            }
        });
    });




</script>
@endsection