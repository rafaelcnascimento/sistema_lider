<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unidade extends Model 
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    public $guarded = [];
    protected $table = 'unidades';
    public $timestamps = false;

}


