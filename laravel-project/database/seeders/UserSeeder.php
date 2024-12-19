<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Membuat 2 admin dengan role berbeda
        User::create([
            'id' => 1, // Menentukan ID
            'role' => 'admin',
            'email' => 'admin1@example.com',
            'password' => Hash::make('123123123'),
            'nama' => 'Admin 1',
            'jenis_kelamin' => 'laki laki',
            'tanggal_lahir' => '1980-01-01',
            'foto_profil' => null,
        ]);

        User::create([
            'id' => 2, // Menentukan ID
            'role' => 'admin',
            'email' => 'admin2@example.com',
            'password' => Hash::make('123123123'),
            'nama' => 'Admin 2',
            'jenis_kelamin' => 'perempuan',
            'tanggal_lahir' => '1985-02-01',
            'foto_profil' => null,
        ]);

        // Membuat 1 pasien
        User::create([
            'id' => 3, // Menentukan ID
            'role' => 'pasien',
            'email' => 'pasien@example.com',
            'password' => Hash::make('123123123'),
            'nama' => 'Pasien A',
            'jenis_kelamin' => 'perempuan',
            'tanggal_lahir' => '1990-01-01',
            'foto_profil' => null,
        ]);

        // Membuat 1 tenaga ahli
        User::create([
            'id' => 4, // Menentukan ID
            'role' => 'tenaga ahli',
            'email' => 'tenaga_ahli@example.com',
            'password' => Hash::make('123123123'),
            'nama' => 'Dr. Tenaga Ahli',
            'jenis_kelamin' => 'laki laki',
            'tanggal_lahir' => '1975-05-01',
            'foto_profil' => null,
        ]);
    }
}
