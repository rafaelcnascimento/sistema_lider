<?php

namespace App\Imports;

use App\Produto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;

class ProdutosImport implements ToModel, WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $fornecedor;
    public $unidade;

    public function model(array $row)
    {
        switch ($row[0]) {
            case 'Acasel':
                $fornecedor = 1;
                break;
            case 'Bigfer':
                $fornecedor = 2;
                break;
            case 'Diferpan':
                $fornecedor = 3;
                break;
            case 'Internet':
                $fornecedor = 4;
                break;    
            case 'Negrão':
                $fornecedor = 5;
                break;
            case 'Alternativa':
                $fornecedor = 6;
                break;        
            case 'Chapecomp':
                $fornecedor = 7;
                break;
            case 'Ciser':
                $fornecedor = 8;
                break;
            case 'Criativa':
                $fornecedor = 9;
                break;
            case 'Dimerc':
                $fornecedor = 10;
                break;
            case 'Geração':
                $fornecedor = 11;
                break;
            case 'Ideal Pack':
                $fornecedor = 12;
                break;
            case 'Jomarca':
                $fornecedor = 13;
                break;
            case 'L. Mecânico':
                $fornecedor = 14;
                break;   
            case 'Rumatari':
                $fornecedor = 15;
                break;
            case 'Security':
                $fornecedor = 16;
                break;
            case 'Soprano':
                $fornecedor = 17;
                break;
            case 'Zimermaq':
                $fornecedor = 18;
                break;
            default:
                $fornecedor = null;
                break;
        }

        switch ($row[3]) {
            case 'Barra':
                $unidade = 1;
                break;
            case 'Bisnaga':
                $unidade = 2;
                break;
            case 'Caixinha':
                $unidade = 3;
                break;
            case 'Cartela':
                $unidade = 4;
                break;    
            case 'Chapa':
                $unidade = 5;
                break;
            case 'Galão':
                $unidade = 6;
                break;        
            case 'Jogo':
                $unidade = 7;
                break;
            case 'Kg':
                $unidade = 8;
                break;
            case 'Lata':
                $unidade = 9;
                break;
            case 'm²':
                $unidade = 10;
                break;
            case 'Metro':
                $unidade = 11;
                break;
            case 'Par':
                $unidade = 12;
                break;
            case 'Rolo':
                $unidade = 13;
                break;
            case 'Unidade':
                $unidade = 14;
                break;    
            default:
                $unidade = null;
                break;
        }

        if (!$unidade) 
        {
        } 
        else 
        {
            $produto = Produto::where('nome',$row[2])->first();

            if ($produto)
            {
               $produto->update([
                    'nome' => $row[2].' '.$row[1],
                    'custo_inicial' => $row[5],
                    'ipi' => $row[6],
                    'icms' => $row[8],
                    'frete' => $row[10],
                    'custo_unitario' => $row[12],
                    'margem' => $row[14],
                    'custo_final' => $row[16],
                    'preco' => $row[17],                       
                ]);
            } 
            else 
            {
                new Produto([
                    'nome'     => $row[2].' '.$row[1],
                    'unidade_id'     => $unidade,
                    'fornecedor_id'  => $fornecedor,
                    'quantidade'     => $row[4],
                    'custo_inicial'     => $row[5],
                    'ipi'     => $row[6],
                    'icms'     => $row[8],
                    'frete'     => $row[10],
                    'custo_unitario' => $row[12],
                    'margem'     => $row[14],
                    'custo_final'     => $row[16],
                    'preco'     => $row[17],                       
                ]);
            }
        }
    }
}
