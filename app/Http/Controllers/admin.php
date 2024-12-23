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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\DB;
class admin extends Controller
{

    public function daftarakun() {
        $dataakun = User::with(['siswa.rombel', 'siswa.tingkatan'])->get(); 
        $rombels = Rombel::all(['id', 'kelas']); 
        $tingkatans = Tingkatan::all(['id', 'tingkatan']);
        
        return view('admin.daftarakun', compact('dataakun', 'rombels', 'tingkatans'));
        return response()->json([
            'siswa' => $siswa
        ]);
        
    }
    public function tambah(Request $request)
    {
        $validated = $request->validate([
            'id_user' => 'required|exists:users,id', 
            'id_rombel' => 'required|exists:rombel,id', 
            'id_tingkatan' => 'required|exists:tingkatan,id', 
        ]);
    
        // Cek apakah siswa dengan id_user sudah terdaftar
        $existingSiswa = Siswa::where('id_user', $request->id_user)->first();
    
        if ($existingSiswa) {
            // Jika sudah terdaftar, kembalikan dengan pesan error
            return redirect()->back()->with('error', 'Siswa tersebut sudah terdaftar.');
        }
    
        // Jika belum terdaftar, tambahkan siswa baru
        $siswa = new Siswa();
        $siswa->id_user = $request->id_user;
        $siswa->id_rombel = $request->id_rombel; 
        $siswa->id_tingkatan = $request->id_tingkatan;
        $siswa->save();
    
        // Mengatur pesan flash dan redirect
        return redirect()->back()->with('message', 'Siswa telah terdaftarkan.');
    }
    


    public function searchUsers(Request $request )
    {
        $query = $request->input('query');
        $users = User::where('nama', 'like', '%' . $query . '%')->get(['id', 'nama']);
        
        return response()->json(['users' => $users]);
    }
    public function updateRombelTingkatan(Request $request, $id_user) 
    {
        // Validasi input
        $validated = $request->validate([
            'id_rombel' => 'required|exists:rombel,id',
            'id_tingkatan' => 'required|exists:tingkatan,id',
        ]);
    
        // Temukan data siswa berdasarkan id_user
        $siswa = Siswa::where('id_user', $id_user)->first();
    
        if (!$siswa) {
            return redirect()->back()->with('error', 'daftarkan dulu.');
        }
    
        try {
            // Update data siswa
            $siswa->id_rombel = $request->id_rombel;
            $siswa->id_tingkatan = $request->id_tingkatan;
            $siswa->save();
    
            return redirect()->back()->with('success', 'Rombel dan tingkatan telah terupdate.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data.');
        }
    }
    
    
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nomor_induk' => 'required|unique:users,nomor_induk,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
            'nama' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'role' => 'required|string',

        ]);
    
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('user.index')->with('error', 'Akun tidak ditemukan');
        }
    

        $user->nomor_induk = $request->nomor_induk;
        $user->email = $request->email;
        $user->nama = $request->nama;
        $user->tanggal_lahir = $request->tanggal_lahir;
        $user->role = $request->role;
        $user->save();
        $siswa = $user->siswa()->first(); 
 
    
        return redirect()->route('user.index')->with('success', 'Akun dan data tambahan berhasil diperbarui');
    }
    // public function destroy($id)
    // {
    //     try {
    //         $user = User::findOrFail($id);
    //         $user->delete();
    
    //         return response()->json(['success' => 'User deleted successfully']);
    //     } catch (\Exception $e) {
    //         // Log error atau beri pesan error yang lebih spesifik
    //         return response()->json(['error' => 'Failed to delete user'], 500);
    //     }
    // }

    function submitRegistrasi(Request $request) {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'nomer_induk' => 'required|unique:users,nomor_induk',
            'nama' => 'required|string|max:255',
            'gmail' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:siswa,pengajar,admin',
            'tanggal_lahir' => 'required|date',
        ]);
    
        // Cek jika validasi gagal
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Menyimpan data ke database jika validasi berhasil
        $user = new User();
        $user->nomor_induk = $request->nomer_induk;
        $user->nama = $request->nama;
        $user->email = $request->gmail;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->tanggal_lahir = $request->tanggal_lahir;
    
        $user->save();
    
        return redirect()->route('daftarakunadmin');
    }
    function registrasiadmin(){
        return view('admin.registrasi-admin');
     }
    function homeadmin(){
        return view('admin.home-admin');
     }
     















    

    
    public function updateBreakdown(Request $request, $id_user)
{
    // Validasi input
    $validated = $request->validate([
        'id_rombel' => 'required|exists:rombel,id',
        'id_tingkatan' => 'required|exists:tingkatan,id',
    ]);

    // Temukan data siswa berdasarkan id_user
    $siswa = Siswa::where('id_user', $id_user)->first();
    if (!$siswa) {
        return response()->json(['success' => false, 'message' => 'Siswa tidak ditemukan'], 404);
    }

    // Update data siswa
    $siswa->id_rombel = $request->id_rombel;
    $siswa->id_tingkatan = $request->id_tingkatan;
    $siswa->save();

    return response()->json(['success' => true, 'message' => 'Edit berhasil!']);
}

public function hapusdatauser($id)
{
    // Cari data user berdasarkan ID
    $user = User::findOrFail($id);
        
    // Hapus data user
    $user->delete();

    // Redirect kembali ke halaman dengan pesan sukses
    return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
}

public function destroy($id_user)
{
    // Cari siswa berdasarkan id_user
    $siswa = Siswa::where('id_user', $id_user)->first();

    if ($siswa) {
        $siswa->delete();
        return response()->json(['message' => 'Data berhasil dihapus']);
    }

    return response()->json(['message' => 'Data tidak ditemukan'], 404);
}
public function akun()
{
    // Ambil data siswa berdasarkan id_user yang sama dengan Auth::id()
    $siswa = user::where('id', Auth::id())
                 ->get(['nama', 'email']); // Ambil hanya nama dan email saja

    // Mengirim data siswa ke view 'admin.akun'
    return view('admin.akun', compact('siswa'));
}

}
