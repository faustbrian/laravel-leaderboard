<?php

namespace DraperStudio\Leaderboard\Exceptions;

use Exception;

class InsufficientFundsException extends Exception
{
    public function __construct($type, $id, $points)
    {
        $points = abs($points);

        parent::__construct("Entity [{$type}] with ID [{$id}] is missing [{$points}] points.");
    }
}
