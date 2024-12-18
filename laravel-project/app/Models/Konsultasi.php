<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Konsultasi extends Model
{
    use HasFactory;
    protected $table = 'konsultasi';
    public $incrementing = false; // Karena menggunakan UUID
    protected $keyType = 'string'; // Tipe data primary key adalah string

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

    // Event untuk membuat UUID secara otomatis saat model dibuat
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->{$model->getKeyName()} = (string) Str::uuid();
        });
    }

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
        return $this->hasMany(PesanKonsultasi::class, 'id_konsultasi');
    }
}
