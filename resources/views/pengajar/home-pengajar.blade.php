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
<style>
            body {
            background-image: url("{{ asset('image/bg.pengajar.png') }}");
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
            <img src="{{ asset('image/pengajar.png') }}" alt="Gambar Murid" class="mt login-foto">
        </div>
        <div class="col-md-6 d-flex align-items-center">
            <div class="mt w-100">    
                
                <!-- Jadwal Table -->
                <table class="table">
                    <thead class="custom-header">
                        @if(Auth::check())
                            <b>Hallo {{ Auth::user()->nama }}</b>
                            <form action="{{ route('logout') }}" method="POST" class="mt-3">
                                @csrf
                                <button type="submit" class="btn btn-danger">Logout</button>
                            </form>
                        @else
                            <script>window.location = "{{ route('login.tampil') }}";</script>
                        @endif

                        <tr><th colspan="4">Jadwal Hari Ini</th></tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>8:00</td>
                            <td>Matematika</td>
                            <td>1D</td>
                            <td>P. Jono</td>
                        </tr>
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