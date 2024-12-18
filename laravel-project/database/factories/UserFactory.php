<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'role' => $this->faker->randomElement(['admin', 'pasien', 'tenaga ahli']),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['laki laki', 'perempuan']),
            'tanggal_lahir' => $this->faker->date(),
            'foto_profil' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
