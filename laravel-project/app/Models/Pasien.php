<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pasien extends Model
{
    use HasFactory;

    // Tentukan tabel yang digunakan oleh model ini
    protected $table = 'pasien';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_user',
        'deskripsi_diri',
    ];

    public function getNonPremiumLimit()
    {
        // Periksa apakah pengguna memiliki status premium
        if ($this->user->isPremium()) {
            return null; // Tidak ada batasan untuk pengguna premium
        }

        // Hitung jumlah pesan dalam 5 jam terakhir
        $fiveHoursAgo = Carbon::now()->subHours(5);

        return $this->chatbotLogs()
            ->where('sent_at', '>=', $fiveHoursAgo)
            ->count();
    }

    /**
     * Define relationship to the User model.
     * Setiap pasien berhubungan dengan satu pengguna (User).
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    
    public function aktivitasPribadi()
    {
        return $this->hasMany(AktivitasPribadi::class, 'id_pasien');
    }

    public function riwayatAktivitas()
    {
        return $this->hasMany(RiwayatAktivitas::class, 'id_pasien');
    }

    public function percakapanChatbots()
    {
        return $this->hasMany(PercakapanChatbot::class, 'id_pasien');
    }
    
    public function chatbotLogs()
    {
        return $this->hasMany(ChatbotLog::class, 'id_pasien');
    }
    
    public function konsultasi()
    {
        return $this->hasMany(Konsultasi::class, 'id_pasien');
    }
    public $timestamps = false;
}
