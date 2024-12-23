<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    protected $table = 'ruangan';
    protected $fillable = ['nama_ruangan'];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_ruangan');
    }
}
