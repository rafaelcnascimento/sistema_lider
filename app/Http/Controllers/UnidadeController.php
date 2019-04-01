<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Unidade;
use App\Produto;

class UnidadeController extends Controller
{
    public function index()
    {
        $unidades = Unidade::orderBy('nome','asc')->paginate(50);

        return view('unidade.listar', compact('unidades'));
    }

    public function create()
    {
        return view('unidade.novo');
    }

    public function show(Unidade $unidade)
    {
        $produtos = Produto::where('unidade_id',$unidade->id)->paginate(50);

        return view('unidade.editar', compact('unidade','produtos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|unique:unidades|max:255',      
        ]);

        Unidade::create(request()->all());

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Unidade adicionada com sucesso');

        return redirect('/unidade-listar');
    }

    public function update(Unidade $unidade, Request $request)
    {
        $request->validate([
           'nome' => 'required|unique:unidades|max:255',      
        ]);

        $unidade->update(request()->all());

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Unidade modificada com sucesso');

        return redirect('/unidade/'.$unidade->id);
    }

    public function delete(Unidade $unidade, Request $request)
    {
        $unidade->delete();

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Unidade removida com sucesso');

        return redirect('/unidade-listar');
    }
}
