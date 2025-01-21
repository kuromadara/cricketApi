<?php

namespace Database\Factories;

use App\Models\CricketMatch;
use App\Models\MatchDetails;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MatchDetails>
 */
class MatchDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Create a cricket match first
        $cricketMatch = CricketMatch::factory()->create();

        // Decode the players JSON to get arrays of player IDs
        $team1PlayerIds = json_decode($cricketMatch->team1_players, true);
        $team2PlayerIds = json_decode($cricketMatch->team2_players, true);

        // Combine player IDs from both teams
        $allPlayerIds = array_merge($team1PlayerIds, $team2PlayerIds);

        // Create match details for each player, ensuring no duplicates
        $existingMatchDetails = MatchDetails::where('cricket_match_id', $cricketMatch->id)->pluck('player_id');

        $availablePlayers = collect($allPlayerIds)->diff($existingMatchDetails);

        if ($availablePlayers->isEmpty()) {
            throw new \Exception('No available players left for match details');
        }

        $playerId = $availablePlayers->first();

        return [
            'cricket_match_id' => $cricketMatch->id,
            'player_id' => $playerId,
            'score' => $this->faker->numberBetween(0, 100),
            'wickets' => $this->faker->numberBetween(0, 10),
            'ball' => $this->faker->numberBetween(0, 100),
            'runs' => $this->faker->numberBetween(0, 100),
            'extras' => $this->faker->numberBetween(0, 10),
            'status' => $this->faker->randomElement(['pending', 'completed']),
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (MatchDetails $matchDetails) {
            // Ensure multiple match details are created for the match
            $cricketMatch = CricketMatch::find($matchDetails->cricket_match_id);

            // Decode player IDs from both teams
            $team1PlayerIds = json_decode($cricketMatch->team1_players, true);
            $team2PlayerIds = json_decode($cricketMatch->team2_players, true);
            $allPlayerIds = array_merge($team1PlayerIds, $team2PlayerIds);

            // Create additional match details if not already created
            $existingPlayerIds = MatchDetails::where('cricket_match_id', $cricketMatch->id)
                ->pluck('player_id')
                ->toArray();

            $missingPlayerIds = array_diff($allPlayerIds, $existingPlayerIds);

            foreach ($missingPlayerIds as $playerId) {
                // Only create if the player hasn't already been added
                if (!MatchDetails::where('cricket_match_id', $cricketMatch->id)
                    ->where('player_id', $playerId)
                    ->exists()) {
                    MatchDetails::create([
                        'cricket_match_id' => $cricketMatch->id,
                        'player_id' => $playerId,
                        'score' => $this->faker->numberBetween(0, 100),
                        'wickets' => $this->faker->numberBetween(0, 10),
                        'ball' => $this->faker->numberBetween(0, 100),
                        'runs' => $this->faker->numberBetween(0, 100),
                        'extras' => $this->faker->numberBetween(0, 10),
                        'status' => $this->faker->randomElement(['pending', 'completed']),
                    ]);
                }
            }
        });
    }
}
