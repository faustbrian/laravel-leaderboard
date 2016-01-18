<?php

namespace DraperStudio\Leaderboard;

use DraperStudio\ServiceProvider\ServiceProvider as BaseProvider;

class ServiceProvider extends BaseProvider
{
    protected $packageName = 'leaderboard';

    public function boot()
    {
        $this->setup(__DIR__)
             ->publishMigrations();
    }

    public function register()
    {
        $this->app->bind(
            'DraperStudio\Leaderboard\Contracts\BoardRepository',
            'DraperStudio\Leaderboard\Repositories\EloquentBoardRepository'
        );
    }
}
