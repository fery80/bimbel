<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa'; // Nama tabel yang sesuai di database

    // Relasi ke model Rombel (Many to One)
    public function rombel()
{
    return $this->belongsTo(Rombel::class, 'id_rombel', 'id');
}

public function tingkatan()
{
    return $this->belongsTo(Tingkatan::class, 'id_tingkatan', 'id');
}

// Model Siswa
public function jadwals()
{
    return $this->hasMany(Jadwal::class, 'id_rombel', 'id_rombel');
}

public function user()
    {
    return $this->belongsTo(User::class, 'id_user');
    }
    

}
