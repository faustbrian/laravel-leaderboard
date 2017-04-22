<?php



declare(strict_types=1);



namespace BrianFaust\Leaderboard\Contracts;

interface BoardRepository
{
    /**
     * @param $points
     *
     * @return mixed
     */
    public function reward($points);

    /**
     * @param $points
     *
     * @return mixed
     */
    public function penalize($points);

    /**
     * @param $multiplier
     *
     * @return mixed
     */
    public function multiply($multiplier);

    /**
     * @param $points
     *
     * @return mixed
     */
    public function redeem($points);

    /**
     * @return mixed
     */
    public function blacklist();

    /**
     * @return mixed
     */
    public function whitelist();

    /**
     * @return mixed
     */
    public function reset();
}
