<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Anam\PhantomMagick\Converter;
use Anam\PhantomLinux\Path;
use DB;
use App\Dado;
use App\Orcamento;
use App\Produto;
use App\Pedido;
use App\Cliente;
use App\Pagamento;
use Session;

class OrcamentoController extends Controller 
{
    public function index()
    {
        $orcamentos = Orcamento::orderBy('id','dsc')->paginate(50);

        return view('orcamento.listar', compact('orcamentos'));
    }

    public function show(Orcamento $orcamento)
    {
        return view('orcamento.ver', compact('orcamento'));
    }

    public function converter(Orcamento $orcamento)
    {
        Session::forget('carrinho');

        foreach ($orcamento->produtos as $produto)
        {
            $item = array(
                'produtoId' => $produto->id,
                'produtoNome' => $produto->nome,
                'preco' => $produto->pivot->preco_unitario,
                'quantidade' => $produto->pivot->quantidade
            );

            Session::push('carrinho', $item);
        }
 
        return redirect('/pedido-novo');
    }

    public function redirect(Orcamento $orcamento, $fechar)
    {
        return view('orcamento.gerar', compact('orcamento','fechar'));
    }

    public function gerarImagem(Orcamento $orcamento) 
    {
        $dados = Dado::find(1);

        $options = [
            'width' => 445,
            'quality' => 100
        ];

        if ($orcamento->cliente_id) 
        {
            $conv = new Converter();
            if (PHP_OS == "Linux") {$conv->setBinary(Path::binaryPath()); }
            else{$conv->setBinary($dados->executavel);} 
                       
            $conv->source('http://127.0.0.1/orcamento/'.$orcamento->id)
                ->toPng($options)
                ->download($orcamento->cliente->nome.$orcamento->id.'.png');
        } 
        else 
        {
            $conv = new Converter();
            if (PHP_OS == "Linux") {$conv->setBinary(Path::binaryPath()); }
            else{$conv->setBinary($dados->executavel);} 
            $conv->source('http://127.0.0.1/orcamento/'.$orcamento->id)
                ->toPng($options)
                ->download('Orcamento'.$orcamento->id.'.png');
        }
    }

    public function gerarEntrega(Pedido $pedido) 
    {
        $dados = Dado::find(1);

        $options = [
            'width' => 445,
            'quality' => 100
        ];

        if ($pedido->cliente_id) 
        {
            $conv = new Converter();
            if (PHP_OS == "Linux") {$conv->setBinary(Path::binaryPath()); }
            else{$conv->setBinary($dados->executavel);}          
            $conv->source('http://127.0.0.1/pedido-entrega/'.$pedido->id)
                ->toPng($options)
                ->download('Entrega '.$pedido->cliente->nome.$pedido->id.'.png');
        } 
        else 
        {
            $conv = new Converter();
            if (PHP_OS == "Linux") {$conv->setBinary(Path::binaryPath()); }
            else{$conv->setBinary($dados->executavel);}          
            $conv->source('http://127.0.0.1/pedido-entrega/'.$pedido->id)
                ->toPng($options)
                ->download('Entrega '.$pedido->id.'.png');
        }
    }

    public function gerarCliente(Pedido $pedido) 
    {
        $dados = Dado::find(1);

        $options = [
            'width' => 445,
            'quality' => 100
        ];

        if ($pedido->cliente_id) 
        {
            $conv = new Converter();
            if (PHP_OS == "Linux") {$conv->setBinary(Path::binaryPath()); }
            else{$conv->setBinary($dados->executavel);}          
            $conv->source('http://127.0.0.1/pedido-cliente/'.$pedido->id)
                ->toPng($options)
                ->download('Pedido '.$pedido->cliente->nome.$pedido->id.'.png');
        } 
        else 
        {
            $conv = new Converter();
            if (PHP_OS == "Linux") {$conv->setBinary(Path::binaryPath()); }
            else{$conv->setBinary($dados->executavel);}          
            $conv->source('http://127.0.0.1/pedido-cliente/'.$pedido->id)
                ->toPng($options)
                ->download('Pedido '.$pedido->id.'.png');
        }
    }
    
    // public function store(Request $request)
    // {
    //     if ($request->desconto ? $desconto = $request->desconto : $desconto = 0);

    //     $valor = $request->valor * (1 - $desconto/100);

    //     $orcamento = Orcamento::create([
    //         'valor' => $valor,
    //         'desconto' => $desconto,
    //         'cliente_id' => $request->cliente_id,
    //     ]);

    //     $items = Session::get('carrinho');
        
    //     foreach ($items as $item) 
    //     {
    //         $orcamento->produtos()->attach
    //         ($orcamento->id, ['produto_id' => $item['produtoId'], 'preco_unitario' => $item['preco'],
    //             'quantidade' => $item['quantidade'], 'preco_total' => $item['preco'] * $item['quantidade']]);
    //     }

    //     Session::forget('carrinho');

    //     $request->session()->flash('message.level', 'success');
    //     $request->session()->flash('message.content', 'Orçamento realizado com sucesso');

    //     return redirect('/orcamento-novo');
    // }
}
