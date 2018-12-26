<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Produto extends Model 
{

    protected $table = 'produtos';
    public $timestamps = false;
    protected $guarded = array('codigo');

    public function fornecedor()
    {
        return $this->belongsTo('App\Fornecedor', 'fornecedor_id');
    }

    public function unidade()
    {
        return $this->belongsTo('App\Unidade', 'unidade_id');
    }

}
