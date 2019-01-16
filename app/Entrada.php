<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
