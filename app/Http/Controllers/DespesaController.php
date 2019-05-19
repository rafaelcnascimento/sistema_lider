<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Despesa;
use App\TipoDespesa;
use App\Pedido;
use App\Orcamento;
use App\Produto;
use App\Cliente;
use App\Arquivo;
use App\Pagamento;

class DespesaController extends Controller
{
    public function index()
    {
        $anos = Despesa::distinct()->get([DB::raw('YEAR(created_at) as valor')]);
        
        $despesas = Despesa::orderBy('id','desc')->paginate(50);

        return view('despesa.listar', compact('despesas','anos'));
    }

    public function create()
    {
        $tipos = TipoDespesa::orderBy('id','asc')->get();

        $pagamentos = Pagamento::where('id','<>',7)->get();

        return view('despesa.nova', compact('tipos','pagamentos'));
    }

    public function show(Despesa $despesa)
    {
        $tipos = TipoDespesa::orderBy('id','asc')->get();

        return view('despesa.editar', compact('despesa','tipos'));
    }

    public function proximas()
    {
    	$hoje = Despesa::where('pago',0)->where('vence_em', Carbon::today())->get();
        $amanha = Despesa::where('pago',0)->where('vence_em', Carbon::tomorrow())->get();
        $semana = Despesa::where('pago',0)->whereBetween('vence_em', [Carbon::tomorrow(),Carbon::today()->addWeek()])->get();
        $mes = Despesa::where('pago',0)->whereBetween('vence_em', [Carbon::today()->addWeek(),Carbon::today()->addMonth()])->get();
        // $mes = Despesa::whereRaw('MONTH(vence_em) = '.Carbon::today()->month)->get();

        return view('despesa.proxima', compact('hoje','amanha','semana','mes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'vence_em' => 'required_unless:parcelado,0',
            'parcelas' => 'required_unless:parcelado,0'
        ]);        

        if ($request->parcelado == 0) 
        {
            $despesa = Despesa::create(request()->except('valor_pago','vence_em','parcelas','parcelado'));
            
            $request->pago == 1 ? $despesa->valor_pago = $request->valor : $despesa->valor_pago = $request->valor_pago;
            $request->vence_em ? $despesa->vence_em = $request->vence_em : $despesa->vence_em = Carbon::today();

            $despesa->save();
        } 
        else 
        {
            for ($i=1; $i <= $request->parcelas; $i++) 
            { 
                $despesa = Despesa::create([
                    'tipo_despesa_id' => $request->tipo_despesa_id,
                    'descricao' => $request->descricao,
                    'destinatario' => $request->destinatario,
                    'pagamento_id' => $request->pagamento_id,
                    'valor' => $request->valor / $request->parcelas,
                    'valor_pago' => 0,
                    'pago' => 0,
                    'parcela_atual' => $i,
                    'parcela_total' => $request->parcelas,
                    'vence_em' => $request->vence_em
                ]);
            }
        }
        
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

    public function filter(Request $request)
    {
        $mes = $request->mes;
        $ano = $request->ano;

        if ($request->pago == 3 ? $pago = null : $pago = $request->pago);
        
        $anos = Despesa::distinct()->get([DB::raw('YEAR(created_at) as valor')]);

        if ($mes && $ano && !is_null($pago)) 
        {
            $despesas = Despesa::whereRaw('MONTH(created_at) = '.$mes)
                ->whereRaw('YEAR(created_at) = '.$ano)
                ->where('pago',$pago)
                ->orderBy('id','desc')
                ->paginate(50);
        }

        else if ($mes && $ano) 
        {
            $despesas = Despesa::whereRaw('MONTH(created_at) = '.$mes)
                ->whereRaw('YEAR(created_at) = '.$ano)
                ->orderBy('id','desc')
                ->paginate(50);
        }

        else if ($mes && !is_null($pago)) 
        {
            $despesas = Despesa::whereRaw('MONTH(created_at) = '.$mes)
                ->where('pago',$pago)
                ->orderBy('id','desc')
                ->paginate(50);
        }

        else if ($ano && !is_null($pago)) 
        {
            $despesas = Despesa::whereRaw('YEAR(created_at) = '.$ano)
                ->where('pago',0)
                ->orderBy('id','desc')
                ->paginate(50);
        }

        else if ($mes) 
        {
            $despesas = Despesa::whereRaw('MONTH(created_at) = '.$mes)
                ->orderBy('id','desc')
                ->paginate(50);
        }

        else if ($ano) 
        {
            $despesas = Despesa::whereRaw('YEAR(created_at) = '.$ano)
                ->orderBy('id','desc')
                ->paginate(50);
        }

        else if (!$mes && !$ano && is_null($pago)) 
        {
            $despesas = Despesa::orderBy('id','desc')->paginate(50);
        }

        else 
        {
            $despesas = Despesa::where('pago',$pago)
                ->orderBy('id','desc')
                ->paginate(50);
        }

        return view('Despesa.listar', compact('despesas','anos'));
    }
}
