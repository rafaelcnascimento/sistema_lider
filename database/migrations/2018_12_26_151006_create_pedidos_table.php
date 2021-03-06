<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePedidosTable extends Migration {

	public function up()
	{
		Schema::create('pedidos', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('cliente_id')->unsigned()->nullable();
			$table->float('valor');
			$table->float('valor_pago')->nullable();
			$table->boolean('pago')->default(0);
			$table->integer('pagamento_id');
			$table->integer('parcela_paga')->default(1);
			$table->integer('parcela_total')->default(1);
			$table->text('obs')->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('pedidos');
	}
}
