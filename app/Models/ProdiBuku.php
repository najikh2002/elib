<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdiBuku extends Model
{
    protected $table = 'r_prodi_buku';

    protected $primaryKey = ['kodeps', 'kodebuku'];
    public $incrementing = false;

    public $timestamps = false;

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'kodebuku');
    }

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'kodeps');
    }
}
