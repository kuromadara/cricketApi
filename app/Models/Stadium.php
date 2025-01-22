<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stadium extends Model
{
    use SoftDeletes;

    protected $table = 'stadiums';

    protected $fillable = [
        'cricket_match_id',
        'stadium_name',
        'image',
    ];

    public function cricketMatch()
    {
        return $this->belongsTo(CricketMatch::class);
    }
}
