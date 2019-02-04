@extends('master')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
@section('corpo')
<div class="container-fluid">
    <div class="row">
        <div class="col-6">
            <center>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="busca" id="busca" placeholder="Buscar">
                </div>
            </center>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <th class="w-50">Material</th>
                    <th>Unidade</th>
                    <th>Estoque</th>
                    <th class="w-25">Preço</th>
                    <th>Qtd</th>
                </thead>
                <tbody class="resultado">
                    @foreach ($produtos as $produto)
                    <tr>
                        <td style="display:none;">{{$produto->id}}</td>
                        <td>{{$produto->nome}}</td>
                        <td>{{$produto->unidade->nome}}</td>
                        <td>{{$produto->quantidade}}</td>
                        <td>@moeda($produto->preco)</td>
                        <td>
                            <div class="qtd" style="width: 60px;">
                                <input id="qtd{{$produto->id}}" type="text" class="form-control" name="quantidade" >
                            </div>
                        </td>
                    </tr>
                    @endforeach  
                </tbody>
            </table>
        </div>
        <div class="col-6">
            {{-- Total --}}
            <div class="form-group row" style="font-size:40px" >
                <label for="custo" class="col-md-4 col-form-label text-md-right">{{ __('Total R$') }}</label>
            
                <div class="col-md-4">
                    <input id="custo" type="text" class="form-control no-border valor" name="custo" value="12,00" required>
                </div>
            </div>
            {{-- listagem --}}
            <table class="table table-striped">
                <thead class="thead-dark">
                    <th>
                        <form class="form-inline">
                          <div class="form-group mx-sm-3 mb-2">
                                <select class="select-cliente form-control" id="cliente_id"  name="cliente_id" required>
                                    <option>Cliente</option>
                                    @foreach ($clientes as $cliente)
                                            <option value="{{$cliente->id}}">{{$cliente->nome}}</option>
                                    @endforeach
                                </select> 
                            </div>
                            <a href="/cliente-novo" target="_blank" class="btn btn-primary ml-auto " role="button" style="margin-bottom:8px;">
                            Novo Cliente
                            </a>

                            <div class="form-group mx-sm-3 mb-2">
                                <select class="form-control" id="pagamento_id"  name="pagamento_id" required>
                                    <option disabled>Dinheiro, à vista</option>
                                    @foreach ($pagamentos as $pagamento)
                                        <option value="{{$pagamento->id}}">{{$pagamento->nome}}</option>
                                    @endforeach
                                </select> 
                            </div>
                            <div class="ml-auto">
                                <input id="desconto" type="text" class="form-control" name="desconto" placeholder="Desc"
                                style="margin-bottom: 8px; width: 80px;">
                            </div>
                    </th>
                </thead>
            </table>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <th>Material</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                </thead>
                <tbody class="resultado">
                    @foreach ($produtos as $produto)
                    <tr>
                        <td>{{$produto->nome}}</td>
                        <td>{{$produto->quantidade}}</td>
                        <td>@moeda($produto->preco)</td>
                    </tr>
                    @endforeach  
                </tbody>
            </table>

        </div>
    </div>
</div>    
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="{{ asset('js/ajaxCarrinho.js') }}"></script>
    <script type="text/javascript">
        //Select cliente
        $(document).ready(function() {
            $('.select-cliente').select2();
        });

        // $('.qtd').on('keydown', function(e){
        //     var value=$("td input").attr("id");
        //     alert(value);
        // });
    </script>
@endsection
