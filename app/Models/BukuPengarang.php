<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuPengarang extends Model
{
    protected $table = 'bukupengarang';
    protected $primaryKey = ['kodepengarang', 'kodebuku'];
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kodepengarang',
        'kodebuku',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'kodebuku');
    }

    public function pengarang()
    {
        return $this->belongsTo(Mpengarang::class, 'kodepengarang');
    }
}
