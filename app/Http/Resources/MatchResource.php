<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\PlayerResource;

class MatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'team1' => [
                'id' => $this->team1->id,
                'name' => $this->team1->name,
                'players' => $this->team1_players,
            ],
            'team2' => [
                'id' => $this->team2->id,
                'name' => $this->team2->name,
                'players' => $this->team2_players,
            ],
            'result' => $this->result,
            'status' => $this->status,
            'match_details' => $this->whenLoaded('matchDetails', function () {
                return $this->matchDetails->map(function ($detail) {
                    return [
                        'player_id' => $detail->player_id,
                        'score' => $detail->score,
                        'wickets' => $detail->wickets,
                        'runs' => $detail->runs,
                        'extras' => $detail->extras,
                    ];
                });
            }),
        ];
    }
}
