<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_diaries', function (Blueprint $table) {
            $table->bigIncrements('id');
                $table->integer('user_id')->nullable();
            $table->integer('news_id')->nullable();
            $table->string('text')->nullable();
            $table->integer('parent_id')->nullable();
            $table->string('author_name')->nullable();
            $table->integer('isauth');
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
        Schema::dropIfExists('comment_diaries');
    }
}