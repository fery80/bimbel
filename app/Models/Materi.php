<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materi'; // Nama tabel
    protected $primaryKey = 'id'; // Primary key

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'id_jadwal',
        'file_path',
        'tipe_file',
    ];

    // Relasi ke model Jadwal
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id');
    }
}
