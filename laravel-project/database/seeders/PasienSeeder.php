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
        // Menambahkan pasien langsung dengan ID yang sudah ditentukan
        Pasien::create([
            'id' => 1, // ID untuk pasien pertama
            'id_user' => 3, // ID pengguna pasien pertama
            'deskripsi_diri' => 'Saya adalah pasien dengan keluhan kecemasan tinggi.',
        ]);
        
        Pasien::factory()->count(15)->create(); // Menggunakan factory untuk Pasien
    }
}
