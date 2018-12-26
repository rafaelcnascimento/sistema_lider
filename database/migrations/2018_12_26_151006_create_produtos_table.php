<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProdutosTable extends Migration {

	public function up()
	{
		Schema::create('produtos', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nome', 255);
			$table->string('codigo', 50);
			$table->integer('unidade_id')->unsigned()->index();
			$table->integer('fornecedor_id')->unsigned()->nullable();
			$table->integer('quantidade')->default('0');
			$table->integer('estoque_baixo')->default('1');
			$table->integer('custo_inicial')->default('0');
			$table->float('ipi')->default('0');
			$table->float('icms')->default('0');;
			$table->float('frete')->default('0');
			$table->float('margem')->default('0');
			$table->float('custo_final');
			$table->float('preco');
		});
	}

	public function down()
	{
		Schema::drop('produtos');
	}
}
