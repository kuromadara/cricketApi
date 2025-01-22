<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchDetails;
use App\Http\Resources\MatchDetailsResource;
use Illuminate\Support\Facades\Validator;

class MatchDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $matchDetails = MatchDetails::with(['cricketMatch', 'player'])->get();
        return MatchDetailsResource::collection($matchDetails);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cricket_match_id' => 'required|exists:cricket_matches,id',
            'player_id' => 'required|exists:players,id',
            'score' => 'required|string',
            'wickets' => 'required|string',
            'ball' => 'required|string',
            'runs' => 'required|string',
            'extras' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $matchDetail = MatchDetails::create($validator->validated());

        return new MatchDetailsResource($matchDetail);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
