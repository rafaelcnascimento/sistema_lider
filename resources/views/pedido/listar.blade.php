@extends('master')
@section('corpo')
    <br>
    
    @if(session()->has('message.level'))
        <div class="alert alert-{{ session('message.level') }}"> 
        {!! session('message.content') !!}
        </div>
    @endif

        <form class="form-inline filtrar" method="POST" action="/pedido-filtrar">
            @csrf
            <h3>Filtrar:</h3>
            <select class="form-control espaco20" id="mes"  name="mes" >
                <option selected="" disabled="">Escolha o mês</option>
                <option value="01">Janeiro</option>
                <option value="02">Fevereiro</option>
                <option value="03">Março</option>
                <option value="04">Abril</option>
                <option value="05">Maio</option>
                <option value="06">Junho</option>
                <option value="07">Julho</option>
                <option value="08">Agosto</option>
                <option value="09">Setembro</option>
                <option value="10">Outubro</option>
                <option value="11">Novembro</option>
                <option value="12">Dezembro</option>
            </select>

            <select class="form-control espaco20" id="ano"  name="ano" >
                <option selected="" disabled="">Escolha o ano</option>

                @foreach ($anos as $ano)
                    <option value="{{$ano->valor}}">{{$ano->valor}}</option>
                @endforeach
            </select>

        </form>

    </center>

    {{-- Filtrar depois por ano e mes --}}

    <br>
    <div class="container-fluid">
        <table class="table table-striped">
            <thead class="thead-dark">
                <th>Código</th>
                <th>Cliente</th>
                <th>Valor</th>
                <th>Desconto</th>
                <th>Forma de Pagamento</th>
                <th>Parcelas/Pagas</th>
                <th>Situação</th>
                <th>Data</th>
            </thead>
            <tbody class="resultado">
                @foreach ($pedidos as $pedido)
                <tr>
                    <td><a href="pedido/{{$pedido->id}}" target="_blank">{{$pedido->id}}</a></td>
                    <td><a href="cliente/{{$pedido->cliente->id}}" target="_blank">{{$pedido->cliente->nome}}</a></td>
                    <td>R${{$pedido->valor}}</td>
                    <td>{{$pedido->desconto}}%</td>
                    <td>{{$pedido->pagamento->nome}}</td>
                    <td>{{$pedido->parcela_paga}}/<b>{{$pedido->parcela_total}}</b></td>
                    
                    @if ($pedido->pago)
                    <td class="table-success">
                        Pago
                    </td>
                    @elseif (!$pedido->pago && $pedido->parcela_paga > 1 )
                        <td class="table-warning">
                            Em Aberto
                        </td>
                    @else
                        <td class="table-danger">
                            Não Pago
                        </td>
                    @endif
                    <td>{{$pedido->created_at}}</td>
                </tr>
                @endforeach    
            </tbody>
        </table>
    </div>
    {{ $pedidos->links() }}
@endsection
