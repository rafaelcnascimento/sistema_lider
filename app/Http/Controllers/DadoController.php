<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Date;
use App\Pedido;
use App\Orcamento;
use App\Produto;
use App\Vendas;
use App\Cliente;
use App\Pagamento;
use App\Despesa;
use App\Dado;

class DadoController extends Controller
{
    public function show()
    {
        $dados = Dado::find(1);

        return view('dados.editar', compact('dados'));
    }

    public function update(Dado $dado,Request $request)
    {
        $dado->update(request()->all());

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Dados modificados com sucesso');

        return redirect('/painel/dados');
    }

    public function index()
    {
        //Infos
        $mes = Date::now()->format('m');
        $ano = Date::now()->format('Y');
        // Geral
        $passivo = Despesa::where('pago','0')->sum('valor') - Despesa::where('pago','0')->sum('valor_pago');
        $itens = Produto::count();
        $estoque_custo = Dado::estoque_custo();
        $estoque_venda =  Dado::estoque_venda();
        $mais_vendidos = Dado::mais_vendidos();
        $balanco = $estoque_venda - $passivo;

        // MES MES MES MES
        $despesa_total_mes = Dado::despesa_total_mes($mes,$ano);
        $despesa_paga_mes = Dado::despesa_paga_mes($mes,$ano);
        $despesa_aberta_mes = Dado::despesa_aberta_mes($mes,$ano);
        
        $venda_total_mes = Dado::venda_total_mes($mes,$ano);
        $venda_paga_mes = Dado::venda_paga_mes($mes,$ano);
        $venda_aberta_mes = Dado::venda_aberta_mes($mes,$ano);
        
        $balanco_total_mes = $venda_total_mes - $despesa_total_mes;
        $balanco_pago_mes = $venda_paga_mes - $despesa_paga_mes;
        $balanco_aberto_mes = $venda_aberta_mes - $despesa_aberta_mes;

        // ANO ANO ANO ANO 
        $despesa_total_ano = Dado::despesa_total_ano($ano);
        $despesa_paga_ano = Dado::despesa_paga_ano($ano);
        $despesa_aberta_ano = Dado::despesa_aberta_ano($ano);

        $venda_total_ano = Dado::venda_total_ano($ano);
        $venda_paga_ano = Dado::venda_paga_ano($ano);
        $venda_aberta_ano = Dado::venda_aberta_ano($ano);

        $balanco_total_ano = $venda_total_ano - $despesa_total_ano;
        $balanco_pago_ano = $venda_paga_ano - $despesa_paga_ano;
        $balanco_aberto_ano = $venda_aberta_ano - $despesa_aberta_ano;

        return view('info.hub', compact('passivo','estoque_custo','itens','estoque_venda','balanco','mais_vendidos',
                                'despesa_total_mes','despesa_paga_mes','despesa_aberta_mes',
                                'venda_total_mes','venda_paga_mes','venda_aberta_mes',
                                'balanco_total_mes','balanco_pago_mes','balanco_aberto_mes',
                                'despesa_total_ano','despesa_paga_ano','despesa_aberta_ano',
                                'venda_total_ano','venda_paga_ano','venda_aberta_ano',
                                'balanco_total_ano','balanco_pago_ano','balanco_aberto_ano'));
    }

    public function importacao()
    { 
        return view('info.importar');
    }
}
