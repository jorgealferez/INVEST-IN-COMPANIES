<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInversionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inversiones', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('oferta_id');
            $table->foreign('oferta_id')->references('id')->on('ofertas');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');


            $table->unsignedInteger('estado_id');
            $table->foreign('estado_id')->references('id')->on('estados_inversores');

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
        Schema::dropIfExists('inversiones');
    }
}
