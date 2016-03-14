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
 * Class BlacklistedException.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
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
