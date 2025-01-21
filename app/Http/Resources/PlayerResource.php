<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'age' => $this->age,
            'total_score_yearly' => $this->total_score_yearly,
            'total_score_daily' => $this->total_score_daily,
            'best_performance' => $this->best_performance,
            'wickets' => $this->wickets,
        ];
    }
}
