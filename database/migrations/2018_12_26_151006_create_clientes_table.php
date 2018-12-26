<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientesTable extends Migration {

	public function up()
	{
		Schema::create('clientes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nome', 255);
			$table->string('telefone')->nullable();
			$table->string('celular')->nullable();
			$table->string('documento', 255)->nullable();
			$table->string('endereco')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('clientes');
	}
}