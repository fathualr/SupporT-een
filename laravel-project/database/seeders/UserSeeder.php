<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admins
        User::create([
            'id' => 1,
            'role' => 'admin',
            'email' => 'admin1@example.com',
            'password' => Hash::make('123123123'),
            'nama' => 'Admin 1',
            'jenis_kelamin' => 'laki laki',
            'tanggal_lahir' => '1990-01-01',
            'foto_profil' => null,
            'otp_code' => null,
            'otp_expires_at' => null,
            'email_verified_at' => Carbon::now(),
        ]);

        User::create([
            'id' => 2,
            'role' => 'admin',
            'email' => 'admin2@example.com',
            'password' => Hash::make('123123123'),
            'nama' => 'Admin 2',
            'jenis_kelamin' => 'perempuan',
            'tanggal_lahir' => '1992-02-02',
            'foto_profil' => null,
            'otp_code' => null,
            'otp_expires_at' => null,
            'email_verified_at' => Carbon::now(),
        ]);

        // Tenaga Ahli
        User::create([
            'id' => 3,
            'role' => 'tenaga ahli',
            'email' => 'tenaga_ahli1@example.com',
            'password' => Hash::make('123123123'),
            'nama' => 'Dr. 1',
            'jenis_kelamin' => 'laki laki',
            'tanggal_lahir' => '1985-03-03',
            'foto_profil' => null,
            'otp_code' => null,
            'otp_expires_at' => null,
            'email_verified_at' => Carbon::now(),
        ]);

        User::create([
            'id' => 4,
            'role' => 'tenaga ahli',
            'email' => 'tenaga_ahli2@example.com',
            'password' => Hash::make('123123123'),
            'nama' => 'Dr. 2',
            'jenis_kelamin' => 'perempuan',
            'tanggal_lahir' => '1987-04-04',
            'foto_profil' => null,
            'otp_code' => null,
            'otp_expires_at' => null,
            'email_verified_at' => Carbon::now(),
        ]);

        // Pasien
        User::create([
            'id' => 5,
            'role' => 'pasien',
            'email' => 'pblif19@gmail.com',
            'password' => Hash::make('123123123'),
            'nama' => 'PBL IF-19',
            'jenis_kelamin' => 'laki laki',
            'tanggal_lahir' => '2000-05-05',
            'foto_profil' => null,
            'otp_code' => random_int(100000, 999999),
            'otp_expires_at' => Carbon::now(),
            'email_verified_at' => null,
        ]);

        User::create([
            'id' => 6,
            'role' => 'pasien',
            'email' => 'pasien@example.com',
            'password' => Hash::make('123123123'),
            'nama' => 'Verified',
            'jenis_kelamin' => 'perempuan',
            'tanggal_lahir' => '1998-06-06',
            'foto_profil' => null,
            'otp_code' => null,
            'otp_expires_at' => null,
            'email_verified_at' => Carbon::now(),
        ]);
    }
}
