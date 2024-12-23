<?php

// app/Models/Tingkatan.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tingkatan extends Model
{
    protected $table = 'tingkatan'; // Nama tabel yang sesuai di database
    
    protected $fillable = ['tingkatan'];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_tingkatan');
    }

    
    // Relasi ke model Siswa (One to Many)
    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'id_tingkatan');
    }
}