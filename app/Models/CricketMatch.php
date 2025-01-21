<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Team;
use App\Models\MatchDetails;

class CricketMatch extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'team1_id',
        'team1_players',
        'team2_id',
        'team2_players',
        'result',
        'status',
    ];

    protected $casts = [
        'team1_players' => 'array',
        'team2_players' => 'array',
    ];

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    public function matchDetails()
    {
        return $this->hasMany(MatchDetails::class);
    }

    public function getAllPlayersAttribute()
    {
        return array_merge(
            $this->team1_players ?? [],
            $this->team2_players ?? []
        );
    }
}
