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

<div class="container py-5">
    <!-- Tombol Logout -->
    <div class="d-flex justify-content-end mb-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <h1 class="text-center mb-4">Data Siswa</h1>
    <div class="content-wrapper">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Rombel</th>
                    <th>Tingkatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($siswa as $haihai)
                <tr>
                    <td>{{ $haihai->id }}</td>
                    <td>{{ optional($haihai->user)->nama ?? 'Tidak tersedia' }}</td>
                    <td>{{ optional($haihai->user)->email ?? 'Tidak tersedia' }}</td>
                    <td>{{ optional($haihai->rombel)->kelas ?? 'Tidak tersedia' }}</td>
                    <td>{{ optional($haihai->tingkatan)->tingkatan ?? 'Tidak tersedia' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection