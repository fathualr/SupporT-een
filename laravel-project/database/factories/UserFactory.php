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

    // State untuk role admin
    public function admin()
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
        ]);
    }

    // State untuk role pasien
    public function pasien()
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'pasien',
        ]);
    }

    // State untuk role tenaga ahli
    public function tenagaAhli()
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'tenaga ahli',
        ]);
    }
}
