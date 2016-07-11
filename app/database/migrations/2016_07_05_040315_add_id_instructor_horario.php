<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdInstructorHorario extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('horarios', function(Blueprint $table) {
			$table->integer('id_instructor');
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
		Schema::table('horarios', function(Blueprint $table) {
			$table->dropColumn('id_instructor');
		});
	}

}
