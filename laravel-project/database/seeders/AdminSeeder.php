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
        Admin::create([
            'id' => 1,
            'id_user' => 1,
            'admin_role' => 'superadmin',
        ]);

        Admin::create([
            'id' => 2,
            'id_user' => 2,
            'admin_role' => 'content admin',
        ]);
    }
}
