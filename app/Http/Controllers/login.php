<?php


namespace App\Http\Controllers;

use App\Models\user;
use App\Models\siswaa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class login extends Controller
{ function tampilRegistrasi(){
   return view('registrasi');
}

function tampillogin(){
   return view('login');
}
public function submitlogin(Request $request) {
    $data = $request->only('nomor_induk', 'password'); // Gunakan 'nomor_induk' dan 'password'

    if (Auth::attempt($data)) {
        $request->session()->regenerate();

        // Cek jika pengguna sudah terautentikasi
        if (Auth::check()) {
            $user = Auth::user();

            // Cek peran (role) pengguna dan arahkan ke halaman yang sesuai
            if ($user->role == 'siswa') {
                return redirect()->route('siswa'); // Sesuaikan dengan route untuk siswa
            } elseif ($user->role == 'pengajar') {
                return redirect()->route('halaman-pengajar'); // Sesuaikan dengan route untuk pengajar
            } elseif ($user->role == 'admin') {
                return redirect()->route('homeadmin'); // Sesuaikan dengan route untuk admin
            }

            // Jika tidak ada role yang cocok, kembali ke login
            return redirect()->route('login.tampil')->with('error', 'Peran pengguna tidak valid');
        }
    }

    // Jika login gagal, arahkan ke halaman login dengan pesan error
    return redirect()->route('login.tampilan')->with('error', 'Akun tidak ditemukan');
}

public function logout(Request $request)
    {
        // Melakukan logout
        Auth::logout();

        // Mengalihkan pengguna ke halaman login setelah logout
        return redirect()->route('login.tampil');
    }
    public function userInfo()
    {
        // Ambil informasi pengguna yang sedang login dan muat relasi pengajar dan jadwal
        $user = Auth::user();

        // Jika user adalah pengajar, ambil data pengajar dan jadwals
        if ($user->role === 'pengajar') {
            $pengajar = $user->pengajar; // Ambil data pengajar yang terkait
            $jadwals = $pengajar->jadwals; // Ambil jadwals yang terkait dengan pengajar

            // Tampilkan data menggunakan dd()
            dd($user, $pengajar, $jadwals);
        }

        // Jika bukan pengajar, tampilkan data user saja
        dd($user);
    }
}