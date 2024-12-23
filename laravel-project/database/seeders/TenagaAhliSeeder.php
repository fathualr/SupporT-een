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
            'id' => 1,
            'id_user' => 3,
            'nomor_str' => 'STR12345',
            'spesialisasi' => 'Psikologi',
            'jadwal_aktif' => 'Senin-Jumat, 08:00-17:00',
            'lokasi_praktik' => 'Klinik Psikologi ABC',
            'biaya_konsultasi' => 100000,
            'tabungan' => 0.00,
        ]);

        TenagaAhli::create([
            'id' => 2,
            'id_user' => 4,
            'nomor_str' => 'STR12346',
            'spesialisasi' => 'Psikiater',
            'jadwal_aktif' => 'Senin-Jumat, 18:00-20:00',
            'lokasi_praktik' => 'Klinik Psikologi DEF',
            'biaya_konsultasi' => 150000,
            'tabungan' => 0.00,
        ]);
    }
}
