<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Pedido;
use App\Imports\ClientesImport;
use Maatwebsite\Excel\Facades\Excel;

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
        $pedidos = Pedido::where('cliente_id',$cliente->id)->orderBy('pago','asc')->orderBy('id','desc')->paginate(25);

        $valor_pago = $cliente->pedidos->where('pago','1')->sum('valor');

        $valor_devido_total = $cliente->pedidos->where('pago','0')->sum('valor');
        $valor_devido_pago = $cliente->pedidos->where('pago','0')->sum('valor_pago');

        $valor_devido = $valor_devido_total - $valor_devido_pago;

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

    // public function saldoAjax(Request $request)
    // {
    //     $output ='';
    //     if (!$request->id) {  return Response($output); }
       
    //     $cliente = Cliente::find($request->id);
       
    //     if($cliente->saldo > 0) 
    //     {
    //         $output .= 'Saldo disponível: R$ '.$cliente->saldo.'
    //         <div class="form-check form-check-inline">
    //             <input class="form-check-input" type="checkbox" name="saldo" id="saldo" value="'.$cliente->saldo.'">
    //             <label class="form-check-label" for="saldo">Usar saldo</label>
    //         </div>';
    //     }
    //     else
    //     {
    //         $output .= '';
    //     }

    //     return Response($output);
    // }

    public function saldoAjax(Request $request)
    {
        $output;
        if (!$request->id) {  return Response($output); }
       
        $cliente = Cliente::find($request->id);
       
        if($cliente->saldo > 0) 
        {
            $output = $cliente->saldo;
        }
        else
        {
            $output = 0;
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

    public function import(Request $request) 
    {
        Excel::import(new ClientesImport, 'public/clientes.xls');
        
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Clientes importados com sucesso');

        return redirect('/painel/importar');
    }
}
