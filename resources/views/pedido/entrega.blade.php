<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    </head> 
    <body>
        <br><br>
        @if(empty($pedido->cliente->id))

        @else
            <h3>Cliente: {{$pedido->cliente->nome}}</h3>
            <p><b>Endereço</b>: {{$pedido->cliente->logradouro}} - {{$pedido->cliente->numero}}</p>
            <P><b>Bairro</b>: {{$pedido->cliente->bairro}}</P>
            <p><b>Telefone</b>: {{$pedido->cliente->telefone}}</p>
        @endif
        <br>
        <table class="table table-striped" style="width: 500px;">
            <thead class="thead-dark">
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Preço Total</th>
            </thead>
            <tbody>
                @foreach ($pedido->produtos as $produto)
                    <tr>
                        <td>{{$produto->nome}}</td>
                        <td>{{$produto->pivot->quantidade}}</td>
                        <td>R${{$produto->pivot->preco_unitario}}</td>
                        <td>R${{$produto->pivot->preco_total}}</td>
                    </tr>
                @endforeach   
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><b>Total:</b>R${{$pedido->valor}}</td>
                </tr>
            </tbody>
       </table>
    </body>  
</html>



