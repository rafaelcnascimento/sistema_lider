<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model 
{

    protected $table = 'pedidos';
    public $timestamps = true;

    public function cliente()
    {
        return $this->belongsTo('Cliente', 'cliente_id');
    }

    public function produtos()
    {
        return $this->belongsToMany('Produto', 'pedido_produto', 'pedido_id', 'produto_id')->withPivot('quantidade','preco');
    }

}
