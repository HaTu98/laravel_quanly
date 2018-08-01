<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProfilesLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::create('profilesLog', function(Blueprint $table){
            $table->increments('action_id');
            $table->integer('user_id');
            $table->integer('profileUpdate_id');
            $table->integer('action_type');
            $table->string('before_action');
            $table->string('after_action');
            $table->timestamps();
        });    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profilesLog');    
    }
}
