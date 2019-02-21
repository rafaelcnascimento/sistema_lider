<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrcamentosTable extends Migration {

	public function up()
	{
		Schema::create('orcamentos', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('cliente_id')->unsigned()->nullable();
			$table->float('valor');
			$table->float('desconto')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('orcamentos');
	}
}
