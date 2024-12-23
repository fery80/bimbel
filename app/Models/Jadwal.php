<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $table = 'jadwal';
    protected $fillable = ['id_mapel', 'id_tingkatan', 'id_pengajar', 'id_ruangan', 'id_jam', 'id_rombel', 'Tanggal','waktu_mulai_absen',
        'waktu_selesai_absen',
        'kode_absensi',
];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'id_mapel');
    }

    public function tingkatan()
    {
        return $this->belongsTo(Tingkatan::class, 'id_tingkatan');
    }
    public function rombel()
    {
        return $this->belongsTo(Rombel::class, 'id_rombel');
    }

    public function pengajar()
    {
        return $this->belongsTo(Pengajar::class, 'id_pengajar');
    }
    public function pengajars()
    {
        return $this->belongsTo(Pengajar::class, 'id_pengajar');
    }

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruangan');
    }

    public function jam()
    {
        return $this->belongsTo(Jam::class, 'id_jam');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_rombel');
    }
    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_jadwal', 'id');
    }
    public function materi()
    {
        return $this->hasMany(Materi::class, 'id_jadwal', 'id');
    }
}
