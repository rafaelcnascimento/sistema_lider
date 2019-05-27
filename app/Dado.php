<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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

class Dado extends Model
{
    public $guarded = [];
    public $timestamps = false;

    public static function estoque_custo()
    {
        $estoque_custo =  Produto::all()->sum(function($t){ 
            return abs($t->quantidade) * $t->custo_final; 
        });

        return $estoque_custo;
    }

    public static function estoque_venda()
    {
        $estoque_venda =  Produto::all()->sum(function($t){ 
            return abs($t->quantidade) * $t->preco; 
        });

        return $estoque_venda;
    }

    public static function passivo()
    {
        $passivo = Despesa::where('pago','0')->sum('valor') - Despesa::where('pago','0')->sum('valor_pago');

        return $passivo;
    }

    public static function mais_vendidos()
    {
        $mais_vendidos = DB::select( DB::raw('
                            SELECT v.produto_id, p.nome, SUM(v.quantidade) AS quantidade
                            FROM pedido_produto v, produtos p
                            WHERE v.produto_id = p.id
                            GROUP BY produto_id
                            ORDER BY SUM(v.quantidade) DESC
                            LIMIT 5'));

        return $mais_vendidos;
    }

    public static function despesa_total_mes($mes,$ano)
    {
        $despesa_total_mes = Despesa::whereRaw('MONTH(created_at) = '.$mes)->whereRaw('YEAR(created_at) = '.$ano)->sum('valor');
        
        return $despesa_total_mes;
    }

    public static function despesa_paga_mes($mes,$ano)
    {
        $despesa_paga_mes = Despesa::where('pago','1')->whereRaw('MONTH(created_at) = '.$mes)->whereRaw('YEAR(created_at) = '.$ano)->sum('valor');
        
        return $despesa_paga_mes;
    }

    public static function despesa_aberta_mes($mes,$ano)
    {
       $despesa_aberta_mes = Despesa::where('pago','0')->whereRaw('MONTH(created_at) = '.$mes)->whereRaw('YEAR(created_at) = '.$ano)->sum('valor');
               
        return $despesa_aberta_mes;
    }

    public static function venda_total_mes($mes,$ano)
    {
       $venda_total_mes = Pedido::whereRaw('MONTH(created_at) = '.$mes)->whereRaw('YEAR(created_at) = '.$ano)->sum('valor');
               
        return $venda_total_mes;
    }

    public static function venda_paga_mes($mes,$ano)
    {
       $venda_paga_mes = Pedido::where('pago','1')->whereRaw('MONTH(created_at) = '.$mes)->whereRaw('YEAR(created_at) = '.$ano)->sum('valor_pago');
               
        return $venda_paga_mes;
    }

    public static function venda_aberta_mes($mes,$ano)
    {
       $vam_pago = Pedido::where('pago','0')->whereRaw('MONTH(created_at) = '.$mes)->whereRaw('YEAR(created_at) = '.$ano)->sum('valor');
       $vam_npago = Pedido::where('pago','0')->whereRaw('MONTH(created_at) = '.$mes)->whereRaw('YEAR(created_at) = '.$ano)->sum('valor_pago');
       
       $venda_aberta_mes = $vam_pago - $vam_npago;
               
        return $venda_aberta_mes;
    }

    public static function despesa_total_ano($ano)
    {
        $despesa_total_ano = Despesa::whereRaw('YEAR(created_at) = '.$ano)->sum('valor');
        
        return $despesa_total_ano;
    }

    public static function despesa_paga_ano($ano)
    {
        $despesa_paga_ano = Despesa::where('pago','1')->whereRaw('YEAR(created_at) = '.$ano)->sum('valor');
        
        return $despesa_paga_ano;
    }

    public static function despesa_aberta_ano($ano)
    {
       $despesa_aberta_ano = Despesa::where('pago','0')->whereRaw('YEAR(created_at) = '.$ano)->sum('valor');
               
        return $despesa_aberta_ano;
    }

    public static function venda_total_ano($ano)
    {
       $venda_total_ano = Pedido::whereRaw('YEAR(created_at) = '.$ano)->sum('valor');
               
        return $venda_total_ano;
    }

    public static function venda_paga_ano($ano)
    {
       $venda_paga_ano = Pedido::where('pago','1')->whereRaw('YEAR(created_at) = '.$ano)->sum('valor_pago');
               
        return $venda_paga_ano;
    }

    public static function venda_aberta_ano($ano)
    {
       $vam_pago = Pedido::where('pago','0')->whereRaw('YEAR(created_at) = '.$ano)->sum('valor');
       $vam_npago = Pedido::where('pago','0')->whereRaw('YEAR(created_at) = '.$ano)->sum('valor_pago');
       
       $venda_aberta_ano = $vam_pago - $vam_npago;
               
        return $venda_aberta_ano;
    }

    public static function meses()
    {
        $meses = [
            ['nome' => 'Janeiro', 'num' => 1],
            ['nome' => 'Fevereiro', 'num' => 2],
            ['nome' => 'Março', 'num' => 3],
            ['nome' => 'Abril', 'num' => 4],
            ['nome' => 'Maio', 'num' => 5],
            ['nome' => 'Junho', 'num' => 6],
            ['nome' => 'Julho', 'num' => 7],
            ['nome' => 'Agosto', 'num' => 8],
            ['nome' => 'Setembro', 'num' => 9],
            ['nome' => 'Outubro', 'num' => 10],
            ['nome' => 'Novembro', 'num' => 11],
            ['nome' => 'Dezembro', 'num' => 12]
        ];

        return $meses;
    }

    public static function colorir($qtd)
    {
        $cores = array();

        for ($i=1; $i <= $qtd; $i++) 
        { 
            switch ($i) {
                case $i%3==0:
                    array_push($cores,'green');
                    break;
                case $i%2==0:
                    array_push($cores,'blue');
                    break;
                default:
                    array_push($cores,'teal');
                    break;
            }
        }
        return $cores;
    }
}
