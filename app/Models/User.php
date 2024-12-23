<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    // Model User.php

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table= 'users';
    protected $primarykey = 'id';
    protected $fillable = [
        'nomer_induk', // atau sesuaikan jika ada perubahan nama
        'nama',
        'email', // gunakan 'email' agar sesuai dengan Laravel Auth
        'password',
        'tanggal_lahir',
        'role',
    ];
    
    public function pengajar()
{
    return $this->hasOne(Pengajar::class, 'id_user'); // Relasi satu ke satu
}
public function siswa()
{
    return $this->hasOne(Siswa::class, 'id_user'); // Relasi satu ke satu dengan model Siswa
}

 
    public function pengajars()
    {
        return $this->hasMany(Pengajar::class, 'id_user');
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
