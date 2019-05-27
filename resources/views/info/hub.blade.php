@extends('painel')
@section('corpo')
    <div class="container">
        <h1>Geral</h1>
        <p>Numero de produtos: <b>{{$itens}}</b></p>
        <div class="row">
            <div class="col-sm-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                    <h5 class="card-title">Passivo</h5>
                        <p>R$ {{$passivo}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                    <h5 class="card-title">Estoque Custo Final</h5>
                        <p>R$ {{$estoque_custo}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                    <h5 class="card-title">Estoque Venda</h5>
                        <p>R$ {{$estoque_venda}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                    <h5 class="card-title">Balanço</h5>
                        <p>R$ {{$balanco}}</p>
                    </div>
                </div>
            </div>

        </div>    
        <br>
        
        <h1>Mês: {{ ucfirst( Date::now()->locale('pt-BR')->format('F')) }}</h1>
        <div class="row">
            <div class="col-sm-4">
                <div class="card bg-light">
                    <div class="card-body">
                    <h5 class="card-title">Despesas pagas</h5>
                        <p>R$ {{$despesa_paga_mes}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-light">
                    <div class="card-body">
                    <h5 class="card-title">Despesas em aberto</h5>
                        <p>R$ {{$despesa_aberta_mes}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-light">
                    <div class="card-body">
                    <h5 class="card-title">Despesas totais</h5>
                        <p>R$ {{$despesa_total_mes}}</p>
                    </div>
                </div>
            </div>  
        </div>      
        <br>
        <div class="row">
            <div class="col-sm-4">
                <div class="card bg-light">
                    <div class="card-body">
                    <h5 class="card-title">Vendas recebidas</h5>
                        <p>R$ {{$venda_paga_mes}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-light">
                    <div class="card-body">
                    <h5 class="card-title">Vendas em aberto</h5>
                        <p>R$ {{$venda_aberta_mes}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-light">
                    <div class="card-body">
                    <h5 class="card-title">Vendas totais</h5>
                        <p>R$ {{$venda_total_mes}}</p>
                    </div>
                </div>
            </div>  
        </div>  
        <br>
        <div class="row">
            <div class="col-sm-4">
                <div class="card bg-light">
                    <div class="card-body">
                    <h5 class="card-title">Balanço recebido</h5>
                        <p>R$ {{$balanco_pago_mes}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-light">
                    <div class="card-body">
                    <h5 class="card-title">Balanço em aberto</h5>
                        <p>R$ {{$balanco_aberto_mes}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card bg-light">
                    <div class="card-body">
                    <h5 class="card-title">Balanço total</h5>
                        <p>R$ {{$balanco_total_mes}}</p>
                    </div>
                </div>
            </div>  
        </div>
        <br>
        
        <h1>Ano: {{ ucfirst( Date::now()->locale('pt-BR')->format('Y')) }}</h1>
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Despesas pagas</h5>
                        <p>R$ {{$despesa_paga_ano}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Despesas em aberto</h5>
                        <p>R$ {{$despesa_aberta_ano}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Despesas totais</h5>
                        <p>R$ {{$despesa_total_ano}}</p>
                    </div>
                </div>
            </div>  
        </div>      
        <br>
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Vendas recebidas</h5>
                        <p>R$ {{$venda_paga_ano}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Vendas em aberto</h5>
                        <p>R$ {{$venda_aberta_ano}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Vendas totais</h5>
                        <p>R$ {{$venda_total_ano}}</p>
                    </div>
                </div>
            </div>  
        </div>  
        <br>
        <div class="row">
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Balanço recebido</h5>
                        <p>R$ {{$balanco_pago_ano}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Balanço em aberto</h5>
                        <p>R$ {{$balanco_aberto_ano}}</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Balanço total</h5>
                        <p>R$ {{$balanco_total_ano}}</p>
                    </div>
                </div>
            </div>  
        </div>
        <br>
        
    </div>
@endsection
