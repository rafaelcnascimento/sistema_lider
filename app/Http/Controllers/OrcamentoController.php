<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Orcamento;
use App\Produto;
use App\Cliente;
use App\Pagamento;
use Session;

class OrcamentoController extends Controller 
{
    public function store(Request $request)
    {
        if ($request->desconto ? $desconto = $request->desconto : $desconto = 0);

        $valor = $request->valor * (1 - $desconto/100);

        $orcamento = Orcamento::create([
            'valor' => $valor,
            'desconto' => $desconto,
            'cliente_id' => $request->cliente_id,
        ]);

        $items = Session::get('carrinho');
        
        foreach ($items as $item) 
        {
            $orcamento->produtos()->attach
            ($orcamento->id, ['produto_id' => $item['produtoId'], 'preco_unitario' => $item['preco'],
                'quantidade' => $item['quantidade'], 'preco_total' => $item['preco'] * $item['quantidade']]);
        }

        Session::forget('carrinho');

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Orçamento realizado com sucesso');

        return redirect('/orcamento-novo');
    }

    public function show(Orcamento $orcamento)
    {
        return view('orcamento.ver', compact('orcamento'));
    }
}
