<?php



namespace App\Http\Controllers;

use App\Models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
namespace App\Http\Controllers;
use App\Models\Siswa;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Rombel;
use App\Models\Tingkatan;
use App\Models\Mapel;
use App\Models\Jadwal;
use App\Models\Pengajar;
use App\Models\Ruangan;
use App\Models\Jam;
use Illuminate\Http\Request;

class pengajarr extends Controller
{
    public function halamanpengajar() {
        return view('pengajar.home-pengajar');
    }
    public function jadwalPengajar()
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Pastikan user adalah pengajar
        if ($user->role === 'pengajar') {
            // Ambil data pengajar berdasarkan user yang sedang login
            $pengajar = $user->pengajar;

            // Ambil jadwal yang terkait dengan pengajar
            $jadwals = $pengajar->jadwals;
            $mapels = Mapel::all();
            $tingkatans = Tingkatan::all();
            $pengajars = Pengajar::all();
            $ruangans = Ruangan::all();
            $jams = Jam::all();
            $rombels = Rombel::all();
           
            return view('pengajar.jadwal-pengajar', compact('mapels', 'tingkatans', 'pengajars', 'ruangans', 'jams', 'rombels','jadwals'));
            // Kirimkan data jadwal ke view
           
        }

        // Jika bukan pengajar, tampilkan pesan atau data lainnya
        return response()->json(['message' => 'Anda bukan pengajar.']);
    }
   
}
