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
        <nav class="navbar fixed-top navbar-expand-sm navbar-dark bg-success">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-item nav-link active" href="/painel">Resumo</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button" data-toggle="dropdown">
                        Despesas
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/despesa-listar">Listar Despesas</a>
                        <a class="dropdown-item" href="/despesa-nova">Lançar Despesa</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/tipoDespesa-listar">Tipos de Despesa</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link active" href="/painel/importar">Importar</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link active" href="/painel/despesa-proximas">Próximas despesas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link active" href="/produto-listar">Vendas</a>
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
