<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produto extends Model 
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'produtos';
    public $timestamps = false;
    protected $guarded = [];

    public function fornecedor()
    {
        return $this->belongsTo('App\Fornecedor', 'fornecedor_id');
    }

    public function unidade()
    {
        return $this->belongsTo('App\Unidade', 'unidade_id');
    }

    public function pedidos()
    {
        return $this->belongsToMany('App\Pedido', 'pedido_produto', 'pedido_id', 'produto_id')->withPivot('preco_unitario', 'quantidade','preco_total');
    }

    public function orcamentos()
    {
        return $this->belongsToMany('App\Orcamento', 'pedido_produto', 'pedido_id', 'produto_id')->withPivot('preco_unitario', 'quantidade','preco_total');
    }

    public function getFornecedorNome()
    {
        if ($this->fornecedor) 
        {
            return $this->fornecedor->nome;
        } 
        else
        {
            return ' ';
        }
    }

    public function getFornecedorId()
    {
        if ($this->fornecedor) 
        {
            return $this->fornecedor->id;
        } 
        else
        {
            return ' ';
        }
    }

}
