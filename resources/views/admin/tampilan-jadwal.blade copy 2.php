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
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="card my-4 shadow mx-auto" style="width: 80%;">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Daftar Jadwal</h5>
    </div>
    <div class="card-body">
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
});

</script>
@endsection
