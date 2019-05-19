<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDespesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tipo_despesa_id')->unsigned()->nullable();
            $table->text('descricao')->nullable();
            $table->string('destinatario');
            $table->float('valor');
            $table->float('valor_pago')->nullable();
            $table->integer('pagamento_id');
            $table->boolean('pago')->default(0);
            $table->float('parcela_atual')->nullable();
            $table->float('parcela_total')->nullable();
            $table->date('vence_em');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('despesas');
    }
}
