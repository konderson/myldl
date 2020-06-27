<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDelaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_delate', function (Blueprint $table) {
            $table->bigIncrements('id');
             $table->bigInteger('user_id')->unsigned();
              $table->bigInteger('delo_id')->unsigned();
               $table->bigInteger('tip_id')->unsigned();
              /* $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
                $table->foreign('delo_id')->references('id')
                ->on('dela');
                 $table->foreign('tip_id')->references('id')
                ->on('tip_dela')->onDelete('cascade');*/
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
        Schema::dropIfExists('user_dela');
    }
}