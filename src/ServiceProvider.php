<?php

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
