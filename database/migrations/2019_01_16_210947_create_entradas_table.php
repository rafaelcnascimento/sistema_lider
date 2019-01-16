<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntradasTable extends Migration {

	public function up()
	{
		Schema::create('entradas', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('produto_id')->unsigned();
			$table->integer('quantidade');
			$table->float('custo');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('entradas');
	}
}