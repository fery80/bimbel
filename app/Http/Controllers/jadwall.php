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
use App\Models\Absensi;
use App\Models\Materi;
use Illuminate\Http\Request;

class jadwall extends Controller
{
    
public function jadwal() {
      // Mengambil data untuk ditampilkan pada view
      $mapels = Mapel::all();
      $tingkatans = Tingkatan::all();
      $pengajars = Pengajar::all();
      $ruangans = Ruangan::all();
      $jams = Jam::all();
      $rombels = Rombel::all();
      $Absensi = Absensi::all();

      // Ambil data jadwal beserta relasi yang diperlukan
      $jadwals = Jadwal::with(['mapel', 'tingkatan', 'pengajar', 'ruangan', 'jam', 'rombel', ])->get();

      return view('admin.tampilan-jadwal', compact(
          'mapels', 'tingkatans', 'pengajars', 'ruangans', 'jams', 'rombels', 'jadwals', 'Absensi'
      ));

}
 
public function jadwalcreate(Request $request)
{$request->validate([
    'id_mapel' => 'required|exists:mapel,id_mapel',
    'id_tingkatan' => 'required|exists:tingkatan,id',
    'id_pengajar' => 'required|exists:pengajar,id_pengajar',
    'id_ruangan' => 'required|exists:ruangan,id',
    'id_jam' => 'required|exists:jam,id',
    'id_rombel' => 'required|exists:rombel,id',
    'Tanggal' => 'required|date',  // Validasi tanggal (harus ada dan valid)
]);

// Cek tabrakan jadwal untuk pengajar
$isConflict = Jadwal::where('id_pengajar', $request->id_pengajar)
    ->where('id_jam', $request->id_jam)
    ->where('Tanggal', $request->Tanggal) // Pastikan tanggal juga diperiksa
    ->exists();

if ($isConflict) {
    return redirect()->back()->withErrors('Jadwal bentrok: Pengajar sudah memiliki jadwal pada waktu tersebut.');
}

// Cek tabrakan jadwal untuk ruangan
$isRoomConflict = Jadwal::where('id_ruangan', $request->id_ruangan)
    ->where('id_jam', $request->id_jam)
    ->where('Tanggal', $request->Tanggal) // Pastikan tanggal juga diperiksa
    ->exists();

if ($isRoomConflict) {
    return redirect()->back()->withErrors('Jadwal bentrok: Ruangan sudah digunakan pada waktu tersebut.');
}

// Simpan jadwal jika tidak ada tabrakan
Jadwal::create([
    'id_mapel' => $request->id_mapel,
    'id_tingkatan' => $request->id_tingkatan,
    'id_pengajar' => $request->id_pengajar,
    'id_ruangan' => $request->id_ruangan,
    'id_jam' => $request->id_jam,
    'id_rombel' => $request->id_rombel,
    'Tanggal' => $request->Tanggal,  // Pastikan tanggal ada di input
]);

return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan.');
}

private function cekKonflik($id_jam, $id_pengajar = null, $id_ruangan = null, $id_rombel = null, $excludeId = null) {
    $query = Jadwal::where('id_jam', $id_jam);
    
    if ($id_pengajar) {
        $query->where('id_pengajar', $id_pengajar);
    }
    if ($id_ruangan) {
        $query->where('id_ruangan', $id_ruangan);
    }
    if ($id_rombel) {
        $query->where('id_rombel', $id_rombel);
    }
    if ($excludeId) {
        $query->where('id', '!=', $excludeId);
    }
    
    return $query->exists();
}
 // Update Jadwal
 public function jadwalupdate(Request $request, $id)
{
    // Validasi data yang diterima dari frontend
    $validated = $request->validate([
        'id_mapel' => 'required|exists:mapel,id_mapel',
        'id_tingkatan' => 'required|exists:tingkatan,id',
        'id_pengajar' => 'required|exists:pengajar,id_pengajar',
        'id_ruangan' => 'required|exists:ruangan,id',
        'id_jam' => 'required|exists:jam,id',
        'id_rombel' => 'required|exists:rombel,id',
        'Tanggal' => 'required|date', // Validasi Tanggal
    ]);

    // Mencari jadwal berdasarkan ID
    $jadwal = Jadwal::findOrFail($id);

    // Validasi jadwal bentrok
    $jadwalBentrok = Jadwal::where('id_tingkatan', $validated['id_tingkatan'])
        ->where('id_ruangan', $validated['id_ruangan'])
        ->where('id_jam', $validated['id_jam'])
        ->where('Tanggal', $validated['Tanggal']) // Tambahkan validasi Tanggal
        ->where('id', '!=', $id) // Pastikan yang dibandingkan bukan jadwal yang sama
        ->exists();

    if ($jadwalBentrok) {
        return response()->json([
            'error' => 'Jadwal bentrok dengan jadwal lain pada ruangan, jam, dan Tanggal yang sama'
        ], 400);
    }

    // Mengupdate data jadwal
    $jadwal->update($validated);

    // Mengembalikan response JSON
    return response()->json(['success' => 'Jadwal berhasil diperbarui']);
}

 public function edit($id)
 {
     $jadwal = Jadwal::with(['mapel', 'pengajar', 'ruangan', 'jam', 'rombel', 'Tingkatan'])->find($id);
     if (!$jadwal) {
         return response()->json(['error' => 'Jadwal tidak ditemukan'], 404);
     }
 
     return response()->json([
         'id' => $jadwal->id,
         'id_mapel' => $jadwal->id_mapel,
         'id_pengajar' => $jadwal->id_pengajar,
         'id_ruangan' => $jadwal->id_ruangan,
         'id_jam' => $jadwal->id_jam,
         'id_rombel' => $jadwal->id_rombel,
         'id_tingkatan' => $jadwal->id_tingkatan,
         'Tanggal' => $jadwal->Tanggal,
     ]);
 }
 
 public function jadwaldelete($id)
 {
     // Mencari jadwal berdasarkan ID
     $jadwal = Jadwal::find($id);

     if (!$jadwal) {
         return response()->json(['error' => 'Jadwal tidak ditemukan'], 404);
     }

     // Menghapus jadwal
     $jadwal->delete();

     // Mengembalikan response JSON
     return response()->json(['success' => 'Jadwal berhasil dihapus']);
 }

 
// Halaman rombel

public function rombelcreate(Request $request)
{
    // Validasi input untuk kolom kelas
    $request->validate([
        'kelas' => 'required|unique:rombel,kelas',
    ], [
        'kelas.unique' => 'Kelas dengan nama tersebut sudah ada, silakan coba nama yang lain.'
    ]);

    // Menyimpan data ke dalam tabel rombel dengan mengubah kelas menjadi huruf kecil
    Rombel::create([
        'kelas' => strtolower($request->kelas), // Mengubah input menjadi huruf kecil
    ]);

    // Redirect setelah berhasil menambah data
    return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan.');
}

public function rombeledit($id)
{
    $rombel = Rombel::findOrFail($id);

    return response()->json([
        'id' => $rombel->id,
        'kelas' => $rombel->kelas,
    ]);
}

// Memperbarui data rombel
public function rombelupdate(Request $request, $id)
{
    // Validasi input untuk kolom kelas
    $request->validate([
        'kelas' => 'required|string|max:255|unique:rombel,kelas,' . $id,
    ], [
        'kelas.unique' => 'Kelas dengan nama tersebut sudah ada, silakan coba nama yang lain.'
    ]);

    // Cari dan perbarui data rombel
    $rombel = Rombel::findOrFail($id);
    $rombel->update([
        'kelas' => strtolower($request->kelas), // Mengubah input menjadi huruf kecil
    ]);

    return redirect()->back()->with('success', 'Rombel berhasil diperbarui.');
}

// Menghapus data rombel
public function rombeldestroy($id)
{
    $rombel = Rombel::findOrFail($id);
    $rombel->delete();

    return response()->json(['message' => 'Rombel berhasil dihapus.']);
}

// halaman mapel
public function mapeledit($id)
{
    $mapel = Mapel::findOrFail($id);

    return response()->json([
        'id' => $mapel->id_mapel,
        'nama_mapel' => $mapel->nama_mapel,
    ]);
}

public function mplcreate(Request $request)
{
    // Validasi inputan
    $request->validate([
        'nama_mapel' => 'required|unique:mapel,nama_mapel', // Validasi nama_mapel unik
    ], [
        'nama_mapel.unique' => 'Mapel dengan nama tersebut sudah ada, silakan coba nama yang lain.'
    ]);

    // Menyimpan data setelah validasi
    Mapel::create([
        'nama_mapel' => strtolower($request->nama_mapel), // Mengubah input menjadi huruf kecil
    ]);

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Mapel berhasil ditambahkan.');
}

public function mapelsupdate(Request $request, $id)
{
    $request->validate([
        'nama_mapel' => 'required|string|max:255|unique:mapel,nama_mapel,' . $id, // Validasi unik untuk selain ID ini
    ], [
        'nama_mapel.unique' => 'Mapel dengan nama tersebut sudah ada, silakan coba nama yang lain.'
    ]);

    $mapel = Mapel::findOrFail($id);
    $mapel->update([
        'nama_mapel' => strtolower($request->nama_mapel), // Mengubah input menjadi huruf kecil
    ]);

    return redirect()->back()->with('success', 'Mapel berhasil diperbarui.');
}

public function mapelsdestroy($id)
{
    $mapel = Mapel::findOrFail($id);
    $mapel->delete();

    return response()->json(['success' => 'Mapel berhasil dihapus']);
}

//halamn tingkatan
   
public function tingkatancreate(Request $request)
{
    // Validasi input untuk kolom tingkatan
    $request->validate([
        'tingkatan' => 'required|unique:tingkatan,tingkatan', // Pastikan nama input adalah 'tingkatan'
    ], [
        'tingkatan.unique' => 'Tingkatan dengan nama tersebut sudah ada, silakan coba nama yang lain.'
    ]);

    // Menyimpan data ke dalam tabel tingkatan dengan mengubah tingkatan menjadi huruf kecil
    Tingkatan::create([
        'tingkatan' => strtolower($request->tingkatan), // Mengubah input menjadi huruf kecil
    ]);

    // Redirect setelah berhasil menambah data
    return redirect()->back()->with('success', 'Tingkatan berhasil ditambahkan.');
}

public function tingkatanedit($id)
{
    $tingkatan = Tingkatan::findOrFail($id);
    return response()->json($tingkatan); // Mengembalikan data untuk diisi di form
}

// Mengupdate data tingkatan
public function tingkatanupdate(Request $request, $id)
{
    // Validasi input untuk memastikan tingkatan unik
    $request->validate([
        'tingkatan' => 'required|unique:tingkatan,tingkatan,' . $id, // Mengabaikan ID yang sedang diupdate
    ], [
        'tingkatan.unique' => 'Tingkatan dengan nama tersebut sudah ada, silakan coba nama yang lain.'
    ]);

    $tingkatan = Tingkatan::findOrFail($id);
    $tingkatan->tingkatan = strtolower($request->input('tingkatan')); // Simpan dalam huruf kecil
    $tingkatan->save();

    return redirect()->back()->with('success', 'Tingkatan berhasil diperbarui.');
}

// Menghapus tingkatan
public function tingkatandestroy($id)
{
    $tingkatan = Tingkatan::findOrFail($id);
    $tingkatan->delete();

    return response()->json(['success' => 'Tingkatan berhasil dihapus.']);
}


    //halamn ruangan

    
public function rngcreate(Request $request)
{
    // Validasi inputan
    $request->validate([
        'nama_ruangan' => 'required|unique:ruangan,nama_ruangan', // Validasi nama_ruangan unik
    ], [
        'nama_ruangan.unique' => 'Ruangan dengan nama tersebut sudah ada, silakan coba nama yang lain.'
    ]);

    // Menyimpan data setelah validasi dengan mengubah nama_ruangan menjadi huruf kecil
    Ruangan::create([
        'nama_ruangan' => strtolower($request->nama_ruangan), // Mengubah input menjadi huruf kecil
    ]);

    // Redirect kembali dengan pesan sukses
    return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan.');
}

public function ruanganedit($id)
{
    $ruangan = Ruangan::findOrFail($id);
    return response()->json($ruangan);
}

// Method untuk memperbarui data ruangan
public function ruanganupdate(Request $request, $id)
{
    // Validasi input untuk memastikan nama_ruangan unik
    $request->validate([
        'nama_ruangan' => 'required|unique:ruangan,nama_ruangan,' . $id, // Mengabaikan ID yang sedang diupdate
    ], [
        'nama_ruangan.unique' => 'Ruangan dengan nama tersebut sudah ada, silakan coba nama yang lain.'
    ]);

    $ruangan = Ruangan::findOrFail($id);
    $ruangan->nama_ruangan = strtolower($request->input('nama_ruangan'));
    $ruangan->save();

    return redirect()->back()->with('success', 'Ruangan berhasil diperbarui.');
}

// Method untuk menghapus data ruangan
public function ruangandestroy($id)
{
    $ruangan = Ruangan::findOrFail($id);
    $ruangan->delete();

    return response()->json(['success' => 'Ruangan berhasil dihapus']);
}
    //halaman jam 

    public function jamcreate(Request $request)
    {
        $request->validate([
            'jam_masuk' => 'required|unique:jam,jam_masuk',
            'jam_keluar' => 'required|unique:jam,jam_keluar',
            'hari' => 'required|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
        ]);
    
        Jam::create([
            'jam_masuk' => strtolower($request->jam_masuk),
            'jam_keluar' => strtolower($request->jam_keluar),
            'hari' => strtolower($request->hari),
        ]);
     
        return redirect()->back()->with('success', 'Jadwal berhasil ditambahkan.');
    }
    
    // Menampilkan form edit untuk jam tertentu
    public function jamedit($id)
    {
        $jam = Jam::findOrFail($id); // Mengambil data jam berdasarkan id
        return response()->json($jam); // Mengembalikan data jam dalam format JSON
    }
    
    // Memperbarui data jam
    public function jamupdate(Request $request, $id)
    {
        $jam = Jam::findOrFail($id); // Mengambil data jam berdasarkan id
    
        // Validasi inputan
        $validatedData = $request->validate([
            'jam_masuk' => 'nullable|string|unique:jam,jam_masuk,' . $id,
            'jam_keluar' => 'nullable|string|unique:jam,jam_keluar,' . $id,
            'hari' => 'nullable|string|in:senin,selasa,rabu,kamis,jumat,sabtu,minggu',
        ]);
    
        // Update data jam, hanya yang diubah
        if ($request->has('jam_masuk')) {
            $jam->jam_masuk = strtolower($validatedData['jam_masuk']);
        }
        if ($request->has('jam_keluar')) {
            $jam->jam_keluar = strtolower($validatedData['jam_keluar']);
        }
        if ($request->has('hari')) {
            $jam->hari = strtolower($validatedData['hari']);
        }
    
        $jam->save(); // Simpan perubahan
    
        return redirect()->back()->with('success', 'Jam updated successfully');
    }
    
    // Menghapus data jam
    public function jamdestroy($id)
    {
        $jam = Jam::findOrFail($id); // Mengambil data jam berdasarkan id
        $jam->delete(); // Menghapus data jam
    
        return response()->json(['success' => true]); // Mengembalikan response success
    }
    public function store(Request $request)
{
    $request->validate([
        'id_jadwal' => 'required|exists:jadwal,id',
        'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx|max:2048',
    ]);

    // Tentukan nama file secara otomatis
    $originalExtension = $request->file('file')->getClientOriginalExtension();
    $customFileName = 'materi_' . time() . '.' . $originalExtension; // Nama file: materi_1692593875.pdf

    // Simpan file ke folder 'materi' di disk publik
    $filePath = $request->file('file')->storeAs('materi', $customFileName, 'public');

    // Simpan informasi file ke database
    Materi::create([
        'id_jadwal' => $request->id_jadwal,
        'file_path' => $filePath,
    ]);

    return back()->with('success', 'Materi berhasil diunggah.');
}

}
 