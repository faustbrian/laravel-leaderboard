<?php

/*
 * This file is part of Laravel Leaderboard.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Leaderboard\Contracts;

/**
 * Interface BoardRepository.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
interface BoardRepository
{
    /**
     * @param $points
     *
     * @return mixed
     */
    public function reward($points);

    /**
     * @param $points
     *
     * @return mixed
     */
    public function penalize($points);

    /**
     * @param $multiplier
     *
     * @return mixed
     */
    public function multiply($multiplier);

    /**
     * @param $points
     *
     * @return mixed
     */
    public function redeem($points);

    /**
     * @return mixed
     */
    public function blacklist();

    /**
     * @return mixed
     */
    public function whitelist();

    /**
     * @return mixed
     */
    public function reset();
}
