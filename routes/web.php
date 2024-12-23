<?php


use App\Http\Controllers\login;
use App\Http\Controllers\jadwall;
use App\Http\Controllers\siswaa;
use App\Http\Controllers\pengajarr;
use App\Http\Controllers\admin;
use App\Http\Controllers\absensisiswa;
use App\Http\Controllers\absensipengajar;
use Illuminate\Support\Facades\Route;

//login
Route::get('/', [login::class, 'tampillogin'])->name('login.tampil');
Route::post('/login/submit', [login::class, 'submitlogin'])->name('login.submit');
Route::post('/logout', [login::class, 'logout'])->name('logout');

// adwmon
Route::prefix('admin')->group(function () {
    // daftar akun
    Route::get('/daftarakun', [admin::class, 'daftarakun'])->name('daftarakun');
    Route::post('/siswa/tambah', [admin::class, 'tambah'])->name('siswa.tambah');
    Route::get('/search-users', [admin::class, 'searchUsers']);
    Route::post('/siswa/update/{id_user}', [admin::class, 'updateRombelTingkatan'])->name('update.rombel.tingkatan');
    Route::put('/user/{id}', [admin::class, 'update'])->name('user.update');
    Route::DELETE('/delete-user/{id}', [admin::class, 'hapusdatauser'])->name('user.delete');
    Route::delete('/ssiswa/{id_user}', [admin::class, 'destroy']);



        Route::get('/users', [admin::class, 'daftarakun'])->name('user.index');
        Route::get('/registrasiadmin', [admin::class, 'registrasiadmin'])->name('registrasiadmin');
        Route::post('/registrasi/submit', [admin::class, 'submitRegistrasi'])->name('Registrasi.submit');
    Route::get('/homeadmin', [admin::class, 'homeadmin'])->name('homeadmin');
    Route::get('/akun', [admin::class, 'akun'])->name('akun.admin');
    
    







    // // navbar daftar admin  
    // Route::get('/daftarakunadmin', [admin::class, 'daftarakun'])->name('daftarakunadmin');
    // Route::post('/siswa/store', [admin::class, 'create'])->name('siswa.create');
    // Route::put('/breakdown/{id}', [admin::class, 'updateBreakdown'])->name('breakdown.update');
    // Route::get('/users', [admin::class, 'daftarakun'])->name('user.index');
    // Route::put('/users/{id}', [admin::class, 'update'])->name('user.update');
    // Route::get('/search-users', [admin::class, 'searchUsers']);
    // Route::delete('/user/{id}', [admin::class, 'hapusdatauser'])->name('hapusdatauser');
    // Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');


    //navbar home admin
    //navbar registrasi admin 
    //navbar jadwal admin 
    Route::get('/jadwal', [jadwall::class, 'showJadwal']);
    Route::get('/jadwal', [jadwall::class, 'jadwal'])->name('jadwal');
    Route::post('/jadwal/create', [jadwall::class, 'jadwalcreate'])->name('jadwal.create');
    Route::get('/jadwal/{id}/edit', [Jadwall::class, 'edit'])->name('jadwal.edit');
    Route::post('/jadwal/{id}/edit', [Jadwall::class, 'edit'])->name('jadwal.edit');
    Route::get('/rombel/{id}/edit', [Jadwall::class, 'rombeledit'])->name('rombel.edit');
    Route::put('/rombel/{id}', [jadwall::class, 'rombelupdate'])->name('rombel.update');
    Route::delete('/rombel/delete/{id}', [jadwall::class, 'rombeldelete']);
    
     

    Route::put('/jadwal/{id}', [jadwall::class, 'jadwalupdate']);
    Route::put('/jadwal/{id}', [jadwall::class, 'jadwalupdate'])->name('jadwal.update');


    Route::post('/jadwal/update/{id}', [jadwall::class, 'jadwalupdate'])->name('jadwal.update');
    Route::delete('/jadwal/delete/{id}', [jadwall::class, 'jadwaldelete']);

    Route::post('/mapel/create', [jadwall::class, 'mplcreate'])->name('mapel.create');
    Route::post('/ruangan/create', [jadwall::class, 'rngcreate'])->name('ruangan.create');
    Route::post('/jam/create', [jadwall::class, 'jamcreate'])->name('jam.create');
    Route::post('/rombelQWq/create', [jadwall::class, 'rombelcreate'])->name('rombel.create');

    Route::post('/tingkatan/create', [jadwall::class, 'tingkatancreate'])->name('tingkatan.create');
     
 

});
// Route::put('/admin/user/{id}/update-tingkatan-rombel', [admin::class, 'updateTingkatanRombel'])->name('user.updateTingkatanRombel');
Route::middleware(['auth', 'siswaq'])->group(function() {
Route::get('siswa/', [siswaa::class, 'halamansiswa'])->name('siswa');
});
Route::prefix('siswa')->middleware('siswaq')->group(function () {
    Route::get('/jadwal', [siswaa::class, 'jadwalsiswa'])->name('jadwal.siswa');
    Route::get('/akun', [siswaa::class, 'akun'])->name('akun.siswa');
    Route::get('/materi/{id}', [siswaa::class, 'getMateriByJadwal'])->name('siswa.materi');
    Route::post('/logout', [siswaa::class, 'logout'])->name('logout');
});

    Route::prefix('pengajar')->group(function () {
        Route::get('/', [pengajarr::class, 'halamanpengajar'])->name('halaman-pengajar');
        Route::get('/info', [login::class, 'userInfo'])->name('user.info');
        Route::get('/jadwal', [pengajarr::class, 'jadwalpengajar'])->name('jadwal.pengajar');
        Route::post('/materi', [jadwall::class, 'store'])->name('materi.store');
    });
    Route::get('/materi/download/{id}', [siswaa::class, 'downloadMateri'])->name('materi.download');


 // Routes
// File: routes/web.php

Route::put('/mapels/{id}', [jadwall::class, 'mapelsupdate'])->name('mapel.update');
Route::delete('/mapels/delete/{id}', [jadwall::class, 'mapelsdestroy'])->name('mapel.destroy');

Route::get('/mapels/{id}/edit', [jadwall::class, 'mapeledit'])->name('mapels.edit'); // Untuk fetch data mapel

// Route untuk edit ruangan
Route::get('/ruangans/{id}/edit', [jadwall::class, 'ruanganedit'])->name('ruangan.edit');

// Route untuk update ruangan
Route::put('/ruangans/{id}', [jadwall::class, 'ruanganupdate'])->name('ruangan.update');

// Route untuk delete ruangan
Route::delete('/ruangans/delete/{id}', [jadwall::class, 'ruangandestroy'])->name('ruangan.destroy');

// Route untuk Edit Tingkatan
Route::get('/tingkatans/{id}/edit', [jadwall::class, 'tingkatanedit']);
Route::put('/tingkatans/{id}', [jadwall::class, 'tingkatanupdate']);

// Route untuk Delete Tingkatan
Route::delete('/tingkatans/delete/{id}', [jadwall::class, 'tingkatandestroy']);
// Route untuk edit tingkatan


// Route untuk edit jam
Route::get('/jams/{id}/edit', [jadwall::class, 'jamedit'])->name('jam.edit');

// Route untuk update jam
Route::put('/jams/{id}', [jadwall::class, 'jamupdate'])->name('jam.update');

// Route untuk delete jam
Route::delete('/jams/delete/{id}', [jadwall::class, 'jamdestroy'])->name('jam.destroy');
Route::post('/mulai-absen/{id}', [absensipengajar::class, 'store'])->name('absen.store');
Route::post('/update-waktu-selesei-absen/{id}', [absensipengajar::class, 'updateWaktuSeleseiAbsen'])->name('selesaiabsen');
Route::get('/get-absensi/{id}', [absensipengajar::class, 'getAbsensi']);








Route::post('/siswa/absen/{id}', [absensisiswa::class, 'store'])->name('siswa.absen');
