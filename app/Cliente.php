<?php

namespace App;

use App\Cliente;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model 
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public $guarded = [];
    protected $table = 'clientes';
    public $timestamps = false;

    public function pedidos()
    {
        return $this->hasMany('App\Pedido','cliente_id');
    }

    public static function saldo($id, $valor)
    {
    	$cliente = Cliente::find($id);

        if ($valor > $cliente->saldo)
        {
    		$cliente->saldo = 0;
    	}
        else
        {
            $cliente->saldo -= $valor;
        }

        $cliente->save();
    }

}
