<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    protected $table = 'jam';
    protected $fillable = ['jam_masuk', 'jam_keluar', 'hari'];

    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_jam');
    }
}
