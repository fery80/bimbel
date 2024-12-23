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
    <div class="alert alert-danger" id="alert-errors">
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
                                <form id="daftarForm" action="{{ route('siswa.tambah') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="nama" class="form-label">Nama</label>
                                        <input type="text" class="form-control" id="searchInput" placeholder="Cari nama siswa...">
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
                <input type="text" id="searchInputt" class="form-control" placeholder="Cari nama atau email...">
            </div>
        </div>
         <!-- Tabel Daftar Akun -->
         <table class="table table-bordered mt-4">
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
        <tr class="edit-form-row edit-form-row-{{ $data->id }}" style="display: none;">
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
        <!-- Breakdown details, hidden initially -->
        <tr class="breakdown-row" id="breakdown-{{ $data->id }}" style="display: none;">
            <td colspan="7">
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
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                        <!-- Form edit, hidden initially -->
                        <tr class="edit-form-row" id="edit-form-row{{ $data->id }}" style="display: none;">
                            <td colspan="7">
                            <form action="{{ route('update.rombel.tingkatan', ['id_user' => $data->id]) }}" method="POST">

                                    @csrf
                                    <input type="hidden" name="id_user" value="{{ $data->id }}">

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


                                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('searchInput');
    const searchResults = document.getElementById('searchResults');
    const userIdInput = document.getElementById('userIdInput');
    

    // Pencarian pengguna
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

    // Tombol Edit Pengguna
 // Tombol Edit Pengguna
const editButtons = document.querySelectorAll('.edit-btn');
editButtons.forEach(button => {
    button.addEventListener('click', function () {
        const userId = this.getAttribute('data-id');
        const editFormRow = document.querySelector('.edit-form-row-' + userId);

        // Sembunyikan semua form edit lainnya dan tampilkan kembali tombol Edit
        document.querySelectorAll('.edit-form-row').forEach(form => {
            form.style.display = 'none';
        });
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.style.display = 'inline-block';
        });

        // Tampilkan form edit untuk user yang diklik
        editFormRow.style.display = 'table-row';

        // Sembunyikan tombol Edit yang diklik
        this.style.display = 'none';
    });
});


// Tombol Batal Edit Pengguna
const cancelEditButtons = document.querySelectorAll('.cancel-edit-btn');
cancelEditButtons.forEach(button => {
    button.addEventListener('click', function () {
        const userId = this.getAttribute('data-id');
        const editFormRow = document.querySelector('.edit-form-row-' + userId);
        const editButton = document.querySelector('.edit-btn[data-id="' + userId + '"]');

        // Sembunyikan form edit dan tampilkan tombol Edit
        editFormRow.style.display = 'none';
        editButton.style.display = 'inline-block';
    });
});


    // Tombol Breakdown untuk Menampilkan Data
    const breakdownButtons = document.querySelectorAll('.breakdown-btn');
    breakdownButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-id');
            const breakdownRow = document.getElementById('breakdown-' + userId);

            // Sembunyikan breakdown row lainnya sebelum menampilkan yang baru
            document.querySelectorAll('.breakdown-row').forEach(row => {
                if (row !== breakdownRow) {
                    row.style.display = 'none'; // Sembunyikan breakdown yang lain
                }
            });

            // Toggle breakdown row
            breakdownRow.style.display = (breakdownRow.style.display === 'none') ? 'table-row' : 'none';
        });
    });

    // Tombol Edit Breakdown
    const editBreakdownButtons = document.querySelectorAll('.edit-breakdown-btn');
    editBreakdownButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-id');
            const editBreakdownFormRow = document.getElementById('edit-form-row' + userId);

            // Tampilkan form edit breakdown
            editBreakdownFormRow.style.display = 'table-row';

            // Sembunyikan tombol Edit Breakdown
            this.style.display = 'none';
        });
    });

    // Tombol Batal Edit Breakdown
    const cancelEditBreakdownButtons = document.querySelectorAll('.cancel-edit-breakdown-btn');
    cancelEditBreakdownButtons.forEach(button => {
        button.addEventListener('click', function () {
            const userId = this.getAttribute('data-id');
            const editBreakdownFormRow = document.getElementById('edit-form-row' + userId);
            const editButton = document.querySelector('.edit-breakdown-btn[data-id="' + userId + '"]');

            // Sembunyikan form edit breakdown dan tampilkan tombol Edit Breakdown
            editBreakdownFormRow.style.display = 'none';
            editButton.style.display = 'inline-block';
        });
    });

    // Sembunyikan alert sukses atau error setelah 1.5 detik
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

    // Fitur Filter berdasarkan Role

    // Tombol Hapus Pengguna
    const deleteButtons = document.querySelectorAll('.hapusdatauser');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            
            // Menampilkan konfirmasi penghapusan
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                // Kirim permintaan untuk menghapus data
                fetch(`/admin/delete-user/${userId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Jika menggunakan Laravel
                    }
                })
                .then(response => {
                    if (response.ok) {
                        // Menghapus baris yang relevan dari tabel setelah berhasil menghapus
                        const row = this.closest('tr');
                        row.remove();
                        alert('Data berhasil dihapus');
                    } else {
                        alert('Gagal menghapus data');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat menghapus data');
                });
            }
        });
    });
    
    
});
// Mendapatkan elemen select, input pencarian, dan tbody
const roleFilter = document.getElementById('roleFilter');
const searchInput = document.getElementById('searchInputt');
const dataAkunTable = document.getElementById('dataAkunTable');

// Fungsi untuk memfilter tabel berdasarkan role
roleFilter.addEventListener('change', () => {
    filterTable();
});

// Fungsi untuk memfilter tabel berdasarkan input pencarian
searchInput.addEventListener('input', () => {
    filterTable();
});

// Fungsi untuk memfilter tabel berdasarkan role dan input pencarian
function filterTable() {
    const selectedRole = roleFilter.value.toLowerCase(); // Nilai role yang dipilih
    const searchText = searchInput.value.toLowerCase(); // Teks pencarian

    // Mendapatkan semua baris dalam tabel
    const rows = dataAkunTable.querySelectorAll('tr[data-role]');

    rows.forEach(row => {
        const rowRole = row.getAttribute('data-role').toLowerCase();
        const rowText = row.textContent.toLowerCase();

        // Logika untuk menampilkan atau menyembunyikan baris
        const matchesRole = selectedRole === 'all' || rowRole === selectedRole;
        const matchesSearch = rowText.includes(searchText);

        if (matchesRole && matchesSearch) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });}
 // Pastikan Anda telah menyertakan jQuery di proyek Anda.
 $(document).on('click', '.delete-breakdown-btn', function() {
    // Ambil ID dari data-id pada tombol (id_user)
    const userId = $(this).data('id');

    // Tampilkan konfirmasi sebelum menghapus
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
        // Kirimkan request DELETE ke URL yang sesuai dengan id_user
        $.ajax({
            url: `/admin/ssiswa/${userId}`,  // Sesuaikan dengan route destroy di Laravel
            type: 'DELETE',
            data: {
                "_token": "{{ csrf_token() }}"  // Menyertakan CSRF token
            },
            success: function(response) {
                alert('Data berhasil dihapus');
                location.reload();  // Refresh halaman setelah berhasil menghapus
            },
            error: function(xhr, status, error) {
                alert('Siswa tidak memiliki atribut tersebut');
            }
        });
    }
});




</script>

@endsection
