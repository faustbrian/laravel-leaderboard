<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Leaderboard.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Leaderboard\Repositories;

use BrianFaust\Leaderboard\Contracts\BoardRepository;
use BrianFaust\Leaderboard\Exceptions\BlacklistedException;
use BrianFaust\Leaderboard\Exceptions\InsufficientFundsException;
use BrianFaust\Leaderboard\Models\Board;

class EloquentBoardRepository implements BoardRepository
{
    /**
     * @var
     */
    protected $model;

    /**
     * EloquentBoardRepository constructor.
     *
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * @param $points
     *
     * @throws BlacklistedException
     */
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

    /**
     * @param $points
     *
     * @throws BlacklistedException
     */
    public function penalize($points)
    {
        $this->abortIfBlacklisted();

        $this->getBoard()->decrement('points', $points);

        $this->saveBoardInstance();
    }

    /**
     * @param $multiplier
     *
     * @throws BlacklistedException
     */
    public function multiply($multiplier)
    {
        $this->abortIfBlacklisted();

        $this->getBoard()->points = $this->getBoard()->points * $multiplier;

        $this->saveBoardInstance();
    }

    /**
     * @param $points
     *
     * @throws BlacklistedException
     * @throws InsufficientFundsException
     *
     * @return bool
     */
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

    /**
     * @throws BlacklistedException
     */
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

    /**
     * @throws BlacklistedException
     *
     * @return bool
     */
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

    /**
     * @return mixed
     */
    protected function getBoard()
    {
        return $this->model->board;
    }

    /**
     * @return mixed
     */
    protected function getBoardQuery()
    {
        return $this->model->board();
    }
}
