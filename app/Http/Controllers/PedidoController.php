<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Anam\PhantomMagick\Converter;
use App\Pedido;
use App\Orcamento;
use App\Produto;
use App\Cliente;
use App\Pagamento;
use Session;

class PedidoController extends Controller 
{
    public function create()
    {
        $produtos = Produto::orderBy('nome','asc')->get();
        $pagamentos = Pagamento::all();
        $clientes = Cliente::all();

        Session::forget('carrinho');
        // Session::forget('valor');

        return view('pedido.checkout', compact('produtos','pagamentos','clientes'));
    }

    public function store(Request $request)
    {
        if ($request->desconto ? $desconto = $request->desconto : $desconto = 0);
        // if ($request->$cliente_id ? $cliente_id = $request->$cliente_id : $cliente_id = null);

        $valor = $request->valor * (1 - $desconto/100);

        switch ($request->pagamento_id) 
        {
            case '2':
                # parcelado...
                break;
            
            default:
                $parcela_paga = 1;
                $parcela_total = 1;
                break;
        }

        $items = Session::get('carrinho');

        if ($request->botao == 'orcamento')
        {
            $orcamento = Orcamento::create([
               'valor' => $valor,
               'desconto' => $desconto,
               'cliente_id' => $request->cliente_id,
            ]);

            foreach ($items as $item) 
            {
                $orcamento->produtos()->attach
                ($orcamento->id, ['produto_id' => $item['produtoId'], 'preco_unitario' => $item['preco'],
                    'quantidade' => $item['quantidade'], 'preco_total' => $item['preco'] * $item['quantidade']]);
            }

            $conv = new Converter();
            $conv->setBinary('C:\xampp\htdocs\sistema_lider\bin\phantomjs');
            $conv->source('http://127.0.0.1/orcamento/'.$orcamento->id)
                ->toPng()
                ->download($orcamento->cliente->nome.'.png');
        } 

        else 
        {
            $pedido = Pedido::create([
                'valor' => $valor,
                'desconto' => $desconto,
                'cliente_id' => $request->cliente_id,
                'pagamento_id' => $request->pagamento_id,
                'parcela_paga' => $parcela_paga,
                'parcela_total' => $parcela_total
            ]);

            foreach ($items as $item) 
            {
                $pedido->produtos()->attach
                ($pedido->id, ['produto_id' => $item['produtoId'], 'preco_unitario' => $item['preco'],
                    'quantidade' => $item['quantidade'], 'preco_total' => $item['preco'] * $item['quantidade']]);
            }
        }

        Session::forget('carrinho');

        $request->session()->flash('message.level', 'success');
        $request->session()->flash('message.content', 'Pedido realizado com sucesso');

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
        '<td>'.$quantidade.'</td>'.
        '<td>'.number_format($preco,2,',','.').'</td>'.
        '<td><div id="'.$produto->id.'"style="cursor:pointer; margin-left:25px;"><i class="fas fa-minus-circle"></i></div></td>';
        
        return Response($output);
    }

    public function remove(Request $request)
    {
        $output="";

        $delete =  $request->item;
       
        foreach (Session('carrinho') as $key => $val)
        {
            if ($val['produto'] == $delete)
            {
                $carrinho = Session::get('carrinho');
                unset($carrinho[$key]);
                Session::put('carrinho', $carrinho);
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
                $output.='<tr id="row'.$produto->id.'">'.
                '<td style="display:none;">'.$produto->id.'</td>'.
                '<td>
                    <a href="produto/'.$produto->id.'"target="_blank">'.$produto->nome.'</a>
                </td>'.
                '<td>'.$produto->unidade->nome.'</td>'.
                '<td>'.$produto->quantidade.'</td>'.
                '<td>R$ '.number_format($produto->preco,2,',','.').'</td>'.
                '<td>
                    <div class="qtd" style="width: 60px;">
                        <input id="'.$produto->id.'" type="text" class="form-control" name="quantidade" >
                    </div>
                </td>
                </tr>';
            }
            return Response($output);
        }
    }

    public function index()
    {
        $anos = Pedido::distinct()->get([DB::raw('YEAR(created_at) as valor')]);

        $pedidos = Pedido::orderBy('id','dsc')->paginate(50);

        return view('pedido.listar', compact('pedidos','anos'));
    }

    public function show(Pedido $pedido)
    {
        return view('pedido.editar', compact('pedido'));
    }
}
