<?php

namespace Database\Seeders;

use App\Models\TenagaAhli;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TenagaAhliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        TenagaAhli::create([
            'id' => 1, // ID untuk tenaga ahli pertama
            'id_user' => 4, // ID pengguna tenaga ahli pertama
            'nomor_str' => 'STR12345',
            'spesialisasi' => 'Psikologi',
            'jadwal_aktif' => 'Senin-Jumat, 08:00-17:00',
            'lokasi_praktik' => 'Klinik Psikologi ABC',
            'biaya_konsultasi' => 500000,
            'tabungan' => 0.00,
        ]);
        
        TenagaAhli::factory()->count(15)->create(); // Menggunakan factory untuk Tenaga Ahli
    }
}
