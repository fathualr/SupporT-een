<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RiwayatPendidikanTenagaAhliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('riwayat_pendidikan_tenaga_ahli')->insert([
            [
                'id_tenaga_ahli' => 1,
                'keterangan' => 'Universitas Psikologi Indonesia',
            ],
            [
                'id_tenaga_ahli' => 1,
                'keterangan' => 'Sekolah Tinggi Psikologi',
            ],
            [
                'id_tenaga_ahli' => 2,
                'keterangan' => 'Universitas Psikologi Jepang',
            ],
            [
                'id_tenaga_ahli' => 2,
                'keterangan' => 'Sekolah Psikologi Masa Depan',
            ],
        ]);
    }
}
