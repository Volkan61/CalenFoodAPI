<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Episode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('episode', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('episodeNo')->unsigned();
            $table->boolean('status')->default(true);
            $table->string('audio')->default("en");
            $table->string('subtitle')->default("en");
            $table->integer('season_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        Schema::table('episode', function($table) {
            $table->foreign('season_id')
                ->references('id')->on('season')
                ->onDelete('cascade');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('episode');
    }
}
