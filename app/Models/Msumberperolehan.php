<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Msumberperolehan extends Model
{
    protected $table = 'msumberperolehan';
    protected $primaryKey = 'kodesumberperolehan';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kodesumberperolehan',
        'namasumberperolehan'
    ];

}
