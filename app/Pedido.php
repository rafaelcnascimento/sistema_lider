<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pedido extends Model 
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public $guarded = [];
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
