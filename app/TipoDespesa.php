<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDespesa extends Model
{
    public $timestamps = false;
    public $guarded = [];
    protected $table = 'tipo_despesas';
}
