<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('pagos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('alumno_id')->unsigned();
			$table->integer('semestre_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->integer('nro_pension');
			$table->string('tipo', 20);
			$table->string('turno', 30);
			$table->string('aula', 30);
			$table->string('nroboleta');
			$table->boolean('estado');
			$table->timestamps();

			$table->foreign('alumno_id')
				->references('id')->on('alumnos')
				->onUpdate('CASCADE');

			$table->foreign('semestre_id')
				->references('id')->on('semestres')
				->onUpdate('CASCADE');
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
	}

}
