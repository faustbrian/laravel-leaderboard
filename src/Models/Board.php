<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Leaderboard.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Artisanry\Leaderboard\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

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
        'rank'   => 'integer',
        'locked' => 'boolean',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function boardable(): MorphTo
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
    public function getType(): string
    {
        return $this->boardable_type;
    }
}
