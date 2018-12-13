<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Subtitle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subtitle', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lang');
            $table->string('label');
            $table->string('source');
            $table->boolean('default')->default(false);
            $table->integer('episode_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });


        Schema::table('subtitle', function($table) {
            $table->foreign('episode_id')
                ->references('id')->on('episode')
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
        Schema::dropIfExists('subtitle');
    }
}
