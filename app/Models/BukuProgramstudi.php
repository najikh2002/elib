<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BukuProgramstudi extends Model
{
    protected $table = 'bukuprogramstudi';
    protected $primaryKey = ['kodeps', 'kodebuku'];
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kodebuku',
        'kodeps',
    ];

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'kodebuku');
    }

    public function programstudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'kodeps');
    }
}
