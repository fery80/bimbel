<?php

namespace App\Http\Controllers;
 

use App\Models\Siswa;
use App\Models\User;
use App\Models\Rombel;
use App\Models\Tingkatan;
use App\Models\Mapel;
use App\Models\Jadwal;
use App\Models\Pengajar;
use App\Models\Ruangan;
use App\Models\Jam;
use App\Models\Absensi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
 use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class absensisiswa extends Controller
{
    public function store(Request $request, $id)
    {
        // Ambil data siswa yang sedang login
        $user = Auth::user();
        $siswa = $user->siswa;

        // Pastikan siswa ditemukan
        if (!$siswa) {
            return back()->with('error', 'Siswa tidak ditemukan.');
        }

        // Ambil jadwal berdasarkan ID yang diterima dari URL parameter
        $jadwal = Jadwal::find($id);

        // Pastikan jadwal ditemukan
        if (!$jadwal) {
            return back()->with('error', 'Jadwal tidak ditemukan.');
        }

        // Validasi jika kode absensi sesuai dengan kode yang ada di jadwal
        if ($request->kode_absensi != $jadwal->kode_absensi) {
            return back()->with('error', 'Kode absensi salah.');
        }

        // Validasi agar id_rombel siswa sesuai dengan id_rombel di jadwal
        if ($siswa->id_rombel != $jadwal->id_rombel) {
            return back()->with('error', 'Jadwal ini tidak cocok dengan rombel Anda.');
        }

        // Validasi waktu absensi
        $current_time = now(); // Waktu saat ini
        $waktu_selesai_absen = $jadwal->waktu_selesai_absen ? $jadwal->waktu_selesai_absen : null;  // Ambil waktu selesai absen, jika ada

        // Jika ada waktu_selesai_absen dan waktu sekarang lebih dari waktu_selesai_absen
        if ($waktu_selesai_absen && $current_time > $waktu_selesai_absen) {
            return back()->with('error', 'Waktu absensi sudah melewati batas.');
        }

        // Validasi apakah siswa sudah absen pada jadwal ini
        $existingAbsensi = Absensi::where('id_siswa', $siswa->id)
                                  ->where('id_jadwal', $jadwal->id)
                                  ->first();

        if ($existingAbsensi) {
            return back()->with('error', 'Anda sudah melakukan absensi pada jadwal ini.');
        }

        // Simpan data absensi
        Absensi::create([
            'id_siswa' => $siswa->id,
            'id_jadwal' => $jadwal->id,
            'kode_absensi' => $request->kode_absensi,
            'status_absen' => 'Hadir',  // Status bisa diubah sesuai kebutuhan
            'waktu_absen' => $current_time,
            'id_rombel' => $siswa->id_rombel,
        ]);

        // Kembali ke halaman dengan pesan sukses
        return back()->with('success', 'Absensi berhasil dilakukan.');
    }
    
}
