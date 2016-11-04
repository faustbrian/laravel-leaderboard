<?php

namespace BrianFaust\Leaderboard\Models;

use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    /**
     * @var string
     */
    protected $table = 'leaderboard';

    /**
     * @var array
     */
    protected $fillable = ['points', 'rank', 'locked'];

    /**
     * @var array
     */
    protected $casts = [
        'points' => 'integer',
        'rank' => 'integer',
        'locked' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function boardable()
    {
        return $this->morphTo();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->boardable_id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->boardable_type;
    }
}
