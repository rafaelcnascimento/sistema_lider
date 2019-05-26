<?php

namespace App\Imports;

use App\Cliente;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class ClientesImport implements ToModel, WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $telefone;
    public $celular;

    public function model(array $row)
    {
        $telefone = ltrim($row[2], '+55');
        $celular = ltrim($row[3], '+55');

        Cliente::create([
            'nome'     => $row[1],
            'telefone' => $telefone,
            'celular' => $celular      
        ]);
    }
}
