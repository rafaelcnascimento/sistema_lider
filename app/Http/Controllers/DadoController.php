<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Pedido;
use App\Orcamento;
use App\Produto;
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

        return view('info.hub', compact('passivo','estoque_custo','itens'));
    }
}
