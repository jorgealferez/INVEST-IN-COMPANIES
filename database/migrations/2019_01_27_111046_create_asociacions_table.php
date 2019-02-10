<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsociacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //'name', 'address','email','phone','active','contact','contactPhone','','state'
        Schema::create('asociacions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('contact')->nullable();
            $table->string('contactPhone')->nullable();
            $table->string('contactEmail')->nullable();
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
        Schema::dropIfExists('asociacions');
    }
}
