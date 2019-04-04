<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    protected $table = 'pedido_produto';

    public function produtos() 
    {
        return $this->hasMany('App\Produto','produto_id');
    }
}
