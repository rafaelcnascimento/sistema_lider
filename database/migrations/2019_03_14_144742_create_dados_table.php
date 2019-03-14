<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dados', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('razao_social');
            $table->string('cpf_responsavel');
            $table->string('cnpj');
            $table->string('lougradouro');
            $table->string('numero');
            $table->string('bairro');
            $table->string('cidade');
            $table->string('estado');
            $table->string('cep');
            $table->string('agencia');
            $table->string('conta');
            $table->string('codigo_banco');
            $table->string('telefone');
            $table->string('celular')->nullable();
            $table->string('executavel');
        });
    }


    public function down()
    {
        Schema::dropIfExists('dados');
    }
}
