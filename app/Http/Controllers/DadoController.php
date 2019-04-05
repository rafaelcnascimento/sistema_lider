<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Pedido;
use App\Orcamento;
use App\Produto;
use App\Vendas;
use App\Cliente;
use App\Pagamento;
use App\Despesa;

class DadoController extends Controller
{
    public function index()
    {
        $passivo = Despesa::where('pago','0')->sum('valor') - Despesa::where('pago','0')->sum('valor_pago');

        $itens = Produto::count();

        $estoque_custo =  Produto::all()->sum(function($t){ 
                    return abs($t->quantidade) * $t->custo_inicial; 
        });

        $estoque_venda =  Produto::all()->sum(function($t){ 
                    return abs($t->quantidade) * $t->preco; 
        });

        $balanco = $estoque_venda - $passivo;

        // $mais_vendidos =  Vendas::orderByRaw('SUM(quantidade) DESC')->groupBy('produto_id')->get();

        $mais_vendidos = DB::select( DB::raw('
                            SELECT v.produto_id, p.nome, SUM(v.quantidade) AS quantidade
                            FROM pedido_produto v, produtos p
                            WHERE v.produto_id = p.id
                            GROUP BY produto_id
                            ORDER BY SUM(v.quantidade) DESC
                            LIMIT 5'));

        return view('info.hub', compact('passivo','estoque_custo','itens','estoque_venda','balanco','mais_vendidos'));
    }
}
