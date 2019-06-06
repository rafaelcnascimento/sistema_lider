<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Pedido;
use App\Orcamento;
use App\Produto;
use App\Cliente;
use App\Pagamento;
use Session;
use Log;

class PedidoController extends Controller 
{
    public function create(Request $request)
    {
        $produtos = Produto::orderBy('nome','asc')->get();
        $pagamentos = Pagamento::all();
        $clientes = Cliente::all();
        $preco_carrinho = 0;

        if(!is_null(Session('carrinho')))
            foreach (Session('carrinho') as $key => $carrinho)
            {
               $preco_carrinho += $carrinho['preco'] * $carrinho['quantidade'];
            }

        return view('pedido.checkout', compact('produtos','pagamentos','clientes','preco_carrinho'));
    }

    public function store(Request $request)
    {
        //if ($request->$cliente_id ? $cliente_id = $request->$cliente_id : $cliente_id = null);
        switch ($request->pagamento_id) 
        {
            // A prazo,boleto e cheque
            case '2':
            case '4':
            case '5':
                $parcela_paga = 1;
                $parcela_total = 1;
                $pago = 0;
                $valor_pago = 0;
                break;

            // Parcelado
            case '7':
                $parcela_paga = 0;
                $parcela_total = $request->parcelas;
                $pago = 0;
                $valor_pago = 0;
                break;
            
            default:
                $parcela_paga = 1;
                $parcela_total = 1;
                
                if($request->saldo) { Cliente::saldo($request->cliente_id, $request->valor);}
                
                if (!$request->valor_pago) 
                {
                    $valor_pago =0;
                    $pago = 0;
                }
                //Valor pago maior
                else if($request->valor_pago >= $request->valor)
                {
                    $valor_pago = $request->valor;
                    $pago = 1;
                }
                else
                {
                    $valor_pago = $request->valor_pago;
                    $pago = 0;
                }
                break;
        }

        $items = Session::get('carrinho');

        if ($request->botao == 'orcamento')
        {
            $orcamento = Orcamento::create([
                'valor' => $request->valor,
                'cliente_id' => $request->cliente_id,
           ]);

            foreach ($items as $item) 
            {
                $orcamento->produtos()->attach
                ($orcamento->id, ['produto_id' => $item['produtoId'], 'preco_unitario' => $item['preco'],
                    'quantidade' => $item['quantidade'], 'preco_total' => $item['preco'] * $item['quantidade']]);
            }

            Session::forget('carrinho');

            return redirect('/redirect-orcamento/'.$orcamento->id.'&0');
        } 

        else 
        {
            $pedido = Pedido::create([
                'valor' => $request->valor,
                'valor_pago' => $valor_pago,
                'pago' => $pago,
                'cliente_id' => $request->cliente_id,
                'obs' => $request->obs,
                'pagamento_id' => $request->pagamento_id,
                'parcela_paga' => $parcela_paga,
                'parcela_total' => $parcela_total
            ]);

            foreach ($items as $item) 
            {
                $pedido->produtos()->attach
                ($pedido->id, ['produto_id' => $item['produtoId'], 'preco_unitario' => $item['preco'],
                    'quantidade' => $item['quantidade'], 'preco_total' => $item['preco'] * $item['quantidade']]);

                $produto = Produto::find($item['produtoId']);
                $produto->quantidade -= $item['quantidade'];
                $produto->save();
            }
        }

        Session::forget('carrinho');

        $soma = $request->via_cliente + $request->entrega;

        if ($soma > 0) {return redirect('/redirect-pedido/'.$pedido->id.'&'.$soma.'&0');}

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Venda realizada com sucesso');

        return redirect('/pedido-novo');
    }

    public function add(Request $request)
    {
        $output="";

        $quantidade = $request->quantidade;
        $produto = Produto::find($request->item);
        $preco = $produto->preco * $quantidade;

        $item = array(
            'produtoId' => $produto->id,
            'produtoNome' => $produto->nome,
            'preco' => $produto->preco,
            'quantidade' => $quantidade
        );

        Session::push('carrinho', $item);

        $output.='<tr>'.
        '<td>'.$produto->nome.'</td>'.
        '<td>
            <div class="qtd_cart" style="width: 60px;">
                <input id="q'.$produto->id.'" type="number" step="1" class="form-control" value="'.$quantidade.'" >
            </div>
        </td>
        <td>'.number_format($preco,2,',','.').'</td>'.
        '<td><div style="cursor:pointer; margin-left:25px;"><i id="'.$produto->id.'" class="fas fa-minus-circle"></i></div></td>
        </tr>';
        
        return Response($output);
    }

    public function alterar(Request $request)
    {
        $output="";

        $item = $request->id;

        foreach (Session('carrinho') as $key => $val)
        {
            if ($val['produtoId'] == $item)
            {
                $custo = $val['preco'] * $val['quantidade'];

                $carrinho = Session::get('carrinho');
                unset($carrinho[$key]);
                Session::put('carrinho', $carrinho);

                $quantidade = $request->quantidade;
                $produto = Produto::find($request->id);
                $preco = $produto->preco * $quantidade;

                $item = array(
                    'produtoId' => $produto->id,
                    'produtoNome' => $produto->nome,
                    'preco' => $produto->preco,
                    'quantidade' => $quantidade
                );

                Session::push('carrinho', $item);
            }
        }
        
        return Response($output);
    }

    public function delete(Pedido $pedido, Request $request)
    {
        foreach ($pedido->produtos as $item) 
        {
            $produto = Produto::find($item->id);
            $produto->quantidade += $item->pivot->quantidade;
            $produto->save();
        }

        $pedido->delete();

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Pedido removido com sucesso');

        return redirect('/pedido-listar');
    }

    public function remove(Request $request)
    {
        $output="";
        $custo;

        $delete =  $request->item;
       
        foreach (Session('carrinho') as $key => $val)
        {
            if ($val['produtoId'] == $delete)
            {
                $custo = $val['preco'] * $val['quantidade'];

                $carrinho = Session::get('carrinho');
                unset($carrinho[$key]);
                Session::put('carrinho', $carrinho);

                $output=$custo;
            }
        }

        return Response($output);
    }

    public function buscaCheckout(Request $request)
    {
        $output="";
       
        $produtos = new Produto;

        if (!$request->search) 
        {
            $produtos = Produto::orderBy('nome','asc')->get();
        } 
        else
        {
            $term = $request->search;

            $terms = explode(' ', $term);

            $produtos = Produto::
            where(function($query) use ($terms){
               foreach($terms as $term){
                   $query->where('produtos.nome', 'LIKE', '%'.$term.'%');
               }
            })
            ->orWhere(function($query) use ($terms){
               foreach($terms as $term){
                   $query->where('produtos.codigo', 'LIKE', '%'.$term.'%');
               }
            })     
            ->get();      
        }
    
        if ($produtos) {
            foreach ($produtos as $produto) {
                $output.=
                '<tr id="row'.$produto->id.'">'.
                '<td style="display:none;">'.$produto->id.'</td>'.
                '<td>
                    <a href="produto/'.$produto->id.'"target="_blank">'.$produto->nome.'</a>
                </td>'.
                '<td>'.$produto->unidade->nome.'</td>'.
                '<td>'.$produto->quantidade.'</td>'.
                '<td>R$ '.number_format($produto->preco,2,',','.').'</td>'.
                '<td>
                    <div class="qtd" style="width: 60px;">
                        <input id="'.$produto->id.'" type="number" step="1" class="form-control" name="quantidade" >
                    </div>
                </td>
                </tr>';
            }
        }

        return Response($output);
    }

    public function index()
    {
        $mes = 0;
        $ano_busca = 0;
        $pago = 3;

        $anos = Pedido::distinct()->get([DB::raw('YEAR(created_at) as valor')]);

        $pedidos = Pedido::orderBy('id','desc')->paginate(50);

        return view('pedido.listar', compact('pedidos','anos','ano_busca','mes','pago'));
    }

    public function show(Pedido $pedido)
    {
        $clientes = Cliente::all();

        $pagamentos = Pagamento::all();

        return view('pedido.editar', compact('pedido','pagamentos','clientes'));
    }

    public function update(Pedido $pedido, Request $request)
    {
        if ($request->valor_pago != $pedido->valor_pago && $request->valor_pago >= $pedido->valor)
        {
            $pedido->pago = 1;
            $pedido->valor_pago = $pedido->valor;   
    	} 
        else 
        {
            $pedido->valor_pago = $request->valor_pago;
        }

        $pedido->cliente_id = $request->cliente_id;
        $pedido->pagamento_id = $request->pagamento_id;
        
        $pedido->save();

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Pedido modificado com sucesso');

        return redirect('/pedido/'.$pedido->id);
    }

    public function showCliente(Pedido $pedido)
    {
        return view('pedido.cliente', compact('pedido'));
    }

    public function showEntrega(Pedido $pedido)
    {
        return view('pedido.entrega', compact('pedido'));
    }

    public function redirect(Pedido $pedido, $flag, $fechar)
    {
        return view('pedido.gerar', compact('pedido','flag','fechar'));
    }
    
    public function filter(Request $request)
    {
        $mes = $request->mes;
        $ano = $request->ano;

        if ($request->pago == 3 ? $pago = null : $pago = $request->pago);

        $anos = Pedido::distinct()->get([DB::raw('YEAR(created_at) as valor')]);

        if ($mes && $ano && !is_null($pago)) 
        {
            $pedidos = Pedido::whereRaw('MONTH(created_at) = '.$mes)
                ->whereRaw('YEAR(created_at) = '.$ano)
                ->where('pago',$pago)
                ->orderBy('id','desc')
                ->paginate(50);
        }

        else if ($mes && $ano) 
        {
            $pedidos = Pedido::whereRaw('MONTH(created_at) = '.$mes)
                ->whereRaw('YEAR(created_at) = '.$ano)
                ->orderBy('id','desc')
                ->paginate(50);
        }

        else if ($mes && !is_null($pago)) 
        {
            $pedidos = Pedido::whereRaw('MONTH(created_at) = '.$mes)
                ->where('pago',$pago)
                ->orderBy('id','desc')
                ->paginate(50);
        }

        else if ($ano && !is_null($pago)) 
        {
            $pedidos = Pedido::whereRaw('YEAR(created_at) = '.$ano)
                ->where('pago',0)
                ->orderBy('id','desc')
                ->paginate(50);
        }

        else if ($mes) 
        {
            $pedidos = Pedido::whereRaw('MONTH(created_at) = '.$mes)
                ->orderBy('id','desc')
                ->paginate(50);
        }

        else if ($ano) 
        {
            $pedidos = Pedido::whereRaw('YEAR(created_at) = '.$ano)
                ->orderBy('id','desc')
                ->paginate(50);
        }

        else if (!$mes && !$ano && is_null($pago)) 
        {
            $pedidos = Pedido::orderBy('id','desc')->paginate(50);
        }

        else 
        {
            $pedidos = Pedido::where('pago',$pago)
                ->orderBy('id','desc')
                ->paginate(50);
        }

        if ($request->mes ? $mes = $request->mes : $mes = 0);
        if ($request->ano ? $ano = $request->ano : $ano = 0);
        $pago = $request->pago;
        // if ($request->pago == 0) {
        //     $pago = 0;
        // } else if ($request->pago == 1) {
        //     $pago = 1;
        // } else {$pago = 3;}
        
        $ano_busca = $ano;

        return view('pedido.listar', compact('pedidos','anos','ano_busca','mes','pago'));
    }

    public function pago(Request $request)
    {
        $pedido = Pedido::find($request->id);
        $pedido->pago = 1;
        $pedido->valor_pago = $pedido->valor;
        $pedido->save();

        $output = 'Pago <i id="despagar'.$pedido->id.'" class="fas fa-times"></i>';

        return Response($output);   
    }

    public function naoPago(Request $request)
    {
        $pedido = Pedido::find($request->id);
        $pedido->pago = 0;
        $pedido->valor_pago = 0;
        $pedido->save();

        $output = ' Não Pago <i id="pagar'.$pedido->id.'" class="fas fa-check"></i>';

        return Response($output);   
    }

    public function pmais(Request $request)
    {
        $pedido = Pedido::find($request->id);
        $valor_parcela;

        $valor_parcela = $pedido->valor / $pedido->parcela_total; 
        $pedido->parcela_paga += 1;
        $pedido->valor_pago = $valor_parcela * $pedido->parcela_paga;
        
        if ($pedido->parcela_paga == $pedido->parcela_total) {$pedido->pago = 1;}
        $pedido->save();

        $output =   $pedido->parcela_paga.'/<b>'.$pedido->parcela_total.'</b>
                    <table>
                        <tbody>
                            <td><i id="pmais'.$pedido->id.'" class="fas fa-plus"></td>
                            <td><i id="pmenos'.$pedido->id.'" class="fas fa-minus"></td>
                        </tbody>
                    </table>';

        return Response($output);   
    }

    public function pmenos(Request $request)
    {
        $pedido = Pedido::find($request->id);
        $pedido->parcela_paga -= 1;
        $pedido->save();

        $output =   $pedido->parcela_paga.'/<b>'.$pedido->parcela_total.'</b>
                    <table>
                        <tbody>
                            <td><i id="pmais'.$pedido->id.'" class="fas fa-plus"></td>
                            <td><i id="pmenos'.$pedido->id.'" class="fas fa-minus"></td>
                        </tbody>
                    </table>';
                
        return Response($output);   
    }

    public function updateProduto(Pedido $pedido, Produto $produto, $quantidade, $preco, Request $request)
    {
        $pedido->produtos()->updateExistingPivot($produto,[
            'quantidade' => $request->quantidade,
            'preco_total' => $request->quantidade * $preco
        ]);

        $preco_final = 0;

        foreach ($pedido->produtos as $produto)
        {
            $preco_final += $produto->pivot->preco_total; 
        }

        $pedido->valor = $preco_final;
        $pedido->save();

        if ($request->quantidade > $quantidade) 
        {
        	$diferenca = $request->quantidade - $quantidade;
            $produto->quantidade += $diferenca;
        }

        else
        {
            $diferenca = $quantidade - $request->quantidade;
            $produto->quantidade -= $diferenca;
        }

        $produto->save();
       
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Quantidade alterada com sucesso');

        return redirect('/pedido/'.$pedido->id);
    }

    public function removerProduto(Pedido $pedido, Produto $produto , Request $request)
    {
        $pedido->produtos()->detach($produto);

        $preco_final = 0;

        foreach ($pedido->produtos as $produto)
        {
            $preco_final += $produto->pivot->preco_total; 
        }

        $pedido->valor = $preco_final;
        $pedido->save();
 
        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Produto removido com sucesso');

        return redirect('/pedido/'.$pedido->id);
    }

    public function filter_get($mes, $ano, $pago)
    {
        $anos = Pedido::distinct()->get([DB::raw('YEAR(created_at) as valor')]);

        $ano_busca = $ano;

        if ($pago == 0 || $pago == 1) 
        {
            $pedidos = Pedido::whereRaw('MONTH(created_at) = '.$mes)
                ->whereRaw('YEAR(created_at) = '.$ano)
                ->where('pago',$pago)
                ->orderBy('id','desc')
                ->paginate(50);
        }

        else
        {
            $pedidos = Pedido::whereRaw('MONTH(created_at) = '.$mes)
                ->whereRaw('YEAR(created_at) = '.$ano)
                ->orderBy('id','desc')
                ->paginate(50);
        }

        return view('pedido.listar', compact('pedidos','anos','ano_busca','mes','pago'));
    }
}
    
