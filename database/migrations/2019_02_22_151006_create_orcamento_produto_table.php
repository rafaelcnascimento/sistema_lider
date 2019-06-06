<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrcamentoProdutoTable extends Migration {

	public function up()
	{
		Schema::create('orcamento_produto', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('orcamento_id')->unsigned();
			$table->integer('produto_id')->unsigned();
			$table->float('preco_unitario');
			$table->integer('quantidade');
			$table->float('preco_total');
		});
	}

	public function down()
	{
		Schema::drop('orcamento_produto');
	}
}
