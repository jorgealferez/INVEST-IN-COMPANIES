<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfertaInversorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oferta_inversor', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('oferta_id');
            // $table->foreign('oferta_id')->references('id')->on('ofertas');

            $table->unsignedInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');

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
        Schema::dropIfExists('oferta_inversor');
    }
}
