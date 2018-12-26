<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        <!-- Fonte -->
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    </head>
    <body>
        <br>
        <center>
            <div class="form-group has-feedback" style="width: 50%">
                <input type="text" class="form-control" name="busca" id="busca" placeholder="Buscar">
            </div>
        </center>
        <br>
        <div class="container-fluid">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <th>ID</th>
                    <th>Material</th>
                    <th>Quantidade</th>
                    <th>Unidade</th>
                    <th>Fornecedor</th>
                    <th>Custo Inicial</th>
                    <th>IPI</th>
                    <th>ICMS</th>
                    <th>Frete</th>
                    <th>Custo Unitário</th>
                    <th>Margem</th>
                    <th>Custo Final</th>
                    <th>Preço</th>
                </thead>
                <tbody class="resultado">
                    @foreach ($produtos as $produto)
                    <tr>
                        <td>{{$produto->id}}</td>
                        <td>{{$produto->nome}}</td>
                        <td>{{$produto->quantidade}}</td>
                        <td>{{$produto->unidade->nome}}</td>
                        <td>{{$produto->fornecedor->nome}}</td>
                        <td>@moeda($produto->custo_inicial)</td>
                        <td>{{$produto->ipi}}%</td>
                        <td>{{$produto->icms}}%</td>
                        <td>{{$produto->frete}}%</td>
                        <td>@moeda($produto->custo_unitario)</td>
                        <td>{{$produto->margem}}%</td>
                        <td>@moeda($produto->custo_final)</td>
                        <td>@moeda($produto->preco)</td>
                    </tr>
                    @endforeach  
                </tbody>
            </table>
        </div>
        {{ $produtos->links() }}
        <!-- Optional JavaScript -->
        <script type="text/javascript">
            //Busca
            $('#busca').on('keyup', function() {
                $value = $(this).val();
                $.ajax({
                    type: 'get',
                    url: '/produtoAjax',
                    data: {
                        'search': $value
                    },
                    success: function(data) {
                        $('.resultado').html(data);
                    }
                });
            })
        </script>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        @yield('js')
    </body>
</html>
