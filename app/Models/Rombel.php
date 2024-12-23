<?php
// app/Models/Rombel.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rombel extends Model
{
    protected $table = 'rombel'; // Nama tabel yang sesuai di database
    protected $fillable = [ 'kelas'];
    public $timestamps = false; // Menonaktifkan timestamps otomatis
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_rombel');
    }
    // Relasi ke model Siswa (One to Many atau sesuai kebutuhan)
    public function siswa()
    {
        
        return $this->hasMany(Siswa::class, 'id_rombel','id');
    }
    public function rombel()
{
    return $this->belongsTo(Rombel::class, 'id_rombel');
}
}
