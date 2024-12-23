@extends('layoutpengajar')

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

    <div class="container mt-5">
        <h1 class="mb-4">Jadwal Pengajar</h1>

        <!-- Cek apakah jadwal ada atau tidak -->
        @if($jadwals->isEmpty())
            <p>Anda tidak memiliki jadwal yang terdaftar.</p>
        @else
            <!-- Tabel untuk menampilkan jadwal -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mata Pelajaran</th>
                        <th>Ruangan</th>
                        <th>Jam</th>
                        <th>Hari</th>
                        <th>Rombongan Belajar</th>
                        <th>Tingkatan</th>
                        <th>Aksi</th> <!-- New column for actions -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($jadwals as $key => $jadwal)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $jadwal->mapel->nama_mapel }}</td>
                            <td>{{ $jadwal->ruangan->nama_ruangan }}</td>
                            <td>{{ $jadwal->jam->jam_masuk }} - {{ $jadwal->jam->jam_keluar }}</td>
                            <td>{{ $jadwal->jam->hari }}</td>
                            <td>{{ $jadwal->rombel->kelas }}</td>
                            <td>{{ $jadwal->tingkatan->tingkatan }}</td>
                            <td>
    <div class="row">
        <div class="col-4 mb-2">
            <button class="btn btn-primary btn-sm mulai-absen w-100" data-id="{{ $jadwal->id }}">Mulai Absen</button>
        </div>
        <div class="col-4 mb-2">
            <button class="btn btn-warning btn-sm selesei-absen w-100" data-id="{{ $jadwal->id }}">Selesai Absen</button>
        </div>
        <div class="col-4 mb-2">
            <button class="btn btn-success btn-sm daftar-absen w-100" data-id="{{ $jadwal->id }}">Daftar Absen</button>
        </div>
    </div>
    <div class="row">
    <div class="col-4 mb-2">
        <button class="btn btn-primary btn-sm materi w-100" data-id="{{ $jadwal->id }}">Materi</button>
    </div>
</div>
       
    </div>
</td>


                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Modal Daftar Absen -->
            <div class="modal fade" id="modalDaftarAbsen" tabindex="-1" role="dialog" aria-labelledby="modalDaftarAbsenLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalDaftarAbsenLabel">Daftar Siswa yang Sudah Absen</h5>
                           
                        </div>
                        <div class="modal-body" id="daftar-absen-siswa">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                    </tr>
                                </thead>
                                <tbody id="siswa-absen-list">
                                    <!-- Daftar nama siswa yang sudah absen akan muncul di sini -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Mulai Absen -->
            <div class="modal fade" id="mulaiAbsenModal" tabindex="-1" aria-labelledby="mulaiAbsenModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="mulaiAbsenModalLabel">Masukkan Kode Absensi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="mulaiAbsenForm" method="POST" action="{{ route('absen.store', $jadwal->id) }}">
                                @csrf
                                <div class="mb-3">
                                    <label for="kodeAbsensi" class="form-label modal-title">Kode Absensi</label>
                                    <input type="text" class="form-control" id="kodeAbsensi" name="kodeAbsensi" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Absen</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Selesai Absen -->
            <form id="form-selesei-absen" method="POST" action="{{ route('selesaiabsen', $jadwal->id) }}">
                @csrf
                <input type="hidden" id="jadwalId" name="jadwalId">
            </form>
        @endif
    </div>
    <div class="modal fade" id="modalMateri" tabindex="-1" role="dialog" aria-labelledby="modalMateriLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMateriLabel">Materi Terkait</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk unggah materi -->
                <form id="uploadMateriForm" method="POST" enctype="multipart/form-data" action="{{ route('materi.store') }}">
                    @csrf
                    <input type="hidden" name="id_jadwal" id="materiJadwalId">
                    <div class="mb-3">
                        <label for="fileMateri" class="form-label">Upload File</label>
                        <input type="file" class="form-control" id="fileMateri" name="file" required>
                    </div>
                    <button type="submit" class="btn btn-success">Unggah Materi</button>
                </form>

                </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function() {
    // Ketika tombol Materi diklik
    $('.materi').on('click', function() {
        var jadwalId = $(this).data('id');
        $('#materiJadwalId').val(jadwalId); // Set ID jadwal ke form
        $('#modalMateri').modal('show'); // Tampilkan modal
        $(document).ready(function() {
        });
        });
            // Mulai Absen
            $('.mulai-absen').on('click', function() {
                var jadwalId = $(this).data('id');
                $('#jadwalId').val(jadwalId);  // Set Jadwal ID ke input hidden
                $('#mulaiAbsenModal').modal('show');  // Menampilkan modal
            });

            // Selesai Absen
            $(".selesei-absen").click(function() {
                var jadwalId = $(this).data("id"); // Mengambil ID dari atribut data-id

                $.ajax({
                    url: '/update-waktu-selesei-absen/' + jadwalId, // Menambahkan ID pada URL
                    method: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}" // Menyertakan CSRF token untuk keamanan
                    },
                    success: function(response) {
                        if (response.success) {
                            alert('Waktu selesai absen berhasil diperbarui!');
                        } else {
                            alert('Gagal memperbarui waktu selesai absen');
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan saat melakukan request');
                    }
                });
            });

            // Daftar Absen
            $('.daftar-absen').on('click', function() {
                var jadwalId = $(this).data('id'); // Ambil id jadwal dari tombol yang diklik

                $.ajax({
                    url: '/get-absensi/' + jadwalId,  // URL untuk mengambil data absensi
                    method: 'GET',
                    success: function(response) {
                        $('#siswa-absen-list').empty();

                        if (response.length > 0) {
                            $.each(response, function(index, siswa) {
                                var row = `<tr>
                                    <td>${index + 1}</td>
                                    <td>${siswa.nama}</td>
                                </tr>`;
                                $('#siswa-absen-list').append(row);
                            });
                        } else {
                            $('#siswa-absen-list').append('<tr><td colspan="2">Tidak ada siswa yang sudah absen.</td></tr>');
                        }

                        $('#modalDaftarAbsen').modal('show');
                    },
                    error: function() {
                        alert('Gagal mengambil data absen.');
                    }
                });
            });
        });
    </script>
@endsection
