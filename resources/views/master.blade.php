<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>{{ config('app.name', 'Laravel') }}</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        {{-- CSS extra --}}
        <link href="{{ asset('css/lider.css') }}" rel="stylesheet" type="text/css">
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
                    <a class="nav-item nav-link active" href="/produto-catalogo">Catálogo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                        Produtos
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/produto-novo">Novo Produto</a>
                        <a class="dropdown-item" href="/estoque-baixo">Produtos com pouco Estoque</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/entrada-listar">Entradas de Produtos</a>
                        <a class="dropdown-item" href="/entrada-nova">Nova Entrada</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/unidade-listar">Unidades</a>
                        <a class="dropdown-item" href="/unidade-nova">Nova Unidade</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                        Pessoas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/cliente-listar">Clientes</a>
                        <a class="dropdown-item" href="/cliente-novo">Novo Cliente</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/fornecedor-listar">Fornecedores</a>
                        <a class="dropdown-item" href="/fornecedor-novo">Novo Fornecedor</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link active" href="/pedido-listar">Pedidos</a>
                </li>
                <li class="nav-item">
                    {{-- <a class="nav-item nav-link active" href="/pedido-novo">Venda</a> --}}
                    <a href="/pedido-novo" class="btn btn-light" role="button">Vender</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link active" href="/produto-estocador">Ferramenta de Estoque</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link active" href="/orcamento-listar">Orçamentos</a>
                </li>
            </ul>
        </nav>

        @yield('corpo')
      
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/bootstrap.min.js') }}"></script>
        @yield('js')
    </body>
</html>
