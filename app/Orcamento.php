<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orcamento extends Model 
{
    protected $table = 'orcamentos';
    protected $guarded = [];
    public $timestamps = false;
    
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
    
    public function getCreatedAtAttribute($value) 
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y  H:i');
    }

    public function ano()
    {
        return substr($this->created_at, 6, 4);
    }
}
