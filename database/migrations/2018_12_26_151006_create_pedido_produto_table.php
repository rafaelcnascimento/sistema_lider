<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePedidoProdutoTable extends Migration {

	public function up()
	{
		Schema::create('pedido_produto', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('pedido_id')->unsigned();
			$table->integer('produto_id')->unsigned();
			$table->integer('preco_unitario');
			$table->integer('quantidade');
			$table->integer('preco_total');
		});
	}

	public function down()
	{
		Schema::drop('pedido_produto');
	}
}
