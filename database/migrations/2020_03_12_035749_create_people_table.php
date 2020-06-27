<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('ps')->nullable();
            $table->string('tel')->nullable();
            $table->integer('chel_org')->nullable();
            $table->string('help')->default('need');
            $table->string('help_additional')->nullable();
            $table->integer('reputation')->nullable();
            $table->dateTime('birthday')->nullable();
            $table->bigInteger('online_time')->nullable();
            $table->string('pol')->nullable();
            $table->string('city')->nullable();
            $table->bigInteger('city_id')->nullable();
            $table->string('country')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable();
            $table->string('apartment')->nullable();
            $table->integer('subscribed')->nullable();
            $table->string('mob_tel')->nullable();
            $table->integer('active')->nullable();
            $table->string('status_str')->nullable();
            $table->string('site')->nullable();
            $table->string('skype')->nullable();
            $table->string('dolznost')->nullable();
            $table->string('dohod')->nullable();
            $table->string('hobbi')->nullable();
            $table->string('avatar')->nullable();
            $table->string('ip')->nullable();
            $table->integer('is_online')->nullable();
            $table->string('is_admin')->nullable();

            





  
            
            
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
        Schema::dropIfExists('people');
    }
}