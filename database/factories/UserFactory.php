<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;
    protected static $organizerCreated = false;

    public function definition(): array
    {
        $role = 'P';
        if (!self::$organizerCreated) {
            $role = 'O';
            self::$organizerCreated = true;
        }

        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('password'), // Default password for testing
            'role' => $role,
            'remember_token' => Str::random(10),
        ];
    }
}
