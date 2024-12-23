<?php

// app/Models/Pengajar.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    protected $table = 'pengajar';
    protected $fillable = ['id_user'];
 
    
        protected $primaryKey = 'id_pengajar';  // Atur nama kolom primary key jika bukan 'id'
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_pengajar');
    }

public function pengajar()
{
    return $this->hasOne(Pengajar::class, 'id_user'); // Relasi satu ke satu
}
// app/Models/Pengajar.php
public function jadwals()
{
    return $this->hasMany(Jadwal::class, 'id_pengajar'); // Relasi satu ke banyak (one-to-many)
}

}
