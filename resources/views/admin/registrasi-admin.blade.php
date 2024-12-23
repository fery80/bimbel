@extends('layoutadmin')
@section('konten')

<div class="text-center mt-1">
        <h2>Registrasi</h2>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">                    
                    <div class="card-body text-start">
                    <form action="{{route('Registrasi.submit')}}" method="post">
                        @csrf
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <label>Nomor Induk</label>
                        <input type="number" name="nomer_induk" class="form-control mb-2" value="{{ old('nomer_induk') }}" required>
                        
                        <label>Nama</label>
                        <input type="text" name="nama" class="form-control mb-2" value="{{ old('nama') }}" required> 
                        
                        <label>Email</label>
                        <input type="email" name="gmail" class="form-control mb-2" value="{{ old('gmail') }}" required>
                        
                        <label>Password</label>
                        <input type="password" name="password" class="form-control mb-2" required>
                        
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" class="form-control mb-2" value="{{ old('tanggal_lahir') }}" required>
                        
                            <label>role</label>
                            <select name="role" class="form-control mb-2" required>
                            <option value="siswa">siswa</option>
                            <option value="pengajar">pengajar</option>
                            <option value="admin">admin</option>
                        </select>

                            <button class="btn btn-primary">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection