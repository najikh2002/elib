<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mpenerbit extends Model
{
    protected $table = 'mpenerbit';
    protected $primaryKey = 'kodepenerbit';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kodepenerbit',
        'namapenerbit',
        'alamatpenerbit',
        'kota'
    ];


    public function buku()
    {
        return $this->hasMany(Buku::class,'kodepeberbit','kodepenerbit');
    }
}
