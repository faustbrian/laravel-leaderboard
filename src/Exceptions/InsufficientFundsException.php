<?php

/*
 * This file is part of Laravel Leaderboard.
 *
 * (c) DraperStudio <hello@draperstudio.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace DraperStudio\Leaderboard\Exceptions;

use Exception;

/**
 * Class InsufficientFundsException.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class InsufficientFundsException extends Exception
{
    /**
     * InsufficientFundsException constructor.
     *
     * @param string    $type
     * @param int       $id
     * @param Exception $points
     */
    public function __construct($type, $id, $points)
    {
        $points = abs($points);

        parent::__construct("Entity [{$type}] with ID [{$id}] is missing [{$points}] points.");
    }
}
