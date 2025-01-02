<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivitasPositif extends Model
{
    use HasFactory;

    protected $table = 'aktivitas_positif';

    // Tentukan kolom yang boleh diisi (fillable)
    protected $fillable = ['nama', 'gambar'];

    public function aktivitasPribadi()
    {
        return $this->hasMany(AktivitasPribadi::class, 'id_aktivitas_positif');
    }

    public function riwayatAktivitas()
    {
        return $this->hasMany(RiwayatAktivitas::class, 'id_aktivitas_positif');
    }
    
    public $timestamps = false;
}
