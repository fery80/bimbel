@extends('layoutadmin')

@section('konten')
@if (session('success'))
    <div class="alert alert-success" id="alert-success">
        {{ session('success') }}
    </div>
@elseif(session('error'))
    <div class="alert alert-danger" id="alert-error">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any()) 
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="card my-4 shadow mx-auto" style="width: 80%;">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Daftar Jadwal</h5>
    </div>
    <div class="card-body">
        <div class="raw">
        <div class="col">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#daftarModal"> Tambah Jadwal</button>
                 <div class="modal fade" id="daftarModal" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="daftarModalLabel">Pembuatan Jadwal</h5>
                                <form id="jadwalForm" action="{{ route('jadwal.create') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                    


                                    <div class="mb-3">
    <label for="id_mapela" class="form-label">Mapel</label>
    <select name="id_mapela" id="id_mapela" class="form-select" required>
        <option value="" selected disabled>Pilih Mapel</option>
        @foreach ($mapels as $mapel)
            <option value="{{ $mapel->id_mapel }}">{{ $mapel->nama_mapel }}</option>
        @endforeach
    </select>
</div>

                                        <div class="mb-3">
                                            <label for="id_pengajara" class="form-label">Pengajar</label>
                                            <select name="id_pengajara" id="id_pengajara" class="form-select" required>
    <option value="" selected disabled>Pilih Pengajar</option>
    @foreach ($pengajars as $pengajar)
        <option value="{{ $pengajar->id_pengajar }}">
            {{ $pengajar->user->nama }} <!-- Menampilkan nama pengajar -->
        </option>
    @endforeach
</select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_tingkatana" class="form-label">tingkatan</label>
                                            <select name="id_tingkatana" id="id_tingkatana" class="form-select" required>
                                                <option value="" selected disabled>Pilih Tingkatan</option>
                                                @foreach ($tingkatans as $tingkatan)
                                                    <option value="{{ $tingkatan->id }}">{{ $tingkatan->tingkatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_ruangana" class="form-label">Ruangan</label>
                                            <select name="id_ruangana" id="id_ruangana" class="form-select" required>
                                                <option value="" selected disabled>Pilih Ruangan</option>
                                                @foreach ($ruangans as $ruangan)
                                                    <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_jama" class="form-label">Jam</label>
                                            <select name="id_jama" id="id_jama" class="form-select" required>
                                                <option value="" selected disabled>Pilih Jam</option>
                                                @foreach ($jams as $jam)
                                                    <option value="{{ $jam->id }}">{{ $jam->jam_masuk }} - {{ $jam->jam_keluar }} ({{ $jam->hari }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_rombelcreate" class="form-label">Rombel</label>
                                            <select name="id_rombelcreate" id="id_rombelcreate" class="form-select" required>
                                                <option value="" selected disabled>Pilih Rombel</option>
                                                @foreach ($rombels as $rombel)
                                                    <option value="{{ $rombel->id }}">{{ $rombel->kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>

                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                
                            </div>
                        </div>
                    </div> 
                </div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mapel"> Tambah mapel</button>
                <div class="modal fade" id="mapel" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="daftarModalLabel">Pembuatan mapel</h5>
                            <form id="mapel" action="{{ route('mapel.create') }}" method="POST">
                             @csrf
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="nama_mapel" >Nama Mata Pelajaran</label>
                                        <input type="text" id="nama_mapel" name="nama_mapel" required>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                </div>
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ruangan"> Tambah ruangan</button>
            <div class="modal fade" id="ruangan" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="daftarModalLabel">Pembuatan Jadwal</h5>
                        <form id="ruangan" action="{{ route('ruangan.create') }}" method="POST">
                         @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="nama_ruangan" >Nama Ruangan</label>
                                    <input type="text" id="nama_ruangan" name="nama_ruangan" required>
                                </div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rombel"> Tambah Rombel</button>
            <div class="modal fade" id="rombel" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="daftarModalLabel">Pembuatan Jadwal</h5>
                        <form id="rombel" action="{{ route('rombel.create') }}" method="POST">
                         @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="kelas" >Nama Rombel</label>
                                    <input type="text" id="kelas" name="kelas" required>
                                </div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ting"> Tambah tingkatan</button>
            <div class="modal fade" id="ting" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="daftarModalLabel">Pembuatan Jadwal</h5>
                        <form id="ting" action="{{ route('tingkatan.create') }}" method="POST">
                         @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="tingkatan" >Nama Tingkatan</label>
                                    <input type="text" id="tingkatan" name="tingkatan" required>
                                </div>
                                <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jam"> Tambah jam</button>
            <div class="modal fade" id="jam" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="daftarModalLabel">Pembuatan Jadwal</h5>
                        <form id="jam" action="{{ route('jam.create') }}" method="POST">
                         @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="jam_masuk" >Jam Masuk</label>
                                    <input type="time" id="jam_masuk" name="jam_masuk" required>
                                </div>
                                <div class="mb-3">
                                    <label for="jam_keluar" >Jam Keluar</label>
                                    <input type="time" id="jam_keluar" name="jam_keluar" required>
                                </div>
                                <div class="mb-3">
    <label for="hari">Hari</label>
    <select id="hari" name="hari" required>
        <option value="" disabled selected>Pilih Hari</option>
        <option value="Senin">Senin</option>
        <option value="Selasa">Selasa</option>
        <option value="Rabu">Rabu</option>
        <option value="Kamis">Kamis</option>
        <option value="Jumat">Jumat</option>
        <option value="Sabtu">Sabtu</option>
        <option value="Minggu">Minggu</option>
    </select>
</div>

                                <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </div>
    </div>
    <div class="col mt-1">
        <div >

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rombelrv"> Daftar Rombel</button>
            <div class="modal fade" id="rombelrv" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="daftarModalLabel"> </h5>
                        <table class="table">
                        <thead>
        <tr>
            <th>No</th>
            <th>Kelas</th>
            <th>Akhsi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rombels as $item)
        <tr>
            <td>{{ $loop->iteration }}</td> <!-- Nomor urut otomatis -->
            <td>{{ $item->kelas }}</td>
            <td>
            <button class="btn btn-warning btn-sm edit-rombel-btn" data-id="{{ $item->id }}">Edit</button>
            <button class="btn btn-danger btn-sm delete-rombel-btn" data-id="{{ $item->id }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
                    </div>
                </div>
            </div>
        </div>
               <!-- Modal untuk Edit Rombel -->
    <div class="modal fade" id="editRombelModal" tabindex="-1" aria-labelledby="editRombelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRombelModalLabel">Edit Rombel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editRombelForm">
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Nama Kelas</label>
                            <input type="text" class="form-control" id="kelas" name="kelas" required>
                        </div>
                        <input type="hidden" id="rombelId" name="rombelId">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mapelrv"> Daftar Mapel</button>
            <div class="modal fade" id="mapelrv" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="daftarModalLabel"> </h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>mapel</th>
                                    <th>Akhsi</th>
                                </tr>
                            </thead>
    <tbody>
        @foreach($mapels as $item)
        <tr>
            <td>{{ $loop->iteration }}</td> <!-- Nomor urut otomatis -->
            <td>{{ $item->nama_mapel }}</td>
            <td>
            <button class="btn btn-warning btn-sm edit-mapel-btn" data-id="{{ $item->id_mapel }}">Edit</button>
            <button class="btn btn-danger btn-sm delete-mapel-btn" data-id="{{ $item->id_mapel }}">Delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
    </table>
                    </div>
                </div>
            </div>
            </div>
               <!-- Modal untuk Edit Rombel -->
    <div class="modal fade" id="editmapelModal" tabindex="-1" aria-labelledby="editmapelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmapelModalLabel">Edit Rombel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editmapelForm">
                        <div class="mb-3">
                            <label for="nama_mapel" class="form-label">Nama mapel</label>
                            <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" required>
                        </div>
                        <input type="hidden" id="rombelId" name="rombelId">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
            </div>
    </div>
</div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Mapel</th>
                    <th>Pengajar</th>
                    <th>Ruangan</th>
                    <th>Jam</th>
                    <th>Hari</th>
                    <th>Rombel</th>
                    <th>Tingkatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jadwals as $jadwal)
                    <tr>
                        <td>{{ $jadwal->id }}</td>
                        <td>{{ $jadwal->mapel->nama_mapel }}</td>
                        <td>{{ $jadwal->pengajar->user->nama }}</td>
                        <td>{{ $jadwal->ruangan->nama_ruangan }}</td>
                        <td>{{ $jadwal->jam->jam_masuk }} - {{ $jadwal->jam->jam_keluar }}</td>
                        <td>{{ $jadwal->jam->hari }}</td>
                        <td>{{ $jadwal->rombel->kelas }}</td>
                        <td>{{ $jadwal->tingkatan->tingkatan }}</td>
                        <td>
                            <button class="btn btn-warning btn-sm edit-jadwal-btn" data-id="{{ $jadwal->id }}">Edit</button>
                            <button class="btn btn-danger btn-sm delete-jadwal-btn" data-id="{{ $jadwal->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit Jadwal -->
<div class="modal fade" id="editJadwalModal" tabindex="-1" aria-labelledby="editJadwalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editJadwalModalLabel">Edit Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form untuk mengedit jadwal -->
                <form id="editJadwalForm">
                    @csrf
                    <input type="hidden" id="jadwalId" name="jadwal_id">

                    <!-- Mata Pelajaran -->
                    <div class="mb-3">
                        <label for="id_mapel" class="form-label">Mata Pelajaran</label>
                        <select class="form-select" id="id_mapel" name="id_mapel" required>
                            <option value="">Pilih Mata Pelajaran</option>
                            @foreach($mapels as $mapel)
                                <option value="{{ $mapel->id_mapel }}">{{ $mapel->nama_mapel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tingkatan -->
                    </div>
                                        <div class="mb-3">
                                            <label for="id_tingkatan" class="form-label">tingkatan</label>
                                            <select name="id_tingkatan" id="id_tingkatan" class="form-select" required>
                                                <option value="" selected disabled>Pilih Tingkatan</option>
                                                @foreach ($tingkatans as $tingkatan)
                                                    <option value="{{ $tingkatan->id }}">{{ $tingkatan->tingkatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                    <!-- Pengajar -->
                    <div class="mb-3">
                                            <label for="id_pengajar" class="form-label">Pengajar</label>
                                            <select name="id_pengajar" id="id_pengajar" class="form-select" required>
    <option value="" selected disabled>Pilih Pengajar</option>
    @foreach ($pengajars as $pengajar)
        <option value="{{ $pengajar->id_pengajar }}">
            {{ $pengajar->user->nama }} <!-- Menampilkan nama pengajar -->
        </option>
    @endforeach
</select>
                                        </div>

                    <!-- Ruangan -->
                    <div class="mb-3">
                        <label for="id_ruangan" class="form-label">Ruangan</label>
                        <select class="form-select" id="id_ruangan" name="id_ruangan" required>
                            <option value="">Pilih Ruangan</option>
                            @foreach($ruangans as $ruangan)
                                <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                                            <label for="id_jam" class="form-label">Jam</label>
                                            <select name="id_jam" id="id_jam" class="form-select" required>
                                                <option value="" selected disabled>Pilih Jam</option>
                                                @foreach ($jams as $jam)
                                                    <option value="{{ $jam->id }}">{{ $jam->jam_masuk }} - {{ $jam->jam_keluar }} ({{ $jam->hari }})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_rombel" class="form-label">Rombel</label>
                                            <select name="id_rombel" id="id_rombel" class="form-select" required>
                                                <option value="" selected disabled>Pilih Rombel</option>
                                                @foreach ($rombels as $rombel)
                                                    <option value="{{ $rombel->id }}">{{ $rombel->kelas }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>document.addEventListener('DOMContentLoaded', function () {
    // Event listener untuk tombol Edit
    document.querySelectorAll('.edit-mapel-btn').forEach(button => {
        button.addEventListener('click', function () {
            const mapelId = this.dataset.id; // Ambil ID mapel
            console.log("ID Mapel:", mapelId); // Debug ID mapel

            // Fetch data mapel untuk mengisi form
            fetch(`/admin/mapel/${mapelId}/edit`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error); // Tampilkan error jika ada
                } else {
                    // Isi form dengan data mapel
                    document.querySelector('#nama_mapel').value = data.nama_mapel;
                    document.querySelector('#rombelId').value = data.id_mapel;

                    // Tampilkan modal edit
                    const modal = new bootstrap.Modal(document.getElementById('editmapelModal'));
                    modal.show();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memuat data mapel.');
            });
        });
    });

    // Event listener untuk submit form edit mapel
    document.querySelector('#editmapelForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const mapelId = document.querySelector('#rombelId').value;
        const formData = {
            nama_mapel: document.querySelector('#nama_mapel').value,
        };

        console.log('Form data:', formData); // Debug data form

        // Kirim data ke server untuk memperbarui mapel
        fetch(`/admin/mapel/${mapelId}`, {
            method: 'PUT', // Ganti method POST menjadi PUT
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify(formData),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Mapel berhasil diperbarui!');
                location.reload(); // Refresh halaman untuk memuat data baru
            } else if (data.error) {
                alert(data.error); // Menampilkan error
            } else {
                alert('Gagal memperbarui mapel');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengupdate mapel.');
        });
    });

    // Event listener untuk tombol Delete Mapel
    document.querySelectorAll('.delete-mapel-btn').forEach(button => {
        button.addEventListener('click', function () {
            const mapelId = this.dataset.id;

            // Konfirmasi sebelum menghapus
            if (confirm("Apakah Anda yakin ingin menghapus mapel ini?")) {
                // Kirim permintaan DELETE ke server
                fetch(`/admin/mapel/${mapelId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Mapel berhasil dihapus!');
                        location.reload(); // Refresh halaman untuk memuat data baru
                    } else {
                        alert('Gagal menghapus mapel');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus mapel.');
                });
            }
        });
    });
    document.querySelectorAll('.edit-rombel-btn').forEach(button => {
        button.addEventListener('click', function () {
            const rombelId = this.dataset.id; // Ambil ID rombel
            console.log("ID Rombel:", rombelId); // Debug ID rombel

            // Fetch data rombel untuk mengisi form
            fetch(`/admin/rombel/${rombelId}/edit`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error); // Tampilkan error jika ada
                } else {
                    // Isi form dengan data rombel
                    document.querySelector('#rombelId').value = data.id;
                    document.querySelector('#kelasrv').value = data.kelas;

                    // Tampilkan modal edit
                    const modal = new bootstrap.Modal(document.getElementById('editRombelModal'));
                    modal.show();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memuat data rombel.');
            });
        });
    });

    // Event listener untuk submit form edit rombel
    document.querySelector('#editRombelForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const rombelId = document.querySelector('#rombelId').value;
        const formData = {
            kelas: document.querySelector('#kelas').value,
        };

        console.log('Form data:', formData); // Debug data form

        // Kirim data ke server untuk memperbarui rombel
        fetch(`/admin/rombel/${rombelId}`, {
    method: 'POST', // Ganti method POST menjadi PUT
    headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
    },
    body: JSON.stringify(formData),
})
.then(response => response.json())
.then(data => {
    if (data.success) {
        alert('Rombel berhasil diperbarui!');
        location.reload(); // Refresh halaman untuk memuat data baru
    } else if (data.error) {
        alert(data.error); // Menampilkan error
    } else {
        alert('Gagal memperbarui rombel');
    }
})
.catch(error => {
    console.error('Error:', error);
    alert('Terjadi kesalahan saat mengupdate rombel.');
});
    });

    // Event listener untuk tombol Delete
    document.querySelectorAll('.delete-rombel-btn').forEach(button => {
        button.addEventListener('click', function () {
            const rombelId = this.dataset.id;

            // Konfirmasi sebelum menghapus
            if (confirm("Apakah Anda yakin ingin menghapus rombel ini?")) {
                // Kirim permintaan DELETE ke server
                fetch(`/admin/rombel/delete/${rombelId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Rombel berhasil dihapus!');
                        location.reload(); // Refresh halaman untuk memuat data baru
                    } else {
                        alert('Gagal menghapus rombel');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus rombel.');
                });
            }
        });
    });
    document.querySelectorAll('.edit-jadwal-btn').forEach(button => {
        button.addEventListener('click', function () {
            const jadwalId = this.dataset.id; // Ambil ID jadwal
            console.log("ID Jadwal:", jadwalId); // Debug ID jadwal

            // Fetch data jadwal untuk mengisi form
            fetch(`/admin/jadwal/${jadwalId}/edit`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error); // Tampilkan error jika ada
                } else {
                    // Isi form dengan data jadwal
                    document.querySelector('#jadwalId').value = data.id;
                    document.querySelector('#id_mapel').value = data.id_mapel;
                    document.querySelector('#id_tingkatan').value = data.id_tingkatan;
                    document.querySelector('#id_pengajar').value = data.id_pengajar;
                    document.querySelector('#id_ruangan').value = data.id_ruangan;
                    document.querySelector('#id_jam').value = data.id_jam;
                    document.querySelector('#id_rombel').value = data.id_rombel;

                    // Tampilkan modal
                    const modal = new bootstrap.Modal(document.getElementById('editJadwalModal'));
                    modal.show();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat memuat data jadwal.');
            });
        });
    });

    // Event listener untuk submit form
    document.querySelector('#editJadwalForm').addEventListener('submit', function (e) {
        e.preventDefault();

        const jadwalId = document.querySelector('#jadwalId').value;
        const formData = {
            id_mapel: document.querySelector('#id_mapel').value,
            id_tingkatan: document.querySelector('#id_tingkatan').value,
            id_pengajar: document.querySelector('#id_pengajar').value,
            id_ruangan: document.querySelector('#id_ruangan').value,
            id_jam: document.querySelector('#id_jam').value,
            id_rombel: document.querySelector('#id_rombel').value,
        };

        console.log('Form data:', formData); // Debug data form

        // Kirim data ke server
        fetch(`/admin/jadwal/update/${jadwalId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify(formData),
        }) 
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Jadwal berhasil diperbarui!');
                location.reload(); // Refresh halaman untuk memuat data baru
            } else if (data.error) {
                alert(data.error); // Menampilkan error bentrok
            } else {
                alert('Gagal memperbarui jadwal');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengupdate jadwal.');
        });
    });
     // Event listener untuk tombol Delete
     document.querySelectorAll('.delete-jadwal-btn').forEach(button => {
        button.addEventListener('click', function () {
            const jadwalId = this.dataset.id;

            // Konfirmasi sebelum menghapus
            if (confirm("Apakah Anda yakin ingin menghapus jadwal ini?")) {
                // Kirim permintaan DELETE ke server
                fetch(`/admin/jadwal/delete/${jadwalId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Jadwal berhasil dihapus!');
                        location.reload(); // Refresh halaman untuk memuat data baru
                    } else {
                        alert('Gagal menghapus jadwal');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus jadwal.');
                });
            }
        });
    });
    setTimeout(function() {
        const successAlert = document.getElementById('alert-success');
        const errorAlert = document.getElementById('alert-error');
        const errorsAlert = document.getElementById('alert-errors');
        
        if (successAlert) {
            successAlert.style.display = 'none';
        }
        if (errorAlert) {
            errorAlert.style.display = 'none';
        }
        if (errorsAlert) {
            errorsAlert.style.display = 'none';
        }
    }, 1500);
});

</script>
@endsection
