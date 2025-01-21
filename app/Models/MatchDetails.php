<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchDetails extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        'cricket_match_id',
        'player_id',
        'score',
        'wickets',
        'ball',
        'runs',
        'extras',
        'status',
    ];

    public function cricketMatch()
    {
        return $this->belongsTo(CricketMatch::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
