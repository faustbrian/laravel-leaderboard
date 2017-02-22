<?php

/*
 * This file is part of Laravel Leaderboard.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

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
