<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Bus;

class Mpengarang extends Model
{
    protected $table = 'mpengarang';
    protected $primaryKey = 'kodepengarang';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kodepengarang',
        'namapengarang',
        'tempatlhr',
        'tanggallhr'
    ];

    public function buku(){
        return $this->hasMany(Buku::class,'kodepengarang','kodepengarang');
    }

    public function bukupengarang()
    {
        return $this->hasMany(BukuPengarang::class, 'kodepengarang', 'kodepengarang');
    }
}
