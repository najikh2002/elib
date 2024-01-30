<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mbahasa extends Model
{
    protected $table = 'mbahasa';
    protected $primaryKey = 'kodebahasa';
    public $timestamps = false;

    protected $fillable = ['kodebahasa','namabahasa'];

    public function buku()
    {
        return $this->hasMany(Buku::class, 'kodebahasa', 'kodebahasa');
    }
}
