<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;


class Produto extends Model 
{
    use SoftDeletes;
    use Searchable;

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
