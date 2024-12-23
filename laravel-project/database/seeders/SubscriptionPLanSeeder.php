<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriptionPLanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('subscription_plan')->insert([
            [
                'name' => 'Paket Langganan Premium',
                'price' => 100000.00,
                'duration' => 30,
            ],
        ]);
    }
}
