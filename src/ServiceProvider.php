<?php

/*
 * This file is part of Laravel Leaderboard.
 *
 * (c) Brian Faust <hello@brianfaust.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BrianFaust\Leaderboard;

class ServiceProvider extends \BrianFaust\ServiceProvider\ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->publishMigrations();
    }

    /**
     * Register the application services.
     */
    public function register()
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
    public function getPackageName()
    {
        return 'leaderboard';
    }
}
