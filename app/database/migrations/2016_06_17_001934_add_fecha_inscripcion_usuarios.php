<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFechaInscripcionUsuarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('usuarios', function(Blueprint $table) {
			$table->dateTime('fecha_inscripcion');
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
		Schema::table('usuarios', function(Blueprint $table) {
			$table->dropColumn('fecha_inscripcion');
		});
	}

}
