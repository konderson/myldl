<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('usrer_id');
            $table->string('name')->nullable;
            $table->string('title')->nullable;
            $table->string('description')->nullable;
            $table->string('keyw')->nullable;
            $table->string('flag')->default(0);
            $table->string('image')->nullable;
            $table->string('view')->nullable;
            $table->string('text')->nullable;
            
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
        Schema::dropIfExists('news');
    }
}