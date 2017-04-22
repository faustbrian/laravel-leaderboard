<?php



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
