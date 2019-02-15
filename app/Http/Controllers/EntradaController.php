<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entrada;
use App\Produto;

class EntradaController extends Controller
{
    public function index()
    {
        $entradas = Entrada::orderBy('id','dsc')->paginate(50);

        return view('entrada.listar', compact('entradas'));
    }

    public function create()
    {
        $produtos = Produto::orderBy('nome','asc')->get();

        return view('entrada.nova', compact('produtos'));
    }

    public function show(Entrada $entrada)
    {
        return view('entrada.editar', compact('entrada'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produto_id' => 'required',      
            'quantidade' => 'required',
            'custo' => 'required',
        ]);

        Entrada::create(request()->all());

        $produto = Produto::find($request->produto_id);
        $produto->quantidade += $request->quantidade;
        $produto->save();

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Entrada adicionada com sucesso');

        return redirect('/entrada-nova');
    }

    public function update(Entrada $entrada, Request $request)
    {
        $request->validate([    
            'quantidade' => 'required',
            'custo' => 'required',
        ]);

        //Modificar quantidade modificada

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Entrada modificada com sucesso');

        return redirect('/entrada/'.$entrada->id);
    }

    public function delete(Entrada $entrada, Request $request)
    {
        $produto = Produto::find($entrada->produto_id);
        $produto->quantidade -= $entrada->quantidade;
        
        $produto->save();

        $entrada->delete();

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Entrada removido com sucesso');

        return redirect('/entrada-listar');
    }

    public function busca(Request $request)
    {
        $output="";
       
        $entradas = new Entrada;

        if (!$request->search) 
        {
            $entradas = Entrada::orderBy('nome','asc')->paginate(50);
        } 
        else
        {
            // Buscar por data
            //$entradas = Entrada::where($entrada->produto->nome, 'LIKE', "%{$request->search}%")->get();
            
        }
    
        if ($entradas) {
            foreach ($entradas as $entrada) {
                $output.='<tr>'.
                '<td>'.$entrada->produto->nome.'</td>'.
                '<td>'.$entrada->quantidade.'</td>'.
                '<td>'.$entrada->custo.'</td>'.
                '<td>'.$entrada->created_at.'</td>'.
                '<td>
                    <a href="entrada/'.$entrada->id.'">
                        <button type="submit" class="btn btn-primary custom-btn">
                            Editar
                        </button>
                        </a>
                </td>    '.
                '</tr>';
            }
            return Response($output);
        }
    }
}
