<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Unidade;
use App\Fornecedor;
use App\Imports\ProdutosImport;
use Maatwebsite\Excel\Facades\Excel;

class ProdutosController extends Controller
{
    public function index()
    {
        $produtos = Produto::orderBy('nome','asc')->paginate(50);

        return view('produto.listar', compact('produtos'));
    }
    public function create()
    {
        $fornecedores = Fornecedor::where('id','>','1')->orderBy('nome','asc')->get();

        $unidades = Unidade::orderBy('nome','asc')->get();

        return view('produto.novo', compact('fornecedores','unidades'));
    }

    public function show(Produto $produto)
    {
        return view('produto.editar', compact('produto'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|regex:/^[\pL\s\-]+$/u|max:255',      
            'endereco' => 'nullable|string|max:255',
            'codigo' => 'nullable|numeric|unique:produtos',
            'unidade_id' => 'required|numeric',
            'fornecedor_id' => 'nullable|numeric',
            'quantidade' => 'nullable|numeric',
            'estoque_baixo' => 'nullable|numeric',
            'custo_inicial' => 'nullable|numeric',
            'ipi' => 'nullable|numeric',
            'icms' => 'nullable|numeric',
            'frete' => 'nullable|numeric',
            'custo_unitario' => 'nullable|numeric',
            'margem' => 'nullable|numeric',
            'custo_final' => 'nullable|numeric',
            'preco' => 'required|numeric',
        ]);

        // Produto::create(request()->all());

        // $request->session()->flash('message.level', 'success');
        // $request->session()->flash('message.content', 'Produto adicionado com sucesso');

        // return redirect('/produto-listar');
    }

    public function update(Produto $produto, Request $request)
    {
        $request->validate([
            'nome' => 'required|regex:/^[\pL\s\-]+$/u|max:255',      
            'endereco' => 'nullable|string|max:255',
        ]);

        $produto->update(request()->all());

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Produto modificado com sucesso');

        return redirect('/produto/'.$produto->id);
    }

    public function delete(Produto $produto, Request $request)
    {
        $produto->delete();

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Produto removido com sucesso');

        return redirect('/produto-listar');
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
                '<td>
                    <a href="fornecedor/'.$produto->getFornecedorId().'"target="_blank">'.$produto->getFornecedorNome().'</a>
                </td>'.
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
