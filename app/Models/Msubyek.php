<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Msubyek extends Model
{
    protected $table = 'msubyek';
    protected $primaryKey = 'kodesubyek';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kodesubyek',
        'namasubyek'
    ];

}
