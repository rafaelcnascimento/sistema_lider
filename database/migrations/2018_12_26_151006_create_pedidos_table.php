<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePedidosTable extends Migration {

	public function up()
	{
		Schema::create('pedidos', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('cliente_id')->unsigned()->nullable();
			$table->float('preco');
			$table->float('desconto')->default('0');
			$table->boolean('pago')->default(0);
			$table->string('documento', 255)->default('Não');
			$table->integer('pagamento_id');
			$table->integer('parcela_paga')->nullable();
			$table->integer('parcela_total');
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('pedidos');
	}
}
