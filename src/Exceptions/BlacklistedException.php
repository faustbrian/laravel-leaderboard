<?php

namespace DraperStudio\Leaderboard\Exceptions;

use Exception;

class BlacklistedException extends Exception
{
    public function __construct($type, $id)
    {
        parent::__construct("Entity [{$type}] with ID [{$id}] is blacklisted.");
    }
}
