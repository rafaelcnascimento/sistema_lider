<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::orderBy('nome','asc')->paginate(50);

        return view('cliente.listar', compact('clientes'));
    }

    public function create()
    {
        return view('cliente.novo');
    }

    public function show(Cliente $cliente)
    {
        return view('cliente.editar', compact('cliente'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|regex:/^[\pL\s\-]+$/u|max:255',      
        ]);

        Cliente::create(request()->all());

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Cliente adicionado com sucesso');

        return redirect('/cliente-listar');
    }

    public function update(Cliente $cliente, Request $request)
    {
        $request->validate([
            'nome' => 'required|regex:/^[\pL\s\-]+$/u|max:255',      
        ]);

        $cliente->update(request()->all());

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Cliente modificado com sucesso');

        return redirect('/cliente/'.$cliente->id);
    }

    public function delete(Cliente $cliente, Request $request)
    {
        $cliente->delete();

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Cliente removido com sucesso');

        return redirect('/cliente-listar');
    }

    public function busca(Request $request)
    {
        $output="";
       
        $clientes = new Cliente;

        if (!$request->search) 
        {
            $clientes = Cliente::orderBy('nome','asc')->paginate(50);
        } 
        else
        {
            $clientes = Cliente::where('nome', 'LIKE', "%{$request->search}%")->get();
        }
 
        if ($clientes) {
            foreach ($clientes as $cliente) {
                $output.='<tr>'.
                '<td>'.$cliente->nome.'</td>'.
                '<td>'.$cliente->telefone.'</td>'.
                '<td>'.$cliente->documento.'</td>'.
                '<td>'.$cliente->logradouro. $cliente->numero.'</td>'.
                '<td>
                    <a href="cliente/'.$cliente->id.'">
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
