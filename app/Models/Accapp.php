<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accapp extends Model
{
    protected $table = 'accapp';
    protected $primaryKey = 'useracc';
    public $timestamps = false;

    protected $fillable = [
        'useracc',
        'userpass',
        'lastlogin',
        'date_create',
        'kodepriv',
    ];

    public function mpriv()
    {
        return $this->belongsTo(Mpriv::class, 'kodepriv');
    }

    public function anggota()
    {
        return $this->hasMany(Anggota::class,'useracc', 'useracc');
    }
}
