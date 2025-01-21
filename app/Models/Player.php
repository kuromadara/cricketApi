<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Player extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'age',
        'total_score_yearly',
        'total_score_daily',
        'best_performance',
        'wickets',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
