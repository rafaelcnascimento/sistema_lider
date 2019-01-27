<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pagamento extends Model 
{
    protected $table = 'pagamentos';
    public $timestamps = false;

    use SoftDeletes;

    protected $dates = ['deleted_at'];
}
