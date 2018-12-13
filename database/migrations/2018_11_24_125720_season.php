<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Season extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('season', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('seasonNo')->unsigned();
            $table->integer('serie_id')->unsigned()->nullable();
            $table->rememberToken();
            $table->timestamps();

        });

        Schema::table('season', function($table) {
            $table->foreign('serie_id')
                ->references('id')->on('serie')
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
        Schema::dropIfExists('season');
    }
}
