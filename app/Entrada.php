<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Entrada;
use App\Produto;

class Entrada extends Model 
{
    protected $table = 'entradas';
    public $timestamps = true;
    protected $guarded = [];

    public function getCreatedAtAttribute($value) {
        return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'produto_id');
    }
}
