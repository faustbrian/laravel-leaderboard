<?php

namespace DraperStudio\Leaderboard\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    protected $table = 'leaderboard';

    protected $fillable = ['points', 'rank', 'locked'];

    protected $casts = [
        'points' => 'integer',
        'rank' => 'integer',
        'locked' => 'boolean',
    ];

    public function boardable()
    {
        return $this->morphTo();
    }

    public function getId()
    {
        return $this->boardable_id;
    }

    public function getType()
    {
        return $this->boardable_type;
    }
}
