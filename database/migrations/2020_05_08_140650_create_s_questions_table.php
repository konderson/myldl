<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('tip_id');
             $table->integer('is_open');
            $table->string('text');
            $table->string('variaant1')->nullable();
            $table->string('variaant2')->nullable();
            $table->string('variaant3')->nullable();
            $table->string('variaant4')->nullable();
            $table->string('variaant5')->nullable();
            $table->string('variaant6')->nullable();
            $table->string('variaant7')->nullable();
            $table->string('variaant8')->nullable();
            $table->string('variaant9')->nullable();
            $table->string('variaant10')->nullable();
            $table->string('end_date')->nullable();
            
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
        Schema::dropIfExists('s_questions');
    }
}