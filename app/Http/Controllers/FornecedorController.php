<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fornecedor;

class FornecedorController extends Controller
{
    public function index()
    {
        $fornecedores = Fornecedor::orderBy('nome','asc')->paginate(50);

        return view('fornecedor.listar', compact('fornecedores'));
    }

    public function create()
    {
        return view('fornecedor.novo');
    }

    public function show(Fornecedor $fornecedor)
    {
        return view('fornecedor.editar', compact('fornecedor'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|regex:/^[\pL\s\-]+$/u|max:255',      
            'endereco' => 'nullable|string|max:255',
        ]);

        Fornecedor::create(request()->all());

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Fornecedor adicionado com sucesso');

        return redirect('/fornecedor-listar');
    }

    public function update(Fornecedor $fornecedor, Request $request)
    {
        $request->validate([
            'nome' => 'required|regex:/^[\pL\s\-]+$/u|max:255',      
            'endereco' => 'nullable|string|max:255',
        ]);

        $fornecedor->update(request()->all());

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Fornecedor modificado com sucesso');

        return redirect('/fornecedor/'.$fornecedor->id);
    }

    public function delete(Fornecedor $fornecedor, Request $request)
    {
        $fornecedor->delete();

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Fornecedor removido com sucesso');

        return redirect('/fornecedor-listar');
    }

    public function busca(Request $request)
    {
        $output="";
       
        $fornecedores = new Fornecedor;

        if (!$request->search) 
        {
            $fornecedores = Fornecedor::orderBy('nome','asc')->paginate(50);
        } 
        else
        {
            $fornecedores = Fornecedor::where('nome', 'LIKE', "%{$request->search}%")->get();
        }
 
        if ($fornecedores) {
            foreach ($fornecedores as $fornecedor) {
                $output.='<tr>'.
                '<td>'.$fornecedor->nome.'</td>'.
                '<td>'.$fornecedor->telefone.'</td>'.
                '<td>'.$fornecedor->celular.'</td>'.
                '<td>'.$fornecedor->endereco.'</td>'.
                '<td>
                    <a href="fornecedor/'.$fornecedor->id.'">
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
