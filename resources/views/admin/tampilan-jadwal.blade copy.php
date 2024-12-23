@extends('layoutadmin')

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

<div class="card my-4 shadow mx-auto" style="width: 80%;">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Daftar Jadwal</h5>
    </div>
    <div class="card-body">
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
    <label for="id_mapel" class="form-label">Mapel</label>
    <select name="id_mapel" id="id_mapel" class="form-select" required>
        <option value="" selected disabled>Pilih Mapel</option>
        @foreach ($mapels as $mapel)
            <option value="{{ $mapel->id_mapel }}">{{ $mapel->nama_mapel }}</option>
        @endforeach
    </select>
</div>

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
                                        <div class="mb-3">
                                            <label for="id_tingkatan" class="form-label">tingkatan</label>
                                            <select name="id_tingkatan" id="id_tingkatan" class="form-select" required>
                                                <option value="" selected disabled>Pilih Tingkatan</option>
                                                @foreach ($tingkatans as $tingkatan)
                                                    <option value="{{ $tingkatan->id }}">{{ $tingkatan->tingkatan }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="id_ruangan" class="form-label">Ruangan</label>
                                            <select name="id_ruangan" id="id_ruangan" class="form-select" required>
                                                <option value="" selected disabled>Pilih Ruangan</option>
                                                @foreach ($ruangans as $ruangan)
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
                <td>{{ $jadwal->jam->hari }} </td>
                <td>{{ $jadwal->rombel->kelas }}</td>
                <td>{{ $jadwal->tingkatan->tingkatan }}</td>
                <td>
                    <button class="btn btn-warning btn-sm edit-jadwal-btn" data-id="{{ $jadwal->id }}">Edit</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal Edit Jadwal -->
<div class="modal fade" id="editJadwalModal" tabindex="-1" aria-labelledby="editJadwalModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editJadwalModalLabel">Edit Jadwal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editJadwalForm">
                    @csrf
                    <!-- Hidden input untuk ID jadwal -->
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
                    <div class="mb-3">
                        <label for="id_tingkatan" class="form-label">Tingkatan</label>
                        <select class="form-select" id="id_tingkatan" name="id_tingkatan" required>
                            <option value="">Pilih Tingkatan</option>
                            @foreach($tingkatans as $tingkatan)
                                <option value="{{ $tingkatan->id }}">{{ $tingkatan->nama_tingkatan }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Pengajar -->
                    <div class="mb-3">
                        <label for="id_pengajar" class="form-label">Pengajar</label>
                        <select class="form-select" id="id_pengajar" name="id_pengajar" required>
                            <option value="">Pilih Pengajar</option>
                            @foreach($pengajars as $pengajar)
                                <option value="{{ $pengajar->id_pengajar }}">{{ $pengajar->nama_pengajar }}</option>
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

                    <!-- Jam -->
                    <div class="mb-3">
                        <label for="id_jam" class="form-label">Jam</label>
                        <select class="form-select" id="id_jam" name="id_jam" required>
                            <option value="">Pilih Jam</option>
                            @foreach($jams as $jam)
                                <option value="{{ $jam->id }}">{{ $jam->nama_jam }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Rombel -->
                    <div class="mb-3">
                        <label for="id_rombel" class="form-label">Rombel</label>
                        <select class="form-select" id="id_rombel" name="id_rombel" required>
                            <option value="">Pilih Rombel</option>
                            @foreach($rombels as $rombel)
                                <option value="{{ $rombel->id }}">{{ $rombel->nama_rombel }}</option>
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


</div>

</div>




<script>
        document.getElementById('id_mapel').addEventListener('change', function () {
        const selectedOption = this.options[this.selectedIndex];
        const pengajarId = selectedOption.getAttribute('data-pengajar');
        const tingkatanId = selectedOption.getAttribute('data-tingkatan');
        const pengajarName = selectedOption.textContent;

        // Set nilai pengajar dan tingkatan
        document.getElementById('id_pengajar').value = pengajarId || '';
        document.getElementById('nama_pengajar').value = pengajarName || '';
        
        // Menampilkan tingkatan
        document.getElementById('id_tingkatan').value = tingkatanId || '';
       
    });

    document.getElementById('daftarForm').addEventListener('submit', function (e) {
        e.preventDefault(); // Mencegah submit default

        const formData = new FormData(this);

        fetch('/admin/siswa', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Siswa berhasil didaftarkan');
                new bootstrap.Modal(document.getElementById('daftarModal')).hide();
                location.reload();
            } else {
                alert('Gagal mendaftar siswa');
            }
        })
        .catch(error => console.error('Error:', error));
    });
    document.getElementById('mapel').addEventListener('submit', function (e) {
        e.preventDefault(); // Mencegah submit default

        const formData = new FormData(this);

        fetch('/admin/siswa', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Siswa berhasil didaftarkan');
                new bootstrap.Modal(document.getElementById('mapel')).hide();
                location.reload();
            } else {
                alert('Gagal mendaftar siswa');
            }
        })
        .catch(error => console.error('Error:', error));
    });
    document.getElementById('ruangan').addEventListener('submit', function (e) {
        e.preventDefault(); // Mencegah submit default

        const formData = new FormData(this);

        fetch('/admin/siswa', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Siswa berhasil didaftarkan');
                new bootstrap.Modal(document.getElementById('ruangan')).hide();
                location.reload();
            } else {
                alert('Gagal mendaftar siswa');
            }
        })
        .catch(error => console.error('Error:', error));
    });
    document.getElementById('rombel').addEventListener('submit', function (e) {
        e.preventDefault(); // Mencegah submit default

        const formData = new FormData(this);

        fetch('/admin/siswa', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Siswa berhasil didaftarkan');
                new bootstrap.Modal(document.getElementById('rombel')).hide();
                location.reload();
            } else {
                alert('Gagal mendaftar siswa');
            }
        }) 
        .catch(error => console.error('Error:', error));
    });
    document.getElementById('ting').addEventListener('submit', function (e) {
        e.preventDefault(); // Mencegah submit default

        const formData = new FormData(this);

        fetch('/admin/siswa', {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Siswa berhasil didaftarkan');
                new bootstrap.Modal(document.getElementById('ting')).hide();
                location.reload();
            } else {
                alert('Gagal mendaftar siswa');
            }
        })
        .catch(error => console.error('Error:', error));
    });
    document.querySelectorAll('.edit-jadwal-btn').forEach(button => {
    button.addEventListener('click', function () {
        const jadwalId = this.dataset.id;

        // Ambil data jadwal menggunakan fetch
        fetch(`/jadwal/${jadwalId}/edit`)
            .then(response => response.json())
            .then(data => {
                // Isi form dengan data yang didapatkan
                document.querySelector('#jadwalId').value = data.id;
                document.querySelector('#id_mapel').value = data.id_mapel;
                document.querySelector('#id_tingkatan').value = data.id_tingkatan;
                document.querySelector('#id_pengajar').value = data.id_pengajar;
                document.querySelector('#id_ruangan').value = data.id_ruangan;
                document.querySelector('#id_jam').value = data.id_jam;
                document.querySelector('#id_rombel').value = data.id_rombel;

                // Tampilkan modal untuk edit jadwal
                const modal = new bootstrap.Modal(document.getElementById('editJadwalModal'));
                modal.show();
            })
            .catch(error => console.error('Error:', error));
    });
});
document.querySelector('#editJadwalForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    const jadwalId = document.querySelector('#jadwalId').value;

    // Kirim data ke server
    fetch(`/jadwal/update/${jadwalId}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
        },
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Jadwal berhasil diperbarui!');
            location.reload(); // Memuat ulang halaman
        } else {
            alert('Gagal memperbarui jadwal.');
        }
    })
    .catch(error => console.error('Error:', error));
});

</script>
@endsection