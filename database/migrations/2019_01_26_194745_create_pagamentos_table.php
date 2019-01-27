<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePagamentosTable extends Migration {

	public function up()
	{
		Schema::create('pagamentos', function(Blueprint $table) {
			$table->increments('id');
			$table->softDeletes();
			$table->string('nome');
		});
	}

	public function down()
	{
		Schema::drop('pagamentos');
	}
}