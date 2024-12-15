<?php

namespace Database\Factories;

use App\Models\TenagaAhli;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TenagaAhliFactory extends Factory
{
    protected $model = TenagaAhli::class;

    public function definition()
    {
        return [
            'id_user' => User::factory(), // Memastikan id_user sesuai dengan User yang di-factory
            'nomor_str' => $this->faker->unique()->numerify('STR#####'),
            'spesialisasi' => 'Psikologi',
            'jadwal_aktif' => $this->faker->randomElement(['Senin-Jumat, 09:00-17:00', 'Senin-Kamis, 10:00-16:00']),
            'lokasi_praktik' => $this->faker->city(),
            'biaya_konsultasi' => $this->faker->numberBetween(2, 100000),
            'tabungan' => $this->faker->numberBetween(2, 100000),
        ];
    }
}
