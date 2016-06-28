<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFileColumn extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		//
		Schema::table('info_financiero', function(Blueprint $table) {
			$table->string('file');
		});

		Schema::table('gastos_acma', function(Blueprint $table) {
			$table->string('file');
		});

		Schema::table('ingresos_acma', function(Blueprint $table) {
			$table->string('file');
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
			$table->dropColumn('file');
		});

		Schema::table('gastos_acma', function(Blueprint $table) {
			$table->dropColumn('file');
		});

		Schema::table('ingresos_acma', function(Blueprint $table) {
			$table->dropColumn('file');
		});
	}

}
