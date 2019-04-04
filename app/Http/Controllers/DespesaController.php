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
        $despesas = Despesa::orderBy('pago','asc')->orderBy('id','desc')->paginate(50);

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

        return view('despesa.editar', compact('despesa','tipos'));
    }

    public function showArquivo(Despesa $despesa)
    {
        $pdf = $despesa->arquivo;      

        header('Content-type: application/pdf');
        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
        header("Content-length: ".strlen($pdf));
        die($pdf);
    }

    public function store(Request $request)
    {
        $request->validate([
            'arquivo.*' => 'mimes:pdf|max:10000',
        ]);

        $despesa = Despesa::create(request()->except('arquivo'));
        
        if ($request->pago) { $despesa->valor_pago = $despesa->valor; $despesa->save(); }
        if ($request->file('arquivo')) { $despesa->arquivo = file_get_contents($request->file('arquivo')); $despesa->save(); }

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

    public function pago(Request $request)
    {
        $despesa = Despesa::find($request->id);
        $despesa->pago = 1;
        $despesa->valor_pago = $despesa->valor;
        $despesa->save();

        $output = 'Pago <i id="despagar'.$despesa->id.'" class="fas fa-times"></i>';

        return Response($output);   
    }

    public function naoPago(Request $request)
    {
        $despesa = Despesa::find($request->id);
        $despesa->pago = 0;
        $despesa->valor_pago = 0;
        $despesa->save();

        $output = ' Não Pago <i id="pagar'.$despesa->id.'" class="fas fa-check"></i>';

        return Response($output);   
    }

}
