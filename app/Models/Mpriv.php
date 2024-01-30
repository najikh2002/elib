<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mpriv extends Model
{
    use HasFactory;

    protected $table = 'mpriv';
    protected $primaryKey = 'kodepriv';
    public $timestamps = false;

    protected $fillable = [
        'kodepriv',
        'namapriv',
    ];
}
