<?php

namespace DraperStudio\Leaderboard\Traits;

use DraperStudio\Leaderboard\Repositories\EloquentBoardRepository;

trait Boardable
{
    public function reward($points)
    {
        return $this->leaderboard()->reward($points);
    }

    public function penalize($points)
    {
        return $this->leaderboard()->penalize($points);
    }

    public function multiply($multiplier)
    {
        return $this->leaderboard()->multiply($multiplier);
    }

    public function redeem($points)
    {
        return $this->leaderboard()->redeem($points);
    }

    public function blacklist()
    {
        return $this->leaderboard()->blacklist();
    }

    public function whitelist()
    {
        return $this->leaderboard()->whitelist();
    }

    public function reset()
    {
        return $this->leaderboard()->reset();
    }

    public function getPoints()
    {
        return $this->board->points;
    }

    public function getRank()
    {
        return $this->board->rank;
    }

    public function isBlacklisted()
    {
        return $this->board->blacklisted;
    }

    public function board()
    {
        return $this->morphOne('DraperStudio\Leaderboard\Models\Board', 'boardable');
    }

    protected function leaderboard()
    {
        return new EloquentBoardRepository($this);
    }
}
