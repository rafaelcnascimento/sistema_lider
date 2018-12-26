<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('produtos', function(Blueprint $table) {
			$table->foreign('unidade_id')->references('id')->on('unidades')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('produtos', function(Blueprint $table) {
			$table->foreign('fornecedor_id')->references('id')->on('fornecedores')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('pedidos', function(Blueprint $table) {
			$table->foreign('cliente_id')->references('id')->on('clientes')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('pedido_produto', function(Blueprint $table) {
			$table->foreign('pedido_id')->references('id')->on('pedidos')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
		Schema::table('pedido_produto', function(Blueprint $table) {
			$table->foreign('produto')->references('id')->on('produtos')
						->onDelete('restrict')
						->onUpdate('restrict');
		});
	}

	public function down()
	{
		Schema::table('produtos', function(Blueprint $table) {
			$table->dropForeign('produtos_unidade_id_foreign');
		});
		Schema::table('produtos', function(Blueprint $table) {
			$table->dropForeign('produtos_fornecedor_id_foreign');
		});
		Schema::table('pedidos', function(Blueprint $table) {
			$table->dropForeign('pedidos_cliente_id_foreign');
		});
		Schema::table('pedido_produto', function(Blueprint $table) {
			$table->dropForeign('pedido_produto_pedido_id_foreign');
		});
		Schema::table('pedido_produto', function(Blueprint $table) {
			$table->dropForeign('pedido_produto_produto_foreign');
		});
	}
}