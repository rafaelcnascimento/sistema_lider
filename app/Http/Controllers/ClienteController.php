<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Pedido;


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
        $pedidos = Pedido::where('cliente_id',$cliente->id)->orderBy('pago','asc')->orderBy('id','dsc')->paginate(25);

        $valor_pago = $cliente->pedidos->where('pago','1')->sum('valor');

        $valor_devido = $cliente->pedidos->where('pago','0')->sum('valor');

        return view('cliente.editar', compact('cliente','pedidos','valor_pago','valor_devido'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|regex:/^[\pL\s\-]+$/u|max:255',
            'saldo' => 'numeric'      
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
            'saldo' => 'numeric'      
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

    public function clientesAjax()
    {
        $clientes = Cliente::orderBy('nome','asc')->paginate(50);

        $output = '<option value="" >Nenhum Cliente</option>';
        
        foreach ($clientes as $cliente) 
        {
            $output.= '<option value="'.$cliente->id.'">'.$cliente->nome.'</option>';
        }

        return Response($output);
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
                '<td><a href="cliente/'.$cliente->id.'">'.$cliente->nome.'</a></td>'.
                '<td>'.$cliente->telefone.'</td>'.
                '<td>'.$cliente->documento.'</td>'.
                '<td>'.$cliente->logradouro.' '.$cliente->numero.'</td>'.
                '</tr>';
            }
            return Response($output);
        }
    }
}
