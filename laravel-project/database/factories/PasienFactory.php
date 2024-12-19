<?php

namespace Database\Factories;

use App\Models\Pasien;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PasienFactory extends Factory
{
    protected $model = Pasien::class;

    public function definition()
    {
        return [
            'id_user' => User::factory()->pasien(), // Memastikan id_user sesuai dengan User yang di-factory
            'deskripsi_diri' => $this->faker->sentence(),
        ];
    }
}

