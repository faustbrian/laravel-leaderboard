<?php

/*
 * This file is part of Laravel Leaderboard.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Leaderboard\Traits;

use DraperStudio\Leaderboard\Repositories\EloquentBoardRepository;

/**
 * Class Boardable.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
trait Boardable
{
    /**
     * @param $points
     */
    public function reward($points)
    {
        return $this->leaderboard()->reward($points);
    }

    /**
     * @param $points
     */
    public function penalize($points)
    {
        return $this->leaderboard()->penalize($points);
    }

    /**
     * @param $multiplier
     */
    public function multiply($multiplier)
    {
        return $this->leaderboard()->multiply($multiplier);
    }

    /**
     * @param $points
     *
     * @return bool
     *
     * @throws \DraperStudio\Leaderboard\Exceptions\InsufficientFundsException
     */
    public function redeem($points)
    {
        return $this->leaderboard()->redeem($points);
    }

    /**
     *
     */
    public function blacklist()
    {
        return $this->leaderboard()->blacklist();
    }

    /**
     *
     */
    public function whitelist()
    {
        return $this->leaderboard()->whitelist();
    }

    /**
     *
     */
    public function reset()
    {
        return $this->leaderboard()->reset();
    }

    /**
     * @return mixed
     */
    public function getPoints()
    {
        return $this->board->points;
    }

    /**
     * @return mixed
     */
    public function getRank()
    {
        return $this->board->rank;
    }

    /**
     * @return mixed
     */
    public function isBlacklisted()
    {
        return $this->board->blacklisted;
    }

    /**
     * @return mixed
     */
    public function board()
    {
        return $this->morphOne('DraperStudio\Leaderboard\Models\Board', 'boardable');
    }

    /**
     * @return EloquentBoardRepository
     */
    protected function leaderboard()
    {
        return new EloquentBoardRepository($this);
    }
}
