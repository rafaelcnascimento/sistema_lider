<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
        {{-- CSS extra --}}
        @yield('css')
    </head>
    <body style="padding-top: 70px;">
        <!-- Fixed navbar -->
        <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-primary">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-item nav-link active" href="/produto-listar">Estoque</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link active" href="/produto-novo">Novo Produto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link active" href="/fornecedor-listar">Fornecedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link active" href="/fornecedor-novo">Novo Fornecedor</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link active" href="/entrada-listar">Entradas de produtos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link active" href="/entrada-nova">Nova Entrada</a>
                </li>
            </ul>
        </nav>

        @yield('corpo')
      
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        @yield('js')
    </body>
</html>
