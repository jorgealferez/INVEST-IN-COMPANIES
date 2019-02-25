<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsociacionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asociacion_user', function (Blueprint $table) {
            $table->increments('id');


            $table->integer('asociacion_id')->unsigned();
            $table->foreign('asociacion_id')->references('id')->on('asociaciones');
            // $table->integer('asociacion_id')->unsigned();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            // $table->integer('user_id')->unsigned();
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
        Schema::dropIfExists('asociacion_user');
    }
}
