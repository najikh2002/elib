<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'idpinjam';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = false;

    protected $fillable = [
        'idpinjam',
        'kodebuku',
        'kodeanggota',
        'tglpinjam',
        'tglkembali'
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'kodebuku', 'kodebuku');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'kodeanggota', 'kodeanggota');
    }
}
