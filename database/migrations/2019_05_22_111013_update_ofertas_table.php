<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateOfertasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('ofertas', function ($table) {
                    
                    $table->bigInteger('facturacion')->default(0)->nullable();
                    
                    $table->unsignedInteger('ofertatipo_id')->nullable();
                    $table->foreign('ofertatipo_id')->references('id')->on('ofertas_tipos');
                        
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	}

}
