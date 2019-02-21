<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
       return $this->belongsToMany('App\Produto', 'pedido_produto', 'pedido_id', 'produto_id')->withPivot('preco_unitario', 'quantidade','preco_total');
   }
}
