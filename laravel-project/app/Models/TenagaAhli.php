<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenagaAhli extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang digunakan oleh model ini
    protected $table = 'tenaga_ahli';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'nomor_str',
        'spesialisasi',
        'jadwal_aktif',
        'lokasi_praktik',
        'biaya_konsultasi',
        'tabungan',
        'is_available'
    ];

    /**
     * Define relationship to the User model.
     * Setiap tenaga ahli berhubungan dengan satu pengguna (User).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Define relationship to the RiwayatPendidikanTenagaAhli model.
     * Setiap tenaga ahli berhubungan dengan banyak riwayat pendidikan (RiwayatPendidikanTenagaAhli).
     */
    public function riwayatPendidikan()
    {
        return $this->hasMany(RiwayatPendidikanTenagaAhli::class, 'id_tenaga_ahli');
    }
    
    public function konsultasi()
    {
        return $this->hasMany(Konsultasi::class, 'id_pasien');
    }
    /**
     * Casting attributes to native types.
     * Menentukan tipe data yang dikonversi saat diakses.
     */
    protected $casts = [
        'biaya_konsultasi' => 'decimal:2',
        'tabungan' => 'decimal:2',
    ];

    public $timestamps = false;
}
