<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helps', function (Blueprint $table) {
             $table->bigIncrements('id');
             $table->bigInteger('user_id')->unsigned();
             $table->string('title')->nullable();
             $table->integer('type')->nullable();
             $table->string('description')->nullable();
             $table->string('email')->nullable();
             $table->string('phone')->nullable();
             $table->string('cocial')->nullable();
             $table->integer('city_id')->nullable();
             $table->integer('country_id')->nullable();
             $table->string('city')->nullable();
             $table->string('name')->nullable();
             $table->string('images')->default('noimg.png');
             $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
             
             
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
        Schema::dropIfExists('helps');
    }
}