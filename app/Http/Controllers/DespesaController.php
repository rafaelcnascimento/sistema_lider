<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Despesa;
use App\TipoDespesa;
use App\Pedido;
use App\Orcamento;
use App\Produto;
use App\Cliente;
use App\Pagamento;

class DespesaController extends Controller
{
    public function index()
    {
        $despesas = Despesa::orderBy('id','dsc')->paginate(50);

        return view('despesa.listar', compact('despesas'));
    }

    public function create()
    {
        $tipos = TipoDespesa::orderBy('id','asc')->get();

        return view('despesa.nova', compact('tipos'));
    }

    public function show(Despesa $despesa)
    {
        $tipos = TipoDespesa::orderBy('id','asc')->get();

        return view('despesa.editar', compact('despesa','produtos'));
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'nome' => 'required|unique:despesas|max:255',      
        // ]);

        Despesa::create(request()->all());

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Despesa adicionada com sucesso');

        return redirect('/despesa-listar');
    }

    public function update(Despesa $despesa, Request $request)
    {
        $despesa->update(request()->all());

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Despesa modificada com sucesso');

        return redirect('/despesa/'.$despesa->id);
    }

    public function delete(Despesa $despesa, Request $request)
    {
        $despesa->delete();

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Despesa removida com sucesso');

        return redirect('/despesa-listar');
    }
}
