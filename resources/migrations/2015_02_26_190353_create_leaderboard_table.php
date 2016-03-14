<?php


use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Class CreateLeaderboardTable.
 *
 * @author DraperStudio <hello@draperstudio.tech>
 */
class CreateLeaderboardTable extends Migration
{
    public function up()
    {
        Schema::create('leaderboard', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('boardable_id')->unsigned();
            $table->string('boardable_type');
            $table->integer('points')->unsigned();
            $table->integer('rank')->unsigned();
            $table->boolean('blacklisted')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('leaderboard');
    }
}
