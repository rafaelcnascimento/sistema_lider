<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entrada;
use App\Produto;

class EntradaController extends Controller
{
    public function index()
    {
        $entradas = Entrada::paginate(50);

        return view('entrada.listar', compact('entradas'));
    }

    public function create()
    {
        $produtos = Produto::orderBy('nome','asc')->get();

        return view('entrada.novo', compact('produtos'));
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

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Entrada adicionada com sucesso');

        return redirect('/entrada-listar');
    }

    public function update(Entrada $entrada, Request $request)
    {
        $request->validate([
            'nome' => 'required|regex:/^[\pL\s\-]+$/u|max:255',      
            'endereco' => 'nullable|string|max:255',
        ]);

        $entrada->update(request()->all());

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Entrada modificada com sucesso');

        return redirect('/entrada-nova');
    }

    public function delete(Entrada $entrada, Request $request)
    {
        $entrada->delete();

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Entrada removido com sucesso');

        return redirect('/entrada-listar');
    }
}
