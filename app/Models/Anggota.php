<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class Anggota extends Authenticatable implements AuthenticatableContract
{
    use HasFactory;
    protected $table = 'anggota';
    protected $primaryKey = 'kodeanggota';
    public $timestamps = false;

    protected $fillable = [
        'kodeanggota',
        'nama',
        'institusiasal',
        'kodeangkatan',
        'nova',
        'email',
        'nohp',
        'tempatlahir',
        'tgllahir',
        'status',
        'foto',
        'tglaktif',
        'tglkadaluwarsa',
        'useracc',
        'kodeps'
    ];

    public function getAuthIdentifierName() {
        return 'nama';
    }

    public function getAuthPassword() {
        // Anda harus memiliki kolom password untuk autentikasi
    }

    public function accapp()
    {
        return $this->belongsTo(Accapp::class, 'useracc');
    }

    public function programstudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'kodeps');
    }
}
