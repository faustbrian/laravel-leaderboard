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

namespace BrianFaust\Leaderboard;

use BrianFaust\ServiceProvider\AbstractServiceProvider;

class LeaderboardServiceProvider extends AbstractServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        $this->publishMigrations();
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
        parent::register();

        $this->app->bind(
            'BrianFaust\Leaderboard\Contracts\BoardRepository',
            'BrianFaust\Leaderboard\Repositories\EloquentBoardRepository'
        );
    }

    /**
     * Get the default package name.
     *
     * @return string
     */
    public function getPackageName(): string
    {
        return 'leaderboard';
    }
}
