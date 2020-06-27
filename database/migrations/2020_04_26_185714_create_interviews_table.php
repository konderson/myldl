<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInterviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user->id');
            $table->string('name')->nullable();
            $table->string('tex',2500)->nullable();
            $table->string('name_i')->nullable();
            $table->string('dostijenia')->nullable();
             $table->string('age')->nullable();
             $table->string('work')->nullable();
              $table->string('hobbi')->nullable();
              $table->string('image')->nullable();
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
        Schema::dropIfExists('interviews');
    }
}