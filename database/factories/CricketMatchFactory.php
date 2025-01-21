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
        // Get all existing teams
        $teams = Team::all();

        // Ensure we have at least 2 teams
        if ($teams->count() < 2) {
            // Create teams if not enough exist
            $teams = Team::factory(2 - $teams->count())->create();
        }

        // Randomly select two different teams
        $selectedTeams = $teams->shuffle()->take(2);

        // Get all existing players
        $allPlayers = Player::all();

        // Randomly select 11 unique players for team 1
        $team1Players = $allPlayers->random(11);

        // Remove team 1 players from the pool
        $remainingPlayers = $allPlayers->diff($team1Players);

        // Randomly select 11 unique players for team 2
        $team2Players = $remainingPlayers->random(11);

        // Ensure exactly 11 players for each team
        $team1PlayerIds = $team1Players->pluck('id')->toArray();
        $team2PlayerIds = $team2Players->pluck('id')->toArray();

        // Verify we have exactly 11 players for each team
        if (count($team1PlayerIds) !== 11 || count($team2PlayerIds) !== 11) {
            throw new \Exception('Failed to select exactly 11 players for each team');
        }

        return [
            'team1_id' => $selectedTeams[0]->id,
            'team1_players' => json_encode($team1PlayerIds),
            'team2_id' => $selectedTeams[1]->id,
            'team2_players' => json_encode($team2PlayerIds),
            'result' => $this->faker->randomElement([null, 'team1_won', 'team2_won', 'draw']),
            'status' => $this->faker->randomElement(['pending', 'completed']),
        ];
    }
}
