<?php



declare(strict_types=1);



namespace BrianFaust\Leaderboard\Exceptions;

use Exception;

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
