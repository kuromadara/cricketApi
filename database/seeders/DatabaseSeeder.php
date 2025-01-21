<?php

namespace Database\Seeders;

use App\Models\MatchDetails;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Player;
use App\Models\Team;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create 50 users
        $users = User::factory(50)->create();

        // for all users with role P create a player
        foreach ($users as $user) {
            if ($user->role == 'P') {
                Player::factory()->create([
                    'user_id' => $user->id,
                ]);
            }
        }





        $matchDetails = MatchDetails::factory()->count(50)->create();

    }
}
