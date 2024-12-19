<?php

namespace Database\Factories;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    protected $model = Admin::class;

    public function definition()
    {
        return [
            'id_user' => User::factory()->admin(), // Memastikan id_user sesuai dengan User yang di-factory
            'admin_role' => $this->faker->randomElement(['superadmin', 'content admin']),
        ];
    }
}
