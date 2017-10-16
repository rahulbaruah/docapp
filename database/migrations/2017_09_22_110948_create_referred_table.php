<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferredTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referred', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('referred_user_id')->unsigned();
            $table->integer('discount')->nullable();
            $table->dateTime('arrived_at')->nullable();
            $table->timestamps();
            
            $table->foreign('referred_user_id')->references('id')->on('users');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('referred');
    }
}
