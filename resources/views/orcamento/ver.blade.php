<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    </head> 
    <body>
        <img src="{{ asset('img/logo.jpg') }}" style="width: 500px;">
        @if(empty($orcamento->cliente->id))
        @else
            <br><br><h3>Cliente: {{$orcamento->cliente->nome}}</h3>
        @endif
        <table class="table table-striped" style="width: 500px;">
            <thead class="thead-dark">
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Preço Unitário</th>
                <th>Preço Total</th>
            </thead>
            <tbody>
                @foreach ($orcamento->produtos as $produto)
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
                    <td><b>Total:</b>R${{$orcamento->valor}}</td>
                </tr>
            </tbody>
       </table>
    </body>  
</html>



