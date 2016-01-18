<?php

namespace DraperStudio\Leaderboard\Contracts;

interface BoardRepository
{
    public function reward($points);

    public function penalize($points);

    public function multiply($multiplier);

    public function redeem($points);

    public function blacklist();

    public function whitelist();

    public function reset();
}
