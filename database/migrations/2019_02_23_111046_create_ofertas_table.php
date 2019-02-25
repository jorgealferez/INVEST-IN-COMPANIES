<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('asociacion_id');
            $table->foreign('asociacion_id')->references('id')->on('asociaciones');

            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedInteger('forma_id')->nullable();
            $table->foreign('forma_id')->references('id')->on('formas');


            $table->unsignedInteger('sector_id')->nullable();
            $table->foreign('sector_id')->references('id')->on('sectores');


            $table->unsignedInteger('provincia_id')->nullable();
            $table->foreign('provincia_id')->references('id')->on('provincias');


            $table->unsignedInteger('poblacion_id')->nullable();
            $table->foreign('poblacion_id')->references('id')->on('poblaciones');


            $table->integer('socios')->default(0)->nullable();
            $table->text('motivo')->nullable();
            $table->text('descripcion')->nullable();
            $table->integer('empleados')->default(0)->nullable();
            $table->integer('año')->nullable();
            $table->string('name');
            $table->string('cif')->unique();
            $table->string('contact')->nullable();
            $table->string('contactSurname')->nullable();
            $table->string('contactPhone')->nullable();
            $table->string('contactEmail')->nullable();
            $table->string('address')->nullable();
            $table->string('web')->nullable();
            $table->decimal('valoracion',8,2)->default(0)->nullable();
            $table->string('explotacion1')->nullable();
            $table->string('explotacion2')->nullable();
            $table->string('explotacion3')->nullable();
            $table->unsignedDecimal('endeudamiento',8,2)->default(0)->nullable();
            $table->boolean('local')->nullable();
            $table->boolean('active')->default(true);
            $table->boolean('approved')->default(false);
            $table->string('phone')->nullable();
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
        Schema::dropIfExists('ofertas');
    }
}
