<h1>Passivo: R$ {{$passivo}}</h1>
<h1>Numero de produtos: {{$itens}}</h1>
<h1>Estoque custo inicial: R$ {{$estoque_custo}}</h1>
<h1>Estoque preço de venda: R$ {{$estoque_venda}}</h1>
@if ($balanco > 0)
    <h1 style="color: green;">Balanço: R$ {{$balanco}}</h1>
@else
    <h1 style="color: red;">Balanço: R$ {{$balanco}}</h1>
@endif
