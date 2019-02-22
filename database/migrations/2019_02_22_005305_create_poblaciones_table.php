<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoblacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poblaciones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('provincia_id')->unsigned();
            $table->string('name');
            $table->string('slug');
            $table->string('latitud');
            $table->string('longitud');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poblaciones');
    }
}
