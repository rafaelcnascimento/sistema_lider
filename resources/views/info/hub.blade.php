@extends('painel')
@section('corpo')
        <h1>Passivo: R$ {{$passivo}}</h1>
        <h1>Numero de produtos: {{$itens}}</h1>
        <h1>Estoque custo inicial: R$ {{$estoque_custo}}</h1>
        <h1>Estoque preço de venda: R$ {{$estoque_venda}}</h1>
        @if ($balanco > 0)
            <h1 style="color: green;">Balanço: R$ {{$balanco}}</h1>
        @else
            <h1 style="color: red;">Balanço: R$ {{$balanco}}</h1>
        @endif

        <h1>Produtos mais vendidos:</h1>

        @foreach ($mais_vendidos as $mais_vendido)
            <p>{{$mais_vendido->nome}}: <b>{{$mais_vendido->quantidade}}</b></p>
        @endforeach

        <h1>Mês: {{ ucfirst( Date::now()->locale('pt-BR')->format('F')) }}</h1>
        <h1>Despesas totais: R$ {{$despesa_total_mes}}</h1>
        <h1>Despesas pagas: R$ {{$despesa_paga_mes}} </h1>
        <h1>Despesas em aberto: R$ {{$despesa_aberta_mes}} </h1>
        <h1>Vendas totais: R$ {{$venda_total_mes}}</h1>
        <h1>Vendas pagas: R$ {{$venda_paga_mes}}</h1>
        <h1>Vendas em aberto: R$ {{$venda_aberta_mes}}</h1>
        <h1>Balanço total: R$ {{$balanco_total_mes}}</h1>
        <h1>Balanço pago: R$ {{$balanco_pago_mes}}</h1>
        <h1>Balanço em aberto: R$ {{$balanco_aberto_mes}}</h1>

        <h1>Ano: {{ ucfirst( Date::now()->locale('pt-BR')->format('Y')) }}</h1>
        <h1>Despesas totais: R$ {{$despesa_total_ano}}</h1>
        <h1>Despesas pagas: R$ {{$despesa_paga_ano}} </h1>
        <h1>Despesas em aberto: R$ {{$despesa_aberta_ano}} </h1>
        <h1>Vendas totais: R$ {{$venda_total_ano}}</h1>
        <h1>Vendas pagas: R$ {{$venda_paga_ano}}</h1>
        <h1>Vendas em aberto: R$ {{$venda_aberta_ano}}</h1>
        <h1>Balanço total: R$ {{$balanco_total_ano}}</h1>
        <h1>Balanço pago: R$ {{$balanco_pago_ano}}</h1>
        <h1>Balanço em aberto: R$ {{$balanco_aberto_ano}}</h1>
@endsection
