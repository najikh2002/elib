<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalBaca extends Model
{
    protected $table = 'total_baca';
    public $timestamps = false;

    protected $fillable = ['tanggal', 'kodebuku', 'kodeanggota'];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'kodebuku', 'kodebuku');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'kodeanggota', 'kodeanggota');
    }
}
