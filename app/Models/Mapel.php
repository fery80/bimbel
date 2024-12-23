<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table = 'mapel';
    protected $fillable = ['nama_mapel'];
    protected $primaryKey = 'id_mapel'; 
    public function tingkatan()
{
    return $this->belongsTo(Tingkatan::class, 'id_tingkatan');
}   
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id_mapel');
    }
    public function pengajar()
    {
        return $this->belongsTo(User::class, 'id_pengajar');
    }
}
