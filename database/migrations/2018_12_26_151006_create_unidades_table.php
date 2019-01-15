<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUnidadesTable extends Migration {

	public function up()
	{
		Schema::create('unidades', function(Blueprint $table) {
			$table->increments('id');
			$table->string('nome', 255);
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('unidades');
	}
}
