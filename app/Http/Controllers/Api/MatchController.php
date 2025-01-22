<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MatchResource;
use App\Models\CricketMatch;
use Illuminate\Http\Request;

class MatchController extends Controller
{
    /**
     * Display a paginated list of matches.
     */
    public function index(Request $request)
    {
        // Fetch matches with pagination (10 per page by default)
        $perPage = $request->input('per_page', 10);

        // Create a base query
        $query = CricketMatch::query();

        // Filter by status if provided
        if ($request->has('status')) {
            $status = $request->input('status');
            $query->where('status', $status);
        }

        // Paginate the results
        $matches = $query->paginate($perPage);

        // Return paginated match data as a resource
        return MatchResource::collection($matches);
    }

    /**
     * Store a new match in the database.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified match.
     */
    public function show(CricketMatch $match)
    {
        return new MatchResource($match);
    }

    /**
     * Update the specified match in the database.
     */
    public function update(Request $request, CricketMatch $match)
    {
        //
    }

    /**
     * Remove the specified match from the database.
     */
    public function destroy(CricketMatch $match)
    {
        $match->delete();

        return response()->json(['message' => 'Match deleted successfully.']);
    }
}
