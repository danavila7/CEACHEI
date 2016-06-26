<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('clases', function(Blueprint $table) {
			$table->enum('tipo',
				array('teorica', 'practica'))->default('teorica');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
		Schema::table('clases', function(Blueprint $table) {
			$table->dropColumn('tipo');
		});
	}

}
