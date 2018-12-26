<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePedidoProdutoTable extends Migration {

	public function up()
	{
		Schema::create('pedido_produto', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('pedido_id')->unsigned();
			$table->integer('produto')->unsigned();
			$table->integer('quantidade');
			$table->integer('preco');
		});
	}

	public function down()
	{
		Schema::drop('pedido_produto');
	}
}
