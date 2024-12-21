<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenarikanSaldo extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'penarikan_saldo';

    // Kolom-kolom yang dapat diisi secara massal
    protected $fillable = [
        'id_user',
        'status',
        'jumlah_penarikan',
        'provider',
        'nomor_tujuan',
        'bukti_buku_tabungan',
        'pesan_penarikan',
        'bukti_transfer',
        'approved_at',
    ];

    protected function casts(): array{
        return [
            'approved_at' => 'datetime',
            'started_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
