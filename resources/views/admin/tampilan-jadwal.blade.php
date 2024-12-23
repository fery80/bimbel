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
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#daftarModal">
    Tambah Jadwal
</button>

<div class="modal fade" id="daftarModal" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="daftarModalLabel">Pembuatan Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <form id="jadwalForm" action="{{ route('jadwal.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <!-- Mapel -->
                    <div class="mb-3">
                        <label for="id_mapel" class="form-label">Mapel</label>
                        <select name="id_mapel" id="id_mapel" class="form-select" required>
                            <option value="" selected disabled>Pilih Mapel</option>
                            @foreach ($mapels as $mapel)
                                <option value="{{ $mapel->id_mapel }}">{{ $mapel->nama_mapel }}</option>
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
                                    {{ $pengajar->user->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tingkatan -->
                    <div class="mb-3">
                        <label for="id_tingkatan" class="form-label">Tingkatan</label>
                        <select name="id_tingkatan" id="id_tingkatan" class="form-select" required>
                            <option value="" selected disabled>Pilih Tingkatan</option>
                            @foreach ($tingkatans as $tingkatan)
                                <option value="{{ $tingkatan->id }}">{{ $tingkatan->tingkatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Ruangan -->
                    <div class="mb-3">
                        <label for="id_ruangan" class="form-label">Ruangan</label>
                        <select name="id_ruangan" id="id_ruangan" class="form-select" required>
                            <option value="" selected disabled>Pilih Ruangan</option>
                            @foreach ($ruangans as $ruangan)
                                <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jam -->
                    <div class="mb-3">
                        <label for="id_jam" class="form-label">Jam</label>
                        <select name="id_jam" id="id_jam" class="form-select" required>
                            <option value="" selected disabled>Pilih Jam</option>
                            @foreach ($jams as $jam)
                                <option value="{{ $jam->id }}">
                                    {{ $jam->jam_masuk }} - {{ $jam->jam_keluar }} ({{ $jam->hari }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Rombel -->
                    <div class="mb-3">
                        <label for="id_rombel" class="form-label">Rombel</label>
                        <select name="id_rombel" id="id_rombel" class="form-select" required>
                            <option value="" selected disabled>Pilih Rombel</option>
                            @foreach ($rombels as $rombel)
                                <option value="{{ $rombel->id }}">{{ $rombel->kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-3">
                        <label for="Tanggal" class="form-label">Tanggal</label>
                        <input type="date" name="Tanggal" id="Tanggal" class="form-control" required>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

        <div class="col mt-1">
            <!-- Tambah Mapel -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mapel">Tambah Mapel</button>
<div class="modal fade" id="mapel" tabindex="-1" aria-labelledby="mapelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mapelLabel">Pembuatan Mapel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="mapelForm" action="{{ route('mapel.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_mapel" class="form-label">Nama Mata Pelajaran</label>
                        <input type="text" id="nama_mapel" name="nama_mapel" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambah Ruangan -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ruangan">Tambah Ruangan</button>
<div class="modal fade" id="ruangan" tabindex="-1" aria-labelledby="ruanganLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ruanganLabel">Pembuatan Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="ruanganForm" action="{{ route('ruangan.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                        <input type="text" id="nama_ruangan" name="nama_ruangan" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambah Rombel -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rombelModal">Tambah Rombel</button>
<div class="modal fade" id="rombelModal" tabindex="-1" aria-labelledby="rombelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="rombelModalLabel">Pembuatan Rombel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="rombelForm" action="{{ route('rombel.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="kelas" class="form-label">Nama Rombel</label>
                        <input type="text" id="kelas" name="kelas" class="form-control" required>
                    </div>
                    @if ($errors->has('kelas'))
                        <div class="alert alert-danger">{{ $errors->first('kelas') }}</div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambah Tingkatan -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ting">Tambah Tingkatan</button>
<div class="modal fade" id="ting" tabindex="-1" aria-labelledby="tingLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tingLabel">Pembuatan Tingkatan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="tingForm" action="{{ route('tingkatan.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="tingkatan" class="form-label">Nama Tingkatan</label>
                        <input type="text" id="tingkatan" name="tingkatan" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Tambah Jam -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jam">Tambah Jam</button>
<div class="modal fade" id="jam" tabindex="-1" aria-labelledby="jamLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jamLabel">Pembuatan Jam</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="jamForm" action="{{ route('jam.create') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="jam_masuk" class="form-label">Jam Masuk</label>
                        <input type="time" id="jam_masuk" name="jam_masuk" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="jam_keluar" class="form-label">Jam Keluar</label>
                        <input type="time" id="jam_keluar" name="jam_keluar" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="hari" class="form-label">Hari</label>
                        <select id="hari" name="hari" class="form-select" required>
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
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <div class="col mt-1">
    <div>
    <!-- Button dan Modal Daftar Rombel -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#rombelrv">Daftar Rombel</button>
    <div class="modal fade" id="rombelrv" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="daftarModalLabel">Daftar Rombel</h5>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($rombels as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
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

    <!-- Modal Edit Rombel -->
    <div class="modal fade" id="editRombelModal" tabindex="-1" aria-labelledby="editRombelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRombelModalLabel">Edit Rombel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('rombel.edit', $rombel->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="kelas" class="form-label">Nama Rombel</label>
                            <input type="text" id="kelas" name="kelas" class="form-control" value="{{ old('kelas', $rombel->kelas) }}" required>
                            @error('kelas')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Button dan Modal Daftar Mapel -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#mapelrv">Daftar Mapel</button>
    <div class="modal fade" id="mapelrv" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="daftarModalLabel">Daftar Mapel</h5>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mapel</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mapels as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
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

    <!-- Modal Edit Mapel -->
    <div class="modal fade" id="editmapelModal" tabindex="-1" aria-labelledby="editmapelModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmapelModalLabel">Edit Mapel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editmapelForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama_mapel" class="form-label">Nama Mapel</label>
                            <input type="text" class="form-control" id="nama_mapel" name="nama_mapel" required>
                        </div>
                        <input type="hidden" id="rombelId" name="rombelId">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Button dan Modal Daftar Ruangan -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ruanganrv">Daftar Ruangan</button>
    <div class="modal fade" id="ruanganrv" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="daftarModalLabel">Daftar Ruangan</h5>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Ruangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ruangans as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->nama_ruangan }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-ruangan-btn" data-id="{{ $item->id }}">Edit</button>
                                <button class="btn btn-danger btn-sm delete-ruangan-btn" data-id="{{ $item->id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit Ruangan -->
    <div class="modal fade" id="editruanganModal" tabindex="-1" aria-labelledby="editruanganModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editruanganModalLabel">Edit Ruangan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editruanganForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="nama_ruangan" class="form-label">Nama Ruangan</label>
                            <input type="text" class="form-control" id="nama_ruangan" name="nama_ruangan" required>
                        </div>
                        <input type="hidden" id="ruanganId" name="ruanganId">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Button dan Modal Daftar Tingkatan -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tingkatanrv">Daftar Tingkatan</button>
    <div class="modal fade" id="tingkatanrv" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="daftarModalLabel">Daftar Tingkatan</h5>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tingkatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tingkatans as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->tingkatan }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-tingkatan-btn" data-id="{{ $item->id }}">Edit</button>
                                <button class="btn btn-danger btn-sm delete-tingkatan-btn" data-id="{{ $item->id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Edit Tingkatan -->
    <div class="modal fade" id="edittingkatanModal" tabindex="-1" aria-labelledby="edittingkatanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edittingkatanModalLabel">Edit Tingkatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="edittingkatanForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="tingkatan" class="form-label">Tingkatan</label>
                            <input type="text" class="form-control" id="tingkatan" name="tingkatan" required>
                        </div>
                        <input type="hidden" id="tingkatanId" name="tingkatanId">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Button dan Modal Daftar Jam -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#jamrv">Daftar Jam</button>
    <div class="modal fade" id="jamrv" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="daftarModalLabel">Daftar Jam</h5>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jam Masuk</th>
                            <th>Jam Keluar</th>
                            <th>Hari</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jams as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->jam_masuk }}</td>
                            <td>{{ $item->jam_keluar }}</td>
                            <td>{{ $item->hari }}</td>
                            <td>
                                <button class="btn btn-warning btn-sm edit-jam-btn" data-id="{{ $item->id }}">Edit</button>
                                <button class="btn btn-danger btn-sm delete-jam-btn" data-id="{{ $item->id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- Modal untuk Edit Jam -->
<div class="modal fade" id="editjamModal" tabindex="-1" aria-labelledby="editjamModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Header Modal -->
            <div class="modal-header">
                <h5 class="modal-title" id="editjamModalLabel">Edit Jam</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body Modal -->
            <div class="modal-body">
                <form id="editjamForm" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Input Jam Masuk -->
                    <div class="mb-3">
                        <label for="jam_masuk" class="form-label">Jam Masuk</label>
                        <input type="time" class="form-control" id="jam_masuk" name="jam_masuk" required>
                    </div>

                    <!-- Input Jam Keluar -->
                    <div class="mb-3">
                        <label for="jam_keluar" class="form-label">Jam Keluar</label>
                        <input type="time" class="form-control" id="jam_keluar" name="jam_keluar" required>
                    </div>

                    <!-- Input Hari -->
                    <div class="mb-3">
                        <label for="hari" class="form-label">Hari</label>
                        <select class="form-control" id="hari" name="hari" required>
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

                    <!-- Input Hidden ID -->
                    <input type="hidden" id="jamId" name="jamId">

                    <!-- Submit Button -->
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
    <div class="container mt-3">
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
                    <th>Tanggal</th>
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
                        <td>{{ $jadwal->Tanggal }}</td>
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
                    <input type="hidden" id="jadwalId" name="jadwal_id" value="{{ old('jadwal_id', $jadwal->id ?? '') }}">

                    <!-- Mata Pelajaran -->
                    <div class="mb-3">
                        <label for="id_mapel" class="form-label">Mata Pelajaran</label>
                        <select class="form-select" id="id_mapel" name="id_mapel" required>
                            <option value="">Pilih Mata Pelajaran</option>
                            @foreach($mapels as $mapel)
                                <option value="{{ $mapel->id_mapel }}" {{ old('id_mapel', $jadwal->id_mapel ?? '') == $mapel->id_mapel ? 'selected' : '' }}>{{ $mapel->nama_mapel }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tingkatan -->
                    <div class="mb-3">
                        <label for="id_tingkatan" class="form-label">Tingkatan</label>
                        <select name="id_tingkatan" id="id_tingkatan" class="form-select" required>
                            <option value="" selected disabled>Pilih Tingkatan</option>
                            @foreach ($tingkatans as $tingkatan)
                                <option value="{{ $tingkatan->id }}" {{ old('id_tingkatan', $jadwal->id_tingkatan ?? '') == $tingkatan->id ? 'selected' : '' }}>{{ $tingkatan->tingkatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pengajar -->
                    <div class="mb-3">
                        <label for="id_pengajar" class="form-label">Pengajar</label>
                        <select name="id_pengajar" id="id_pengajar" class="form-select" required>
                            <option value="" selected disabled>Pilih Pengajar</option>
                            @foreach ($pengajars as $pengajar)
                                <option value="{{ $pengajar->id_pengajar }}" {{ old('id_pengajar', $jadwal->id_pengajar ?? '') == $pengajar->id_pengajar ? 'selected' : '' }}>
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
                                <option value="{{ $ruangan->id }}" {{ old('id_ruangan', $jadwal->id_ruangan ?? '') == $ruangan->id ? 'selected' : '' }}>{{ $ruangan->nama_ruangan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jam -->
                    <div class="mb-3">
                        <label for="id_jam" class="form-label">Jam</label>
                        <select name="id_jam" id="id_jam" class="form-select" required>
                            <option value="" selected disabled>Pilih Jam</option>
                            @foreach ($jams as $jam)
                                <option value="{{ $jam->id }}" {{ old('id_jam', $jadwal->id_jam ?? '') == $jam->id ? 'selected' : '' }}>{{ $jam->jam_masuk }} - {{ $jam->jam_keluar }} ({{ $jam->hari }})</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Rombel -->
                    <div class="mb-3">
                        <label for="id_rombel" class="form-label">Rombel</label>
                        <select name="id_rombel" id="id_rombel" class="form-select" required>
                            <option value="" selected disabled>Pilih Rombel</option>
                            @foreach ($rombels as $rombel)
                                <option value="{{ $rombel->id }}" {{ old('id_rombel', $jadwal->id_rombel ?? '') == $rombel->id ? 'selected' : '' }}>{{ $rombel->kelas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tanggal -->
                    <div class="mb-3">
    <label for="tanggal" class="form-label">Tanggal</label>
    <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{ old('tanggal', $jadwal->Tanggal ?? '') }}" required>
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


</div>
<script>document.addEventListener('DOMContentLoaded', function () {
    // Event listener for Edit buttons
    document.querySelectorAll('.edit-jadwal-btn').forEach(button => {
        button.addEventListener('click', function () {
            const jadwalId = this.dataset.id; // Get Jadwal ID
            console.log("ID Jadwal:", jadwalId); // Debug Jadwal ID

            // Fetch Jadwal data to populate the form
            fetch(`/admin/jadwal/${jadwalId}/edit`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error); // Show error if any
                } else {
                    // Populate form fields with fetched data
                    document.querySelector('#jadwalId').value = data.id;
                    document.querySelector('#id_mapel').value = data.id_mapel;
                    document.querySelector('#id_tingkatan').value = data.id_tingkatan;
                    document.querySelector('#id_pengajar').value = data.id_pengajar;
                    document.querySelector('#id_ruangan').value = data.id_ruangan;
                    document.querySelector('#id_jam').value = data.id_jam;
                    document.querySelector('#id_rombel').value = data.id_rombel;
                    document.querySelector('#tanggal').value = data.Tanggal;

                    // Show modal
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

    // Event listener for submitting the form
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
            Tanggal: document.querySelector('#tanggal').value,
        };

        console.log('Form data:', formData); // Debug form data

        // Send data to server
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
                location.reload(); // Refresh page to load new data
            } else if (data.error) {
                alert(data.error); // Show conflict error
            } else {
                alert('Gagal memperbarui jadwal');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat mengupdate jadwal.');
        });
    });

    // Event listener for Delete buttons
    document.querySelectorAll('.delete-jadwal-btn').forEach(button => {
        button.addEventListener('click', function () {
            const jadwalId = this.dataset.id;

            // Confirmation before delete
            if (confirm("Apakah Anda yakin ingin menghapus jadwal ini?")) {
                // Send DELETE request to server
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
                        location.reload(); // Refresh page to load new data
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

    // Hide success/error alerts after 1.5 seconds
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
const editButtons = document.querySelectorAll('.edit-rombel-btn');
editButtons.forEach((button) => {
    button.addEventListener('click', (event) => {
        const rombelId = event.target.dataset.id;

        // Mengambil data rombel dengan ID yang dipilih (bisa menggunakan fetch/ajax jika perlu)
        fetch(`/admin/rombel/${rombelId}/edit`) // Sesuaikan endpoint
            .then(response => response.json())
            .then(data => {
                // Mengisi form modal dengan data rombel
                const editModal = document.querySelector('#editRombelModal');
                editModal.querySelector('#kelas').value = data.kelas;
                editModal.querySelector('form').action = `/admin/rombel/${rombelId}`; // Sesuaikan endpoint untuk PUT

                // Menampilkan modal
                const bootstrapModal = new bootstrap.Modal(editModal);
                bootstrapModal.show();
            })
            .catch(error => {
                console.error('Error fetching rombel data:', error);
            });
    });
});

// Menambahkan event listener untuk tombol delete rombel
const deleteButtons = document.querySelectorAll('.delete-rombel-btn');
deleteButtons.forEach((button) => {
    button.addEventListener('click', (event) => {
        const rombelId = event.target.dataset.id;

        // Konfirmasi sebelum menghapus
        if (confirm('Apakah Anda yakin ingin menghapus rombel ini?')) {
            // Melakukan permintaan DELETE (bisa menggunakan fetch/ajax)
            fetch(`/admin/rombel/delete/${rombelId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Jadwal berhasil dihapus!');
                        location.reload(); // Refresh page to load new data
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


    document.addEventListener('DOMContentLoaded', () => {
    // Event listener for edit buttons
   const editButtons = document.querySelectorAll('.edit-mapel-btn');
editButtons.forEach((button) => {
    button.addEventListener('click', (event) => {
        const mapelId = event.target.dataset.id;

        // Fetch mapel data for editing
        fetch(`/mapels/${mapelId}/edit`) // Pastikan endpoint ini benar
            .then(response => {
                if (!response.ok) {
                    throw new Error('Failed to fetch mapel data');
                }
                return response.json();
            })
            .then(data => {
                // Populate the edit modal with mapel data
                const editModal = document.querySelector('#editmapelModal');
                editModal.querySelector('#nama_mapel').value = data.nama_mapel; // Sesuaikan ID input
                editModal.querySelector('form').action = `/mapels/${mapelId}`; // Atur action form

                // Show the modal
                const bootstrapModal = new bootstrap.Modal(editModal);
                bootstrapModal.show();
            })
            .catch(error => {
                console.error('Error fetching mapel data:', error);
            });
    });
});
    // Event listener for delete buttons
    const deleteButtons = document.querySelectorAll('.delete-mapel-btn');
    deleteButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            const mapelId = event.target.dataset.id;

            // Confirm before deleting
            if (confirm('Apakah Anda yakin ingin menghapus mapel ini?')) {
                fetch(`/mapels/delete/${mapelId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Jadwal berhasil dihapus!');
                        location.reload(); // Refresh page to load new data
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
});


document.addEventListener('DOMContentLoaded', () => {
    // Event listener untuk tombol Edit Ruangan
    const editButtons = document.querySelectorAll('.edit-ruangan-btn');
    editButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            const ruanganId = event.target.dataset.id;

            // Fetch data ruangan untuk di-edit
            fetch(`/ruangans/${ruanganId}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Isi modal edit dengan data ruangan
                    const editModal = document.querySelector('#editruanganModal');
                    editModal.querySelector('#nama_ruangan').value = data.nama_ruangan;
                    editModal.querySelector('form').action = `/ruangans/${ruanganId}`; // Sesuaikan action form

                    // Tampilkan modal
                    const bootstrapModal = new bootstrap.Modal(editModal);
                    bootstrapModal.show();
                })
                .catch(error => {
                    console.error('Error fetching ruangan data:', error);
                });
        });
    });

    // Event listener untuk tombol Delete Ruangan
    const deleteButtons = document.querySelectorAll('.delete-ruangan-btn');
    deleteButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            const ruanganId = event.target.dataset.id;

            // Konfirmasi sebelum menghapus
            if (confirm('Apakah Anda yakin ingin menghapus ruangan ini?')) {
                fetch(`/ruangans/delete/${ruanganId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Ruangan berhasil dihapus!');
                        location.reload(); // Muat ulang halaman untuk memperbarui data
                    } else {
                        alert('Gagal menghapus ruangan');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus ruangan.');
                });
            }
        });
    });
});

document.addEventListener('DOMContentLoaded', () => {
    // Event listener untuk tombol Edit Tingkatan
    const editButtons = document.querySelectorAll('.edit-tingkatan-btn');
    editButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            const tingkatanId = event.target.dataset.id;

            // Fetch data tingkatan untuk di-edit
            fetch(`/tingkatans/${tingkatanId}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Isi modal edit dengan data tingkatan
                    const editModal = document.querySelector('#edittingkatanModal');
                    editModal.querySelector('#tingkatan').value = data.tingkatan;
                    editModal.querySelector('form').action = `/tingkatans/${tingkatanId}`; // Sesuaikan action form

                    // Tampilkan modal
                    const bootstrapModal = new bootstrap.Modal(editModal);
                    bootstrapModal.show();
                })
                .catch(error => {
                    console.error('Error fetching tingkatan data:', error);
                });
        });
    });

    // Event listener untuk tombol Delete Tingkatan
    const deleteButtons = document.querySelectorAll('.delete-tingkatan-btn');
    deleteButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            const tingkatanId = event.target.dataset.id;

            // Konfirmasi sebelum menghapus
            if (confirm('Apakah Anda yakin ingin menghapus tingkatan ini?')) {
                fetch(`/tingkatans/delete/${tingkatanId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Tingkatan berhasil dihapus!');
                        location.reload(); // Muat ulang halaman untuk memperbarui data
                    } else {
                        alert('Gagal menghapus tingkatan');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus tingkatan.');
                });
            }
        });
    });
});
document.addEventListener('DOMContentLoaded', () => {
    // Event listener untuk tombol Edit Jam
    const editButtons = document.querySelectorAll('.edit-jam-btn');
    editButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            const jamId = event.target.dataset.id;

            // Fetch data jam untuk di-edit
            fetch(`/jams/${jamId}/edit`)
                .then(response => response.json())
                .then(data => {
                    // Isi modal edit dengan data jam
                    const editModal = document.querySelector('#editjamModal');
                    editModal.querySelector('#jam_masuk').value = data.jam_masuk;
                    editModal.querySelector('#jam_keluar').value = data.jam_keluar;
                    editModal.querySelector('#hari').value = data.hari;
                    editModal.querySelector('form').action = `/jams/${jamId}`; // Sesuaikan action form

                    // Tampilkan modal
                    const bootstrapModal = new bootstrap.Modal(editModal);
                    bootstrapModal.show();
                })
                .catch(error => {
                    console.error('Error fetching jam data:', error);
                });
        });
    });

    // Event listener untuk tombol Delete Jam
    const deleteButtons = document.querySelectorAll('.delete-jam-btn');
    deleteButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            const jamId = event.target.dataset.id;

            // Konfirmasi sebelum menghapus
            if (confirm('Apakah Anda yakin ingin menghapus jam ini?')) {
                fetch(`/jams/delete/${jamId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Jam berhasil dihapus!');
                        location.reload(); // Muat ulang halaman untuk memperbarui data
                    } else {
                        alert('Gagal menghapus jam');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus jam.');
                });
            }
        });
    });
});

</script>
@endsection
