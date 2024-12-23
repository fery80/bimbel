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
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Facades\DB;
class admin extends Controller
{
    public function homeadmin() {
        return view('admin.home-admin');
    }
    public function registrasiadmin() {
        return view('admin.registrasi-admin');
    }
    public function daftarakun() {
        $dataakun = User::with(['siswa.rombel', 'siswa.tingkatan'])->get(); 
        $rombels = Rombel::all(['id', 'kelas']); 
        $tingkatans = Tingkatan::all(['id', 'tingkatan']);
        
        return view('admin.daftar-akun', compact('dataakun', 'rombels', 'tingkatans'));
        return response()->json([
            'siswa' => $siswa
        ]);
        
    }
    public function create(Request $request)
    {

        $validated = $request->validate([
            'id_user' => 'required|exists:users,id', 
            'id_rombel' => 'required|exists:rombel,id', 
            'id_tingkatan' => 'required|exists:tingkatan,id', 
        ]);
        $siswa = new Siswa();
        $siswa->id_user = $request->id_user;
        $siswa->id_rombel = $request->id_rombel; 
        $siswa->id_tingkatan = $request->id_tingkatan;
        $siswa->save();
    
        return response()->json(['success' => true, 'message' => 'Pendaftaran siswa berhasil.']);

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
public function searchUsers(Request $request)
{
    $query = $request->input('query');
    $users = User::where('nama', 'like', '%' . $query . '%')->get(['id', 'nama']);
    
    return response()->json(['users' => $users]);
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
public function destroy($id)
{
    $user = User::find($id);

    if ($user) {
        $user->delete();
        return response()->json(['success' => true, 'message' => 'Akun berhasil dihapus']);
    }

    return response()->json(['success' => false, 'message' => 'Akun tidak ditemukan']);
}

}
 