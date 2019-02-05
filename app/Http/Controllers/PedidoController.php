<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // $valor = Session::get('valor');
        // $valor = $valor+ ($produto->preco * $quantidade);
        // session(['valor' => $valor]);
        // Session::push('valor', $valor);

        $output.='<tr id="row'.$produto->id.'">'.
        '<td>'.$produto->nome.'</td>'.
        '<td>'.$quantidade.'</td>'.
        '<td>'.number_format($preco,2,',','.').'</td>'.
        '<td><div id="'.$produto->id.'"style="cursor:pointer; margin-left:25px;"><i class="fas fa-minus-circle"></i></div></td>';
        
        return Response($output);
    }

    public function buscaCheckout(Request $request)
    {
        $output="";
       
        $produtos = new Produto;

        if (!$request->search) 
        {
            $produtos = Produto::paginate(50);
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
                $output.='<tr>'.
                '<td>'.$produto->nome.'</td>'.
                '<td>'.$produto->unidade->nome.'</td>'.
                '<td>'.$produto->quantidade.'</td>'.
                '<td>R$ '.number_format($produto->preco,2,',','.').'</td>'.
                '<td>
                    <div class="qtd" style="width: 60px;">
                        <input id="desconto" type="text" class="form-control" name="quantidade">
                    </div>
                </td>
                </tr>';
            }
            return Response($output);
        }
    }
}
