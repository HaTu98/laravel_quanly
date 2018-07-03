<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class changeTimes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('times', function (Blueprint $table) {
            $table->integer('status')->default(0)->change();
            $table->time('start')->default(null)->change();
            $table->time('finish')->default(null)->change();
            $table->integer('time_per_day')->default(0)->change();
            $table->integer('all_time')->default(0)->change();
            $table->date("date")->default(null)->change();

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
    }
}
