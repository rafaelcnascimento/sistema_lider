@extends('master')
@section('css')
    <link href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" rel="stylesheet" >
@endsection
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
            <option value="">Todos</option>
            <option value="1">Janeiro</option>
            <option value="2">Fevereiro</option>
            <option value="3">Março</option>
            <option value="4">Abril</option>
            <option value="5">Maio</option>
            <option value="6">Junho</option>
            <option value="7">Julho</option>
            <option value="8">Agosto</option>
            <option value="9">Setembro</option>
            <option value="10">Outubro</option>
            <option value="11">Novembro</option>
            <option value="12">Dezembro</option>
        </select>
        <select class="form-control espaco20" id="ano"  name="ano" >
            <option selected="" disabled="">Escolha o ano</option>
            <option value="">Todos</option>
            @foreach ($anos as $ano)
                <option value="{{$ano->valor}}">{{$ano->valor}}</option>
            @endforeach
        </select>
        <select class="form-control espaco20" id="pago"  name="pago" >
            <option value ="3">Todos</option>
            <option value ="1">Pagos</option>
            <option value ="0">Não pagos</option>
        </select>
        <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                {{ __('Filtrar') }}
                </button>
            </div>
        </div>
    </form>
    </center>
    {{-- Filtrar depois por ano e mes --}}
    <br>
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
                <th>Img Cliente</th>
                <th>Img Entrega</th>
            </thead>
        <tbody class="resultado">
            @foreach ($pedidos as $pedido)
                <tr>
                    <td>
                        <a href="pedido/{{$pedido->id}}">{{$pedido->ano()}}_{{$pedido->id}}</a>
                    </td>
                <td>
                @if(empty($pedido->cliente->id))
                @else
                    <a href="cliente/{{$pedido->cliente->id}}" target="_blank">{{$pedido->cliente->nome}}</a>
                @endif
                </td>
                <td>R${{$pedido->valor_pago}}</td>
                <td>R${{$pedido->valor}}</td>
                <td>{{$pedido->pagamento->nome}}</td>
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
                <td>
                    <a href="/redirect-pedido/{{$pedido->id}}&1&1" target="_blank" class="btn btn-primary" role="button">Gerar</a>
                </td>
                <td>
                    <a href="/redirect-pedido/{{$pedido->id}}&2&1" target="_blank" class="btn btn-success" role="button">Gerar</a>
                </td>
                </tr>
            @endforeach    
        </tbody>
    </table>
    </div>
    
    {{ $pedidos->links() }}
    
@endsection
    
@section('js')
    <script type="text/javascript">
        var mes = {{$mes}}; 
        var ano = {{$ano_busca}};
        var pago = {{$pago}};

        if (mes != 0) {$("#mes").val(mes).change();}
        if (ano != 0) {$("#ano").val(ano).change();}
        if (pago != 3) {$("#pago").val(pago).change();}   
    </script>
    <script src="{{ asset('js/ajaxPedidos.js') }}"></script>
@endsection
