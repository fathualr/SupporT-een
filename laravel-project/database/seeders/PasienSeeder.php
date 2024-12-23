<?php

namespace Database\Seeders;

use App\Models\Pasien;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PasienSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Pasien::create([
            'id' => 1,
            'id_user' => 5,
            'deskripsi_diri' => 'Saya adalah seseorang dengan keluhan kecemasan tinggi.',
        ]);

        Pasien::create([
            'id' => 2,
            'id_user' => 6,
            'deskripsi_diri' => 'Saya sedang mengalami hal-hal berat.',
        ]);
    }
}
