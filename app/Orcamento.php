<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model 
{
    protected $table = 'orcamentos';
    public $timestamps = false;
    protected $guarded = [];
    
    public function cliente()
    {
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }
    
    public function pagamento()
    {
        return $this->belongsTo('App\pagamento', 'pagamento_id');
    }
    
    public function produtos()
    {
        return $this->belongsToMany('App\Produto', 'orcamento_produto', 'orcamento_id', 'produto_id')->withPivot('preco_unitario', 'quantidade','preco_total');
    }
}
