<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mjenisbuku extends Model
{
    use HasFactory;

    protected $table = 'mjenisbuku';
    protected $primaryKey = 'kodejenisbuku';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = ['kodejenisbuku','namajenisbuku'];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'kodejenisbuku', 'kodejenisbuku');
    }
}
