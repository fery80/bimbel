<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';
    protected $fillable = [
        'id_siswa', 'id_jadwal', 'kode_absensi', 'status_absen', 'waktu_absen', 'id_rombel'
    ];
    public function jadwal() {
        return $this->belongsTo(Jadwal::class);
    }
    
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
