<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'gambar', 'email', 'password', 'role', 'address', 'kelurahan', 'kabupaten', 'kecamatan', 'provinsi', 'kode_pos', 'telepon', 'pekerjaan', 'tanggal_lahir'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $table = 'users';

    public function isAdmin()
{
    return $this->role === 'admin'; // Gantilah dengan logika yang sesuai dengan struktur peran Anda
}
public function hasRole($role)
{
    return $this->role === $role;
}

public function isNotAdmin()
{
    return !$this->hasRole('admin');
}
}
