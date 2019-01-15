<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fornecedor extends Model 
{
    use SoftDeletes;

    protected $table = 'fornecedores';
    protected $dates = ['deleted_at'];
    public $timestamps = false;
    public $guarded = [];

    public function getFone($numero_telefone) 
    {
        if (!$numero_telefone) {
            return false;
        }

        if (strlen($numero_telefone) == 11) 
        {
            $numero_telefone = substr_replace($numero_telefone, '(', 0, 0);
            $numero_telefone = substr_replace($numero_telefone, ') ', 3, 0);
            $numero_telefone = substr_replace($numero_telefone, '-', 10, 0);
        } 
        else 
        {
            $numero_telefone = substr_replace($numero_telefone, '(', 0, 0);
            $numero_telefone = substr_replace($numero_telefone, ') ', 3, 0);
            $numero_telefone = substr_replace($numero_telefone, '-', 9, 0);
        }

        return $numero_telefone;
    }

}
