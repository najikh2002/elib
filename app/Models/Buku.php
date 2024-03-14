<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $primaryKey = 'kodebuku';
    public $timestamps = false;

    protected $fillable = [
        'kodebuku',
        'kodesumberperolehan',
        'kodepengarang',
        'kodepenerbit',
        'kodejenisbuku',
        'kodesubyek',
        'judulbuku',
        'tahun',
        'jumlahhalaman',
        'jumlahexemplar',
        'kodebahasa',
        'active',
        'isbn',
        'sinopsis',
        'edisi',
        'filebuku',
        'sampulbuku',
    ];

    public function jenisbuku()
    {
        return $this->belongsTo(Mjenisbuku::class, 'kodejenisbuku');
    }

    public function penerbit()
    {
        return $this->belongsTo(Mpenerbit::class, 'kodepenerbit');
    }

    public function pengarang()
    {
        return $this->belongsTo(Mpengarang::class, 'kodepengarang');
    }

    public function subyek()
    {
        return $this->belongsTo(Msubyek::class, 'kodesubyek');
    }

    public function sumberPerolehan()
    {
        return $this->belongsTo(Msumberperolehan::class, 'kodesumberperolehan');
    }

    public function bahasa()
    {
        return $this->belongsTo(Mbahasa::class, 'kodebahasa');
    }

    public function bukupengarang()
    {
        return $this->hasMany(BukuPengarang::class, 'kodebuku', 'kodebuku');
    }

    public function bukuprogramstudi()
    {
        return $this->hasMany(BukuProgramstudi::class, 'kodebuku', 'kodebuku');
    }

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'kodebuku', 'kodebuku');
    }

    public function total_baca()
    {
        return $this->hasMany(TotalBaca::class, 'kodebuku', 'kodebuku');
    }
}

