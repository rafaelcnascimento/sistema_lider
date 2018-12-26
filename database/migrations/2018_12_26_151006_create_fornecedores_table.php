<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFornecedoresTable extends Migration {

	public function up()
	{
		Schema::create('fornecedores', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nome', 255);
			$table->string('telefone', 20)->nullable();
			$table->string('celular', 20)->nullable();
			$table->string('endereco', 255)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('fornecedores');
	}
}