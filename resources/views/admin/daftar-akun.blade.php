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
        <h5 class="mb-0">Daftar Akun</h5>
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-between mb-3">
            <div>
                <label for="roleFilter">Filter Role:</label>
                <select id="roleFilter" class="form-select" style="width: 150px;">
                    <option value="all">Semua</option>
                    <option value="pengajar">Pengajar</option>
                    <option value="siswa">Siswa</option>
                </select>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#daftarModal">
                    Daftar Siswa
                </button>

                <!-- Daftar Siswa -->
                <div class="modal fade" id="daftarModal" tabindex="-1" aria-labelledby="daftarModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="daftarModalLabel">Pendaftaran Siswa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form id="daftarForm" action="{{ route('siswa.create') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="searchInputt" placeholder="Cari nama siswa...">
                                        <input type="hidden" name="id_user" id="userIdInput">
                                        <div id="searchResults" class="search-results" style="display: none;"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="rombel">Rombel:</label>
                                        <select name="id_rombel" id="rombel">
                                            <option value="">Pilih Rombel</option>
                                            @foreach($rombels as $rombel)
                                                <option value="{{ $rombel->id }}">{{ $rombel->kelas }}</option>
                                            @endforeach
                                        </select>
                                        <label for="tingkatan">Tingkatan:</label>
                                        <select name="id_tingkatan" id="tingkatan">
                                            <option value="">Pilih Tingkatan</option>
                                            @foreach($tingkatans as $tingkatan)
                                                <option value="{{ $tingkatan->id }}">{{ $tingkatan->tingkatan }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Daftar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <input type="text" id="searchInput" class="form-control" placeholder="Cari nama atau email...">
            </div>
        </div>
<!-- daftar user -->
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Nomor Induk</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Tanggal Lahir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="dataAkunTable">
                @foreach ($dataakun as $data)
                <tr data-role="{{ $data->role }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->nomor_induk }}</td>
                    <td>{{ $data->email }}</td>
                    <td>{{ $data->role }}</td>
                    <td>{{ $data->tanggal_lahir }}</td>
                    <td>
                        <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $data->id }}">Edit</button>
                        <button class="btn btn-danger btn-sm hapusdatauser" data-id="{{ $data->id }}">Delete</button>
                        <button class="btn btn-primary btn-sm breakdown-btn" data-id="{{ $data->id }}">Breakdown</button>
                    </td>
                </tr> 
                <!-- edit data siswa                -->
                <tr id="edit-form-{{ $data->id }}" style="display: none;">
                    <td colspan="8">
                        <form action="{{ route('user.update', $data->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <label>Nomor Induk</label>
                            <input type="number" name="nomor_induk" class="form-control mb-2" value="{{ $data->nomor_induk }}" required>

                            <label>Nama</label>
                            <input type="text" name="nama" class="form-control mb-2" value="{{ $data->nama }}" required>

                            <label>Email</label>
                            <input type="email" name="email" class="form-control mb-2" value="{{ $data->email }}" required>

                            <label>Password</label>
                            <input type="password" name="password" class="form-control mb-2">

                            <label>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control mb-2" value="{{ $data->tanggal_lahir }}" required>

                            <label>Role</label>
                            <select name="role" class="form-control mb-2" required>
                                <option value="siswa" {{ $data->role == 'siswa' ? 'selected' : '' }}>Siswa</option>
                                <option value="pengajar" {{ $data->role == 'pengajar' ? 'selected' : '' }}>Pengajar</option>
                                <option value="admin" {{ $data->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                            <button type="button" class="btn btn-secondary cancel-edit-btn" data-id="{{ $data->id }}">Batal</button>
                        </form>
                    </td>
                </tr>
                <tr class="breakdown-row" id="breakdown-{{ $data->id }}" style="display: none;">
                    <td colspan="8">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID Siswa</th>
                                    <th>Rombel</th>
                                    <th>Tingkatan</th>
                                    <th>Aksi</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>{{ $data->siswa->rombel->kelas ?? 'Tidak tersedia' }}</td>
                                    <td>{{ $data->siswa->tingkatan->tingkatan ?? 'Tidak tersedia' }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm edit-breakdown-btn" data-id="{{ $data->id }}">Edit</button>
                                        <button class="btn btn-danger btn-sm delete-breakdown-btn" data-id="{{ $data->id }}">Delete</button>
                                        </td>
                                </tr>
                                    <!-- <tr id="editBreakdown-{{ $data->id }}" style="display: none;">
                        <td colspan="4">
                            <form action="{{ route('breakdown.update', $data->id) }}" method="POST">
                                @csrf
                                @method('PUT') -->
                            <label for="rombel-{{ $data->id }}">Rombel:</label>
                            <select name="id_rombel" id="rombel-{{ $data->id }}" class="form-control mb-2">
                               
                                <option value="">Pilih Rombel</option>
                                            @foreach($rombels as $rombel)
                                                <option value="{{ $rombel->id }}">{{ $rombel->kelas }}</option>
                                            
                                @endforeach
                            </select>

                            <label for="tingkatan-{{ $data->id }}">Tingkatan:</label>
                            <select name="id_tingkatan" id="tingkatan-{{ $data->id }}" class="form-control mb-2">
                            <option value="">Pilih Tingkatan</option>
                                            @foreach($tingkatans as $tingkatan)
                                                <option value="{{ $tingkatan->id }}">{{ $tingkatan->tingkatan }}</option>
                                            @endforeach
                            </select>

                            <button type="submit" class="btn btn-primary">Simpan Perubahan rombel dan tingkatan </button>
                            <button type="button" class="btn btn-secondary cancel-edit-breakdown-btn" data-id="{{ $data->id }}">Batal</button>
                        </form>
                    </td>
                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
document.querySelectorAll('.hapusdatauser').forEach(button => {
    button.addEventListener('click', function () {
        const userId = this.dataset.id;

        if (confirm('Apakah Anda yakin ingin menghapus akun ini?')) {
            fetch(`/admin/user/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Akun berhasil dihapus');
                    location.reload(); // Muat ulang halaman
                } else {
                    alert(data.message || 'Gagal menghapus akun');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    });
});
    document.addEventListener('DOMContentLoaded', function () {
    
    document.querySelectorAll('.edit-breakdown-btn').forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.dataset.id;
            const form = document.querySelector(`#editBreakdown-${userId} form`);

            form.addEventListener('submit', function (e) {
                e.preventDefault();

                const formData = new FormData(this);

                fetch(this.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: formData,
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Edit berhasil!');
                            location.reload(); // Muat ulang halaman untuk memperbarui data
                        } else {
                            alert('Gagal mengedit data.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    });
    const deleteButtons = document.querySelectorAll('.delete-btn');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-id');
                // Tombol Edit di Breakdown
    if (event.target && event.target.classList.contains('edit-breakdown-btn')) {
        const userId = event.target.dataset.id;
        alert(`Edit data dengan ID: ${userId}`);
                // Tampilkan atau sembunyikan form edit
                if (editBreakdownRow) {
            editBreakdownRow.style.display = editBreakdownRow.style.display === 'none' ? 'table-row' : 'none';
        
        }
    }
// Tombol Delete di Breakdown
if (event.target && event.target.classList.contains('delete-breakdown-btn')) {
        const userId = event.target.dataset.id;
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            fetch(`/admin/siswa/${userId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Data berhasil dihapus');
                    location.reload(); // Muat ulang halaman
                } else {
                    alert('Gagal menghapus data');
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }
            // Tanyakan konfirmasi dari pengguna
            if (confirm('Apakah Anda yakin ingin menghapus akun ini?')) {
                fetch(`/admin/user/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Akun berhasil dihapus');
                        location.reload(); // Muat ulang halaman
                    } else {
                        alert(data.message || 'Gagal menghapus akun');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
    const searchInput = document.getElementById('searchInputt');
    const searchResults = document.getElementById('searchResults');
    const userIdInput = document.getElementById('userIdInput');
    const roleFilter = document.getElementById('roleFilter');
    const dataAkunTable = document.getElementById('dataAkunTable');
    const searchInputMain = document.getElementById('searchInput');

    // Fungsi pencarian nama siswa di modal
    searchInput.addEventListener('input', function () {
        const searchQuery = this.value.toLowerCase();

        if (searchQuery.length >= 3) { // Mulai pencarian jika input minimal 3 karakter
            fetch(`/admin/search-users?query=${encodeURIComponent(searchQuery)}`)
                .then(response => response.json())
                .then(data => {
                    searchResults.innerHTML = ''; // Kosongkan hasil sebelumnya

                    if (data.users.length > 0) {
                        searchResults.style.display = 'block';
                        data.users.forEach(user => {
                            const div = document.createElement('div');
                            div.classList.add('search-item');
                            div.textContent = user.nama;
                            div.dataset.id = user.id;
                            searchResults.appendChild(div);

                            // Pilih nama yang di-klik
                            div.addEventListener('click', function () {
                                searchInput.value = user.nama;
                                userIdInput.value = user.id;
                                searchResults.style.display = 'none';
                            });
                        });
                    } else {
                        searchResults.style.display = 'none';
                    }
                })
                .catch(error => console.error('Error:', error));
        } else {
            searchResults.style.display = 'none';
        }
    });

    // Tutup hasil pencarian jika klik di luar input atau hasil pencarian
    document.addEventListener('click', function (event) {
        if (!searchInput.contains(event.target) && !searchResults.contains(event.target)) {
            searchResults.style.display = 'none';
        }
    });

    // Kirim form pendaftaran siswa
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

    // Filter tabel akun berdasarkan peran dan pencarian
    roleFilter.addEventListener('change', filterTable);
    searchInputMain.addEventListener('input', filterTable);

    function filterTable() {
        const selectedRole = roleFilter.value.toLowerCase();
        const searchQuery = searchInputMain.value.toLowerCase();
        const rows = dataAkunTable.querySelectorAll('tr[data-role]');

        // Menyembunyikan baris breakdown jika filter diaktifkan
        document.querySelectorAll('.breakdown-btn').forEach(button => {
    button.addEventListener('click', function () {
        const userId = this.dataset.id;
        const breakdownRow = document.getElementById(`breakdown-${userId}`);
        
        // Tampilkan atau sembunyikan baris breakdown
        breakdownRow.style.display = breakdownRow.style.display === 'none' ? 'table-row' : 'none';
    });
});


        // Tampilkan atau sembunyikan baris sesuai filter
        rows.forEach(row => {
            const role = row.getAttribute('data-role').toLowerCase();
            const nama = row.querySelector('td:nth-child(2)').innerText.toLowerCase();
            const email = row.querySelector('td:nth-child(4)').innerText.toLowerCase();

            const roleMatch = (selectedRole === 'all' || role === selectedRole);
            const searchMatch = nama.includes(searchQuery) || email.includes(searchQuery);

            row.style.display = (roleMatch && searchMatch) ? '' : 'none';
        });
    }
   document.getElementById('dataAkunTable').addEventListener('click', function (event) {
        if (event.target && event.target.classList.contains('breakdown-btn')) {
            const userId = event.target.dataset.id;
            const breakdownRow = document.getElementById(`breakdown-${userId}`);
            breakdownRow.style.display = breakdownRow.style.display === 'none' ? 'table-row' : 'none';
        }
        
        // Handle Edit Breakdown Button
        if (event.target && event.target.classList.contains('edit-breakdown-btn')) {
            const userId = event.target.dataset.id;
            const editBreakdownRow = document.getElementById(`editBreakdown-${userId}`);
            if (editBreakdownRow) {
                editBreakdownRow.style.display = editBreakdownRow.style.display === 'none' ? 'block' : 'none';
            }
        }

        // Handle Edit Button
        if (event.target && event.target.classList.contains('edit-btn')) {
            const userId = event.target.dataset.id;
            const editFormRow = document.getElementById(`edit-form-${userId}`);
            editFormRow.style.display = editFormRow.style.display === 'none' ? 'table-row' : 'none';
        }

        // Handle Cancel Edit Button
        if (event.target && event.target.classList.contains('cancel-edit-btn')) {
            const userId = event.target.dataset.id;
            const editFormRow = document.getElementById(`edit-form-${userId}`);
            editFormRow.style.display = 'none';
        }
        
    });
    // Tampilkan atau sembunyikan password ketika tombol 'Geser' ditekan
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const passwordText = this.previousElementSibling;
            const isHidden = passwordText.textContent === '••••••••';
            passwordText.textContent = isHidden ? passwordText.getAttribute('data-password') : '••••••••';
        });
    });


    // Tombol breakdown untuk detail data siswa
    document.querySelectorAll('.breakdown-btn').forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.dataset.id;
            fetch(`/admin/siswa/${userId}/breakdown`)
                .then(response => response.json())
                .then(data => {
                    // Buat baris breakdown di bawah baris yang diklik
                    const breakdownRow = document.createElement('tr');
                    breakdownRow.classList.add('breakdown-row');
                    breakdownRow.innerHTML = `
                        <td colspan="8">
                            <strong>Detail Siswa:</strong>
                            <ul>
                                <li>Nama: ${data.nama}</li>
                                <li>Email: ${data.email}</li>
                                <li>Tanggal Lahir: ${data.tanggal_lahir}</li>
                                <li>Nomor Induk: ${data.nomor_induk}</li>
                                <li>Role: ${data.role}</li>
                            </ul>
                        </td>
                    `;

                    // Menambahkan baris breakdown tepat di bawah baris yang diklik
                    this.closest('tr').after(breakdownRow);
                })
                .catch(error => console.error('Error:', error));
        });
    });
  

});

</script>
@endsection
 