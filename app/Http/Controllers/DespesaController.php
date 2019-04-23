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
        
        $despesas = Despesa::orderBy('pago','asc')->orderBy('id','desc')->paginate(50);

        return view('despesa.listar', compact('despesas','anos'));
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

    public function proximas()
    {
    	$hoje = Arquivo::where('vence_em', Carbon::today())->get();
        $amanha = Arquivo::where('vence_em', Carbon::tomorrow())->get();
        $semana = Arquivo::whereBetween('vence_em', [Carbon::today(),Carbon::today()->addWeek()])->get();
        $mes = Arquivo::whereRaw('MONTH(vence_em) = '.Carbon::today()->month)->get();
        
        return view('despesa.proxima', compact('hoje','amanha','semana','mes'));
    }

    public function showArquivo(Arquivo $arquivo)
    {
        $pdf = base64_decode($arquivo->pdf);    

        header('Content-type: application/pdf');
        header("Cache-Control: no-cache");
        header("Pragma: no-cache");
        header("Content-length: ".strlen($pdf));
        exit($pdf);
    }

    public function store(Request $request)
    {
        // $request->validate([
        //     'arquivo.*' => 'mimes:pdf|max:10000|required_with:vence_em',
        //     'vence_em' => 'required_with:arquivo'
        // ]);

        //dd($request->file('arquivo'));

        $despesa = Despesa::create(request()->except('arquivo','vence_em'));
        
        if ($request->pago) { $despesa->valor_pago = $despesa->valor; $despesa->save(); }
        if ($request->file('arquivo'))
        { 
            for ($i=0; $i < count($request->arquivo); $i++) 
            {
                $pdf = file_get_contents($request->file('arquivo')[$i]); 
                $pdf = base64_encode($pdf);
                
                Arquivo::create([
                    'despesa_id' => $despesa->id,
                    'pdf' => $pdf,
                    'vence_em' => $request->vence_em[$i]
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
