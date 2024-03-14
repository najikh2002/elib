<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembaca extends Model
{
    use HasFactory;

    protected $table = 'pembaca';
    protected $primaryKey = 'idbaca';
    protected $keyType = 'integer';
    public $incrementing = true;

    protected $fillable = ['kodebuku', 'kodeanggota', 'tglbaca', 'idbaca'];
}
