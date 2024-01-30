<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    protected $table = 'programstudi';
    protected $primaryKey = 'kodeps';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'kodeps',
        'kodefakultas',
        'namaps',
        'aktifanggota'
    ];

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class, 'kodefakultas');
    }

    public function bukuprogramstudi()
    {
        return $this->hasMany(BukuProgramstudi::class, 'kodeps', 'kodeps');
    }

    public function bukupengarang()
    {
        return $this->hasMany(BukuPengarang::class, 'kodeps', 'kodeps');
    }
}
