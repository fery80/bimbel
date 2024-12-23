<?php

namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Log;

use App\Models\Rombel;
use App\Models\Tingkatan;
use App\Models\Mapel;
use App\Models\Jadwal;
use App\Models\Pengajar;
use App\Models\Ruangan;
use App\Models\Jam;
use App\Models\absensi;
use Illuminate\Http\Request;
use Carbon\Carbon;

class absensipengajar extends Controller
{
    public function store(Request $request,$id)
    {
        $request->validate([
            'kodeAbsensi' => 'required|string|max:255',
        ]);
    
        // Ambil data jadwal berdasarkan ID yang diterima dari URL
        $jadwal = Jadwal::find($id);
    
        if ($jadwal) {
            // Update waktu_mulai_absen dengan waktu saat ini
            $jadwal->waktu_mulai_absen = Carbon::now();
            $jadwal->kode_absensi = $request->kodeAbsensi; // Simpan kode absensi
            $jadwal->save();
    
            // Redirect atau beri response
            return redirect()->back()->with('success', 'Absensi dimulai!');
        } else {
            return redirect()->back()->with('error', 'Jadwal tidak ditemukan!');
        }
    }
    public function updateWaktuSeleseiAbsen($id)
    {
               // Mencari jadwal berdasarkan ID yang diterima dari URL
               $jadwal = Jadwal::find($id);

               // Memastikan jadwal ditemukan
               if ($jadwal) {
                   // Mengupdate kolom waktu_selesei_absen dengan waktu saat ini
                   $jadwal->waktu_selesai_absen = Carbon::now();
                   $jadwal->save();
       
                   // Mengembalikan response sukses
                   return response()->json(['success' => true]);
               }
       
               // Mengembalikan response gagal jika jadwal tidak ditemukan
               return response()->json(['success' => false]);
    }
    public function getAbsensi($id)
{
    // Ambil data siswa yang sudah absen berdasarkan id_jadwal
    $siswaAbsen = Absensi::where('id_jadwal', $id)
    ->join('siswa', 'siswa.id', '=', 'absensi.id_siswa') // Join dengan tabel siswa
    ->join('users', 'users.id', '=', 'siswa.id_user') // Join dengan tabel user untuk mendapatkan nama
    ->select('users.nama as nama') // Ambil nama dari tabel users
    ->get();

    return response()->json($siswaAbsen);
}

}
