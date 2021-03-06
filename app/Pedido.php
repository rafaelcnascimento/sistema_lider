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
        return $this->belongsTo('App\Cliente', 'cliente_id');
    }

    public function pagamento()
    {
        return $this->belongsTo('App\Pagamento', 'pagamento_id');
    }

    public function produtos()
    {
        return $this->belongsToMany('App\Produto', 'pedido_produto', 'pedido_id', 'produto_id')->withPivot('preco_unitario', 'quantidade','preco_total');
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
