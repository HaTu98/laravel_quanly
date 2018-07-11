<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TimesLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('times_log', function(Blueprint $table){
            $table->increments('action_id');
            $table->integer('user_id');
            $table->integer('time_id');
            $table->integer('action_type');
            $table->string('before_action');
            $table->string('after_action');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('times_log');
    }
}
