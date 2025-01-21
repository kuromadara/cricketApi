<?php

namespace Database\Factories;

use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Creates a related User
            'name' => $this->faker->name,
            'age' => $this->faker->numberBetween(18, 40),
            'total_score_yearly' => $this->faker->numberBetween(100, 1000),
            'total_score_daily' => $this->faker->numberBetween(10, 50),
            'best_performance' => $this->faker->sentence,
            'wickets' => $this->faker->numberBetween(0, 50),
        ];
    }
}
