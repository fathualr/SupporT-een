<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika berbeda dari penamaan konvensional
    protected $table = 'konsultasi';

    // Kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'id_tenaga_ahli',
        'id_pasien',
        'pesan_tenaga_ahli',
        'status',
        'started_at',
        'ends_at',
    ];

    protected $casts = [
        'started_at' => 'datetime',
        'ends_at' => 'datetime',
    ];

    // Relasi dengan model TenagaAhli
    public function tenagaAhli()
    {
        return $this->belongsTo(TenagaAhli::class, 'id_tenaga_ahli');
    }

    // Relasi dengan model Pasien
    public function pasien()
    {
        return $this->belongsTo(Pasien::class, 'id_pasien');
    }

    // Relasi ke model TransaksiKonsultasi
    public function transaksiKonsultasi()
    {
        return $this->hasOne(TransaksiKonsultasi::class, 'id_konsultasi');
    }

    // Relasi ke model PesanKonsultasi
    public function pesanKonsultasi()
    {
        return $this->hasOne(PesanKonsultasi::class, 'id_konsultasi');
    }
}
