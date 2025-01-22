<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StadiumResource;
use App\Models\Stadium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class StadiumController extends Controller
{
    /**
     * Display a paginated list of stadiums.
     */
    public function index(Request $request)
    {
        // Fetch stadiums with pagination (10 per page by default)
        $perPage = $request->input('per_page', 10);
        $stadiums = Stadium::paginate($perPage);

        // Return paginated stadium data as a resource
        return StadiumResource::collection($stadiums);
    }

    /**
     * Store a new stadium in the database.
     */
    public function store(Request $request)
    {

        Log::info($request->all());
        // Validate the incoming request
        $validatedData = $request->validate([
            'cricket_match_id' => 'required|exists:cricket_matches,id',
            'stadium_name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Optional image upload
        ]);

        // Handle image upload if an image is provided
        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Generate a unique filename using stadium name and timestamp
            $filename = Str::slug($validatedData['stadium_name']) . '_' . now()->timestamp . '.' . $image->getClientOriginalExtension();

            // Store the image in the stadiums directory
            $imagePath = $image->storeAs('stadiums', $filename, 'public');
        }

        // Create the stadium record
        $stadium = Stadium::create([
            'cricket_match_id' => $validatedData['cricket_match_id'],
            'stadium_name' => $validatedData['stadium_name'],
            'image' => $imagePath ? 'storage/' . $imagePath : null,
        ]);

        // Return the created stadium as a resource
        return new StadiumResource($stadium);
    }

    /**
     * Display the specified stadium.
     */
    public function show(Stadium $stadium)
    {
        return new StadiumResource($stadium);
    }

    /**
     * Update the specified stadium in the database.
     */
    public function update(Request $request, Stadium $stadium)
    {
        //
    }

    /**
     * Remove the specified stadium from the database.
     */
    public function destroy(Stadium $stadium)
    {
        $stadium->delete();

        return response()->json(['message' => 'Stadium deleted successfully.']);
    }
}
