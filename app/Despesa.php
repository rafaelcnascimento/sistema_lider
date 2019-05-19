<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Despesa extends Model
{
    use SoftDeletes;
    public $guarded = [];

    public function tipo()
    {
        return $this->belongsTo('App\TipoDespesa', 'tipo_despesa_id');
    }

    public function pagamento()
    {
        return $this->belongsTo('App\Pagamento', 'pagamento_id');
    }

    public function getCreatedAtAttribute($value) 
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }

    public function ano()
    {
        return substr($this->created_at, 6, 4);
    }
}
