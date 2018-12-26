<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Imports\ProdutosImport;
use Maatwebsite\Excel\Facades\Excel;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produto::paginate(50);

        return view('produtos', compact('produtos'));
    }

    public function busca(Request $request)
    {
        $output="";
       
        $produtos = new Produto;

        if (!$request->search) 
        {
            $produtos = Produto::paginate(50);
        } 
        else
        {
            $produtos = Produto::where('nome', 'LIKE', "%{$request->search}%")
                                    ->orWhere('codigo', 'LIKE', "%{$request->search}%")->get();
        }
 
        if ($produtos) {
            foreach ($produtos as $produto) {
                $output.='<tr>'.
                '<td>'.$produto->id.'</td>'.
                '<td>'.$produto->nome.'</td>'.
                '<td>'.$produto->quantidade.'</td>'.
                '<td>'.$produto->unidade->nome.'</td>'.
                '<td>'.$produto->fornecedor->nome.'</td>'.
                '<td>R$ '.number_format($produto->custo_inicial,2,',','.').'</td>'.
                '<td>'.$produto->ipi.'%</td>'.
                '<td>'.$produto->icms.'%</td>'.
                '<td>'.$produto->frete.'%</td>'.
                '<td>R$ '.number_format($produto->custo_unitario,2,',','.').'</td>'.
                '<td>'.$produto->margem.'%</td>'.
                '<td>R$ '.number_format($produto->custo_final,2,',','.').'</td>'.
                '<td>R$ '.number_format($produto->preco,2,',','.').'</td>'.
                '</tr>';
            }
            return Response($output);
        }
    }


    public function import() 
    {
        Excel::import(new ProdutosImport, 'public/produtos.xlsx');
        
        return redirect('/')->with('success', 'All good!');
    }
}
