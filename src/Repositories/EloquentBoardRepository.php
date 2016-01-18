<?php

namespace DraperStudio\Leaderboard\Repositories;

use DraperStudio\Leaderboard\Contracts\BoardRepository;
use DraperStudio\Leaderboard\Exceptions\BlacklistedException;
use DraperStudio\Leaderboard\Exceptions\InsufficientFundsException;
use DraperStudio\Leaderboard\Models\Board;

class EloquentBoardRepository implements BoardRepository
{
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function reward($points)
    {
        $this->abortIfBlacklisted();

        if ($this->getBoardQuery()->count()) {
            $this->getBoard()->increment('points', $points);
        } else {
            $this->getBoardQuery()->save(
                new Board(['points' => $points])
            );
        }

        $this->calculateRankings();
    }

    public function penalize($points)
    {
        $this->abortIfBlacklisted();

        $this->getBoard()->decrement('points', $points);

        $this->saveBoardInstance();
    }

    public function multiply($multiplier)
    {
        $this->abortIfBlacklisted();

        $this->getBoard()->points = $this->getBoard()->points * $multiplier;

        $this->saveBoardInstance();
    }

    public function redeem($points)
    {
        $this->abortIfBlacklisted();

        $afterRedemeption = $this->getBoard()->points - $points;

        if ($afterRedemeption < 0) {
            throw new InsufficientFundsException(
                $this->getBoard()->getType(),
                $this->getBoard()->getId(),
                $afterRedemeption
            );
        }

        $this->penalize($points);

        return true;
    }

    public function blacklist()
    {
        $this->getBoard()->blacklisted = true;

        $this->saveBoardInstance();
    }

    public function whitelist()
    {
        $this->getBoard()->blacklisted = false;

        $this->saveBoardInstance();
    }

    public function reset()
    {
        $this->abortIfBlacklisted();

        $this->getBoard()->points = 0;

        $this->saveBoardInstance();
    }

    protected function calculateRankings()
    {
        $boards = Board::orderBy('points', 'DESC')->get();

        foreach ($boards as $index => $board) {
            $board->rank = $index + 1;
            $board->push();
        }
    }

    protected function abortIfBlacklisted()
    {
        if ($this->model->isBlacklisted()) {
            throw new BlacklistedException(
                $this->getBoard()->getType(),
                $this->getBoard()->getId()
            );
        }

        return false;
    }

    protected function saveBoardInstance()
    {
        $this->getBoard()->save();

        $this->calculateRankings();
    }

    protected function getBoard()
    {
        return $this->model->board;
    }

    protected function getBoardQuery()
    {
        return $this->model->board();
    }
}
