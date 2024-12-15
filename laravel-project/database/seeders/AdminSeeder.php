<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Menambahkan admin secara langsung dengan ID yang sudah ditentukan
        Admin::create([
            'id' => 1, // ID untuk admin pertama
            'id_user' => 1, // ID pengguna admin pertama
            'admin_role' => 'superadmin', // Admin 1 sebagai superadmin
        ]);

        Admin::create([
            'id' => 2, // ID untuk admin kedua
            'id_user' => 2, // ID pengguna admin kedua
            'admin_role' => 'content admin', // Admin 2 sebagai content admin
        ]);
        
        Admin::factory()->count(15)->create(); // Menggunakan factory untuk Admin
    }
}
