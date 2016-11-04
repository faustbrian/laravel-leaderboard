<?php

namespace BrianFaust\Leaderboard\Exceptions;

use Exception;

class BlacklistedException extends Exception
{
    /**
     * BlacklistedException constructor.
     *
     * @param string $type
     * @param int    $id
     */
    public function __construct($type, $id)
    {
        parent::__construct("Entity [{$type}] with ID [{$id}] is blacklisted.");
    }
}
