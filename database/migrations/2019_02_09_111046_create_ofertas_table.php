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
            $table->string('name');
            $table->string('cif')->unique();
            $table->string('contact')->nullable();
            $table->string('contactSurname')->nullable();
            $table->string('contactPhone')->nullable();
            $table->string('contactEmail')->nullable();
            $table->string('address')->nullable();
            $table->string('web')->nullable();
            $table->string('explotacion1')->nullable();
            $table->string('explotacion2')->nullable();
            $table->string('explotacion3')->nullable();
            $table->unsignedDecimal('endeudamiento',15,2)->nullable();
            $table->integer('socios')->default(0)->nullable();
            $table->text('motivo')->nullable();
            $table->integer('año')->nullable();
            $table->integer('valoracion')->nullable();
            $table->boolean('local')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('active')->default(true);
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
