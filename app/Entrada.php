<?php

namespace App;

use Illuminate\Http\Request;
use App\Entrada;
use App\Produto;

class Entrada extends Model 
{
    protected $table = 'entradas';
    public $timestamps = true;
    protected $guarded = [];

    public function produto()
    {
        return $this->belongsTo('App\Produto', 'produto_id');
    }
}
