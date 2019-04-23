<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    public $guarded = [];
    public $timestamps = false;

    public function despesa()
    {
        return $this->belongsTo('App\Despesa', 'despesa_id');
    }

    public function getVenceEmAttribute($value) 
    {
        return \Carbon\Carbon::parse($value)->format('d/m/Y');
    }
}
