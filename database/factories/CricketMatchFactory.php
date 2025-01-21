<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CricketMatch>
 */
class CricketMatchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Get all existing players
        $allPlayers = Player::all();

        // Randomly select 11 unique players
        $selectedPlayers = $allPlayers->random(11);

        // Ensure exactly 11 player IDs
        $playerIds = $selectedPlayers->pluck('id')->toArray();

        // Verify we have exactly 11 players
        if (count($playerIds) !== 11) {
            throw new \Exception('Failed to select exactly 11 players for the cricket match');
        }

        return [
            'team_id' => Team::factory(),
            'players' => json_encode($playerIds), // Encode player IDs as JSON
            'status' => $this->faker->randomElement(['pending', 'completed']),
        ];
    }
}
