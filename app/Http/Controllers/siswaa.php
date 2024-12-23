<?php



namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\user;
use Illuminate\Http\Request;

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
use App\Models\materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class siswaa extends Controller
{
    public function halamansiswa() {
        $user = Auth::user();

        // Cek apakah role user adalah 'siswa'
        if ($user->role == 'siswa') {
            // Ambil data siswa terkait user yang login
            $siswa = $user->siswa;
        
            // Cek apakah siswa ditemukan
            if ($siswa) {
                // Ambil jadwal yang terkait dengan rombel siswa
                $jadwals = $siswa->jadwals;
    
                // Ambil tanggal hari ini dalam format Y-m-d
                $today = Carbon::today()->toDateString(); // Misalnya 2024-12-16
    
                // Filter jadwal yang terjadi pada hari ini
                $jadwalHariIni = $jadwals->filter(function ($jadwal) use ($today) {
                    // Periksa apakah tanggal cocok dengan hari ini
                    return $jadwal->Tanggal == $today;  // Langsung perbandingkan string
                });
                // dd($jadwalHariIni, $today); // Debugging untuk memeriksa data yang dipilih dan tanggal hari ini

            return view('siswa.home-siswa', compact('jadwalHariIni'));
        }
    }
       
    }

        
    public function jadwalsiswa()
    {
        $user = Auth::user();

        // Check if the user role is 'siswa'
        if ($user->role == 'siswa') {
            // Fetch the student data related to the logged-in user
            $siswa = $user->siswa;
        
            // Check if the student exists
            if ($siswa) {
                // Get the jadwals (schedules) related to the student's rombel
                $jadwals = $siswa->jadwals;
        
                // Pass the jadwals to the view
                return view('siswa.jadwal-siswa', compact('jadwals'));
            }
        }
        
        }
        public function downloadMateri($id)
        {
            $materi = Materi::find($id);
        
            if (!$materi) {
                return redirect()->back()->with('error', 'Materi tidak ditemukan.');
            }
        
            $filePath = storage_path('app/public/' . $materi->file_path);
        
            if (!file_exists($filePath)) {
                return redirect()->back()->with('error', 'File tidak ditemukan.');
            }
        
            return response()->download($filePath, basename($materi->file_path));
        }
        public function akun()
        {
            
            $siswa = Siswa::with(['rombel', 'tingkatan'])
            ->where('id_user', Auth::id())
            ->get();

       
                return view('siswa.akun', compact('siswa'));
            
            
        }        
        public function logout(Request $request)
        {
            Auth::guard('web')->logout();
        
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        
            return redirect('/'); // Sesuaikan dengan halaman yang diinginkan
        }
        }