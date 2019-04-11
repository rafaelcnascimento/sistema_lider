<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Produto;
use App\Entrada;
use App\Unidade;
use App\Fornecedor;
use App\Imports\ProdutosImport;
use Maatwebsite\Excel\Facades\Excel;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::orderBy('nome','asc')->paginate(50);

        return view('produto.listar', compact('produtos'));
    }

    public function catalogo()
    {
        $produtos = Produto::orderBy('nome','asc')->paginate(50);

        return view('produto.catalogo', compact('produtos'));
    }

    public function estoqueBaixo()
    {
        $produtos = Produto::whereRaw('quantidade < estoque_baixo')->get();

        return view('produto.estoque_baixo', compact('produtos'));
    }

    public function create()
    {
        $fornecedores = Fornecedor::orderBy('nome','asc')->get();

        $unidades = Unidade::orderBy('nome','asc')->get();

        return view('produto.novo', compact('fornecedores','unidades'));
    }

    public function show(Produto $produto)
    {
        $fornecedores = Fornecedor::orderBy('nome','asc')->get();

        $unidades = Unidade::orderBy('nome','asc')->get();

        return view('produto.editar', compact('produto','fornecedores','unidades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',      
            'endereco' => 'nullable|string|max:255',
            'codigo' => 'nullable|numeric|unique:produtos',
            'unidade_id' => 'required|numeric',
            'fornecedor_id' => 'nullable|numeric',
            'quantidade' => 'nullable|required|numeric',
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

        $produto = Produto::create(request()->all());

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Produto adicionado com sucesso');

        return redirect('/produto-listar');
    }

    public function update(Produto $produto, Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',      
            'endereco' => 'nullable|string|max:255',
            'codigo' => 'nullable|numeric|unique:produtos,codigo,'.$produto->id,
            'unidade_id' => 'required|numeric',
            'fornecedor_id' => 'nullable|numeric',
            'estoque_baixo' => 'nullable|numeric',
            'custo_inicial' => 'nullable|numeric',
            'ipi' => 'nullable|numeric',
            'icms' => 'nullable|numeric',
            'frete' => 'nullable|numeric',
            'custo_unitario' => 'nullable|numeric',
            'margem' => 'nullable|numeric',
            'custo_final' => 'nullable|numeric',
            'preco' => 'required|numeric',
            'quantidade' => 'nullable|required|numeric',
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

        if (str_replace(url('/'), '', url()->previous()) == "/produto-estocador") { return redirect('/produto-estocador');}
        else { return redirect('/produto-listar');}

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
            $term = $request->search;

            $terms = explode(' ', $term);

            $produtos = Produto::
            where(function($query) use ($terms){
               foreach($terms as $term){
                   $query->where('produtos.nome', 'LIKE', '%'.$term.'%');
               }
            })
            ->orWhere(function($query) use ($terms){
               foreach($terms as $term){
                   $query->where('produtos.codigo', 'LIKE', '%'.$term.'%');
               }
            })     
            ->get();     
        }
    
        if ($produtos) {
            foreach ($produtos as $produto) {
                $output.='<tr>'.
                '<td>
                    <a href="produto/'.$produto->id.'"target="_blank">'.$produto->nome.'</a>
                </td>'.
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

    public function buscaCatalogo(Request $request)
    {
        $output="";
       
        $produtos = new Produto;

        if (!$request->search) 
        {
            $produtos = Produto::paginate(50);
        } 
        else
        {
            $term = $request->search;

            $terms = explode(' ', $term);

            $produtos = Produto::
            where(function($query) use ($terms){
                foreach($terms as $term){
                    $query->where('produtos.nome', 'LIKE', '%'.$term.'%');
                }
            })
            ->orWhere(function($query) use ($terms){
                foreach($terms as $term){
                    $query->where('produtos.codigo', 'LIKE', '%'.$term.'%');
                }
            })     
            ->get();                 
        }
    
        if ($produtos) {
            foreach ($produtos as $produto) {
                $output.='<tr>'.
                '<td>'.$produto->nome.'</td>'.
                '<td>'.$produto->unidade->nome.'</td>'.
                '<td>R$ '.number_format($produto->preco,2,',','.').'</td>'.
                '</tr>';
            }
            return Response($output);
        }
    }

    public function import(Request $request) 
    {
        Excel::import(new ProdutosImport, 'public/produtos.xlsx');
        
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Estoque importado com sucesso');

        return redirect('/painel/importar');
    }

    public function estocador()
    {
        $produtos = Produto::where('quantidade',0)->where('codigo',null)->orderBy('nome','asc')->paginate(50);

        return view('produto.estocador', compact('produtos'));
    }

    public function quantidade(Request $request)
    {
        $produto = Produto::find($request->id);

        $produto->quantidade = $request->quantidade;
        $produto->save();

        return Response("");
    }

    public function codigo(Request $request)
    {
        $produto = Produto::find($request->id);

        $produto->codigo = $request->codigo;
        $produto->save();

        return Response("");
    }

    public function estocadorBusca (Request $request)
    {
        $output="";
       
        $produtos = new Produto;

        if (!$request->search) 
        {
            $produtos = Produto::paginate(50);
        } 
        else
        {
            $term = $request->search;

            $terms = explode(' ', $term);

            $produtos = Produto::
            where(function($query) use ($terms){
                foreach($terms as $term){
                    $query->where('produtos.nome', 'LIKE', '%'.$term.'%')->where('quantidade',0)->where('codigo',null);
                }
            })
            ->orWhere(function($query) use ($terms){
                foreach($terms as $term){
                    $query->where('produtos.codigo', 'LIKE', '%'.$term.'%')->where('quantidade',0)->where('codigo',null);
                }
            })     
            ->get();                 
        }
    
        if ($produtos) {
            foreach ($produtos as $produto) {
                $output.='<tr>
                            <td><a href="/produto/'.$produto->id.'" target="_blank">'.$produto->nome.'</a></td>
                                <td style="width: 10%">
                                    <input id="quantidade'.$produto->id.'" type="text" class="form-control qtd" name="quantidade" value="'.$produto->quantidade.'">
                                </td>
                                <td>'.$produto->unidade->nome.'</td>
                                <td><a href="/fornecedor/'.$produto->getFornecedorId().'" target="_blank">'.$produto->getFornecedorNome().'</a></td>
                                <td style="width: 20%">
                                    <input id="codigo'.$produto->id.'" type="text" class="form-control cb" name="codigo" value="'.$produto->codigo.'">
                                </td>
                                <td>
                                    <form method="post" action="/produto/'.$produto->id.'" onSubmit="if(!confirm(Deletar produto?)){return false;}">
                                        <input type="hidden" name="_method" value="DELETE">
                                        '.csrf_field().'
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-danger">
                                                '. __('Deletar') .'
                                            </button>
                                        </div>   
                                    </form>   
                                </td>
                        </tr>';
            }
            return Response($output);
        }
    }

    public function entrada()
    {
        $produtos = Produto::orderBy('nome','asc')->get();

        return view('produto.entrada', compact('produtos'));
    }

    public function storeEntrada(Request $request)
    {
        for ($i=0; $i < count($request->produto_id); $i++) 
        { 
            $produto = Produto::find( $request->produto_id[$i]);
            $produto->quantidade += $request->quantidade[$i];
            $produto->save();
        }

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Entrada adicionada com sucesso');

        return redirect('/produto-entrada');
    }

    public function entradaAjax(Request $request)
    {
        $produtos = Produto::orderBy('nome','asc')->get();

        $output =   '<div class="form-group row">
                    <label for="produto_id" class="col-md-4 col-form-label text-md-right">*Produto</label>
                    <div class="col-md-6">
                    <select class="select-produto form-control" id="produto_id'.$request->num.'" name="produto_id[]" required>';
                                
        foreach ($produtos as $produto)
        {
            $output.= '<option value="'.$produto->id.'">'.$produto->codigo.' - '.$produto->nome.'</option';
        }
                           
        $output.= ' </select>'.
                    '</div>'.
                    '</div>'.
                    '<div class="form-group row">'.
                    '<label for="quantidade" class="col-md-4 col-form-label text-md-right">*Quantidade</label>'.
                    '<div class="col-md-6">'.
                    '<input id="quantidade" type="number" class="form-control" name="quantidade[]" required>'.
                    '</div>'.
                    '</div>';
        return Response($output);
    }
}

