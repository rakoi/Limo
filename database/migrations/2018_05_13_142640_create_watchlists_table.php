<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWatchlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Watchlist', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('current_season');
            $table->string('current_episode');
            $table->integer('series_id')->unsigned();        
            $table->timestamps();    
        });
         Schema::table('Watchlist', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
       
     
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::dropIfExists('watchlist');
    }
}
