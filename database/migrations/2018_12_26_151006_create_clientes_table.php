<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientesTable extends Migration {

	public function up()
	{
		Schema::create('clientes', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nome', 255);
            $table->float('saldo')->nullable;
			$table->string('telefone')->nullable();
			$table->string('documento', 255)->nullable();
			$table->string('logradouro')->nullable();
			$table->string('numero')->nullable();
			$table->string('bairro')->nullable();
			$table->string('cidade')->nullable();
			$table->string('cep')->nullable();
			$table->string('complemento')->nullable();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('clientes');
	}
}
