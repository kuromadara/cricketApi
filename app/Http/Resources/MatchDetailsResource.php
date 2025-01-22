<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MatchDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'cricket_match_id' => $this->cricket_match_id,
            'player_id' => $this->player_id,
            'score' => $this->score,
            'wickets' => $this->wickets,
            'ball' => $this->ball,
            'runs' => $this->runs,
            'extras' => $this->extras,
            'status' => $this->status,
        ];
    }
}
