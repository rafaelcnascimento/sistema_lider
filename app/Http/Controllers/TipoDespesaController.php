<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TipoDespesa;

class TipoDespesaController extends Controller
{
    public function index()
    {
        $tipoDespesas = TipoDespesa::orderBy('nome','asc')->paginate(50);

        return view('tipoDespesa.listar', compact('tipoDespesas'));
    }

    public function create()
    {
        return view('tipoDespesa.nova');
    }

    public function show(TipoDespesa $tipoDespesa)
    {
        return view('tipoDespesa.editar', compact('tipoDespesa','produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:tipo_despesas|max:255',      
        ]);

        TipoDespesa::create(request()->all());

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Tipo de Despesa dicionada com sucesso');

        return redirect('/tipoDespesa-listar');
    }

    public function update(TipoDespesa $tipoDespesa, Request $request)
    {
        $request->validate([
           'nome' => 'required|max:255|unique:tipo_despesas,id,'.$tipoDespesa->id,      
        ]);

        $tipoDespesa->update(request()->all());

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'TipoDespesa modificada com sucesso');

        return redirect('/tipoDespesa/'.$tipoDespesa->id);
    }

    public function delete(TipoDespesa $tipoDespesa, Request $request)
    {
        $tipoDespesa->delete();

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'TipoDespesa removida com sucesso');

        return redirect('/tipoDespesa-listar');
    }
}
