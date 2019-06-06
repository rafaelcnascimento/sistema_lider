@extends('master')
@section('css')
    <link href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" rel="stylesheet" >
@endsection
@section('corpo')

    <div class="container">
        @if(session()->has('message.level'))
            <div class="alert alert-{{ session('message.level') }}"> 
            {!! session('message.content') !!}
            </div>
        @endif
    <form method="post" action="/pedido/{{$pedido->id}}">
        @method('patch')
        @csrf
    <div class="container-fluid">
       <table class="table table-striped">
           <thead class="thead-dark">
               <th>Código</th>
               <th>Cliente</th>
               <th>Valor Pago</th>
               <th>Valor</th>
               <th>Forma de Pagamento</th>
               <th>Parcelas/Pagas</th>
               <th>Situação</th>
               <th>Data</th>
           </thead>
       <tbody class="resultado">
            <tr>
                <td>
                    {{$pedido->id}}
                </td>
            <td style="width:20%">
                <select class="form-control" id="cliente_id"  name="cliente_id">
                    @if(!$pedido->cliente_id)
                        <option selected="" disabled="">Selecione</option>
                    @else
                        <option value="">Ninguém</option>
                    @endif
                    @foreach ($clientes as $cliente)
                        @if ($pedido->cliente_id == $cliente->id)
                            <option selected value="{{$cliente->id}}">{{$cliente->nome}}</option>
                        @else
                            <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                        @endif
                    @endforeach
                </select> 
            </td>
            <td style="width: 10%">
                <input onclick="this.select()" type="number" step="0.01" class="form-control" name="valor_pago" value="{{$pedido->valor_pago}}">
            </td>
            <td>R${{$pedido->valor}}</td>
            <td>
                <select class="form-control" id="pagamento_id"  name="pagamento_id" required>
                    @foreach ($pagamentos as $pagamento)
                        @if ($pedido->pagamento_id == $pagamento->id)
                            <option selected value="{{$pagamento->id}}">{{$pagamento->nome}}</option>
                        @else
                            <option value="{{$pagamento->id}}">{{$pagamento->nome}}</option>
                        @endif
                    @endforeach
                </select> 
            </td>
            @if ($pedido->pagamento_id == 7)
                <td id="parcela{{$pedido->id}}">
                   {{$pedido->parcela_paga}}/<b>{{$pedido->parcela_total}}</b>
                    <table>
                       <tbody>
                           <td>
                               <i id="pmais{{$pedido->id}}" class="fas fa-plus">
                           </td>
                           <td>
                               <i id="pmenos{{$pedido->id}}" class="fas fa-minus">
                           </td>
                       </tbody>
                   </table>
               </td>
           @else
               <td></td>
           @endif
           @if ($pedido->pago)
               <td class="table-success" id="pago{{$pedido->id}}">
                   Pago <i id="despagar{{$pedido->id}}" class="fas fa-times">
               </td>
           @elseif (!$pedido->pago && $pedido->parcela_total > 1 )
               <td class="table-warning">
                   Em Aberto
               </td>
           @else
               <td class="table-danger" id="npago{{$pedido->id}}">
                   Não Pago <i id="pagar{{$pedido->id}}" class="fas fa-check"></i>
               </td>
           @endif
           <td>{{$pedido->created_at}}</td>
           </tr>
       </tbody>
   </table>
   </div>

    <div class="form-inline">
            <div style="margin-left: 20px;">
                <button type="submit" class="btn btn-success">
                    {{ __('Salvar') }}
                </button>
            </div>   
        </form>  
        <form method="post" action="/pedido/{{$pedido->id}}" onSubmit="if(!confirm('Deletar pedido?')){return false;}">
                @method('delete')
                @csrf
                    <div style="margin-left: 20px;">
                        <button type="submit" class="btn btn-danger">
                            {{ __('Deletar') }}
                        </button>
                    </div>   
        </form>  
    </div>
        <div style="margin-left: 20px;">
            <br><p><b>Observação: </b>{{$pedido->obs}}</p>
        </div>    
        
        <table class="table table-borderless">
           <thead>
               <th>Produto</th>
               <th>Quantidade</th>
               <th>Preço Unitário</th>
               <th>Preço Total</th>
               <th>Salvar</th>
               <th>Remover</th>
           </thead>
           <tbody>
               @foreach ($pedido->produtos as $produto)
                    <form method="POST" action="/pedido_quantidade/{{$pedido->id}}&{{$produto->id}}&{{$produto->pivot->quantidade}}&{{$produto->pivot->preco_unitario}}">
                        @method('patch')
                        @csrf
                    <tr>
                       <td><a href="/produto/{{$produto->id}}" target="_blank">{{$produto->nome}} {{$produto->id}}</a></td>
                       <td style="width: 10%">
                           <input onclick="this.select()" type="number" step="1"  class="form-control" name="quantidade" value="{{$produto->pivot->quantidade}}">
                       </td>
                       <td>R${{$produto->pivot->preco_unitario}}</td>
                       <td>R${{$produto->pivot->preco_total}}</td>
                       <td>
                            <button type="submit" class="btn btn-primary">
                                {{ __('Salvar') }}
                            </button>
                       </td>
                    </form>
                       <td>
                           <form method="post" action="/pedido_remover/{{$pedido->id}}&{{$produto->id}}" onSubmit="if(!confirm('Deletar produto?')){return false;}">
                               @method('delete')
                               @csrf
                                    <button type="submit" class="btn btn-danger">
                                        {{ __('Deletar') }}
                                    </button>
                           </form>  
                       </td>
                   </tr>
                @endforeach   
           </tbody>
        </table>

    </div> 
@endsection

@section('js')
    <script src="{{ asset('js/ajaxPedidos.js') }}"></script>
@endsection


