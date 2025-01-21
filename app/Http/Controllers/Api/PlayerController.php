<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Player;
use Illuminate\Http\Request;
use App\Http\Resources\PlayerResource;

class PlayerController extends Controller
{
    /**
     * Display a paginated list of players.
     */
    public function index(Request $request)
    {
        // Fetch players with pagination (10 per page by default)
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');
        if ($search) {
            $players = Player::where('name', 'like', '%' . $search . '%')->paginate($perPage);
        } else {
            $players = Player::paginate($perPage);
        }

        // Return paginated player data as a resource
        return PlayerResource::collection($players);
    }

    /**
     * Store a new player in the database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1',
            'total_score_yearly' => 'required|integer|min:0',
            'total_score_daily' => 'nullable|integer|min:0',
            'best_performance' => 'nullable|string|max:255',
            'wickets' => 'nullable|integer|min:0',
        ]);

        $player = Player::create($validated);

        return new PlayerResource($player);
    }

    /**
     * Display the specified player.
     */
    public function show(Player $player)
    {
        return new PlayerResource($player);
    }

    /**
     * Update the specified player in the database.
     */
    public function update(Request $request, Player $player)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'age' => 'sometimes|required|integer|min:1',
            'total_score_yearly' => 'sometimes|required|integer|min:0',
            'total_score_daily' => 'nullable|integer|min:0',
            'best_performance' => 'nullable|string|max:255',
            'wickets' => 'nullable|integer|min:0',
        ]);

        $player->update($validated);

        return new PlayerResource($player);
    }

    /**
     * Remove the specified player from the database.
     */
    public function destroy(Player $player)
    {
        $player->delete();

        return response()->json(['message' => 'Player deleted successfully.']);
    }
}
