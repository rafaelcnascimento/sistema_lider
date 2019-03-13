@extends('master')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" rel="stylesheet" >
@endsection
@section('corpo')
<div class="container-fluid">
    @if(session()->has('message.level'))
        <div class="alert alert-{{ session('message.level') }}"> 
        {!! session('message.content') !!}
        </div>
    @endif
    <div class="row">
        <div class="col-6">
            <center>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="busca" id="busca" onclick="this.select()" placeholder="Buscar">
                </div>
            </center>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <th class="w-50">Material</th>
                    <th>Unidade</th>
                    <th>Quantidade</th>
                    <th class="w-25">Preço</th>
                    <th>Qtd</th>
                </thead>
                <tbody class="resultado" id="lista">
                    @foreach ($produtos as $produto)
                    <tr id="row{{$produto->id}}">
                        <td style="display:none;">{{$produto->id}}</td>
                        <td>{{$produto->nome}}</td>
                        <td>{{$produto->unidade->nome}}</td>
                        <td>{{$produto->quantidade}}</td>
                        <td>@moeda($produto->preco)</td>
                        <td>
                            <div class="qtd" style="width: 60px;">
                                <input id="{{$produto->id}}" type="text" class="form-control" name="quantidade" >
                            </div>
                        </td>
                    </tr>
                    @endforeach  
                </tbody>
            </table>
        </div>
        <div class="col-6">
            {{-- Total --}}
            <form method="POST" action="/pedido">
                @csrf
            <div class="form-group row" style="font-size:40px" >
                <label for="valor" class="col-md-4 col-form-label text-md-right">{{ __('Total R$') }}</label>
            
                <div class="col-md-4">
                    <input id="valor" type="text" class="form-control no-border valor" name="valor" required>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" name="botao" value="orcamento" class="btn btn-success">
                            {{ __('Orcamento') }}
                        </button>
                    </div>
                </div>
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" name="botao" class="btn btn-primary">
                            {{ __('Finalizar') }}
                        </button>
                    </div>
                </div>
            </div>
            {{-- listagem --}}
            <table class="table table-striped">
                <thead class="thead-dark">
                    <th class="form-inline">
                        <div class="form-group mx-sm-3 mb-2">
                            <select class="select-cliente form-control" id="cliente_id"  name="cliente_id" >
                                <option value="" >Cliente</option>
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
                                <option value="1" disabled>Dinheiro, à vista</option>
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
            <div class="parcelas">
                {{-- <div class="form-group row">
                    <label for="parcelas" class="col-md-4 col-form-label text-md-right"><b>*Número de Parcelas</b></label>
                    <div class="col-md-1">
                        <input id="parcelas" type="text" class="form-control{{$errors->has('parcelas') ? ' is-invalid' : '' }}" name="parcelas" value="{{ $produto->parcelas }}" required autofocus>
                    </div>
                </div> --}}
            </div>   

            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="via_cliente" value="1">
                <label class="form-check-label" for="via_cliente"><h3>Gerar imagem p/ Cliente</h3></label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" name="entrega" value="2">
                <label class="form-check-label" for="entrega"><h3>Entrega</h3></label>
            </div>

            <table class="table table-striped">
                <thead class="thead-dark">
                    <th>Material</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Remover</th>
                </thead>
                <tbody class="carrinho">
                    {{-- @foreach ($produtos as $produto)
                    <tr id=row{{$produto->id}}>
                        <td>{{$produto->nome}}</td>
                        <td>{{$produto->quantidade}}</td>
                        <td>@moeda($produto->preco)</td>
                        <td>
                            <div id="{{$produto->id}}" style="cursor:pointer; margin-left:25px;"><i class="fas fa-minus-circle"></i></div>
                        </td>
                    </tr>
                    @endforeach   --}}
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
            $('.select-cliente').select2({ width: '275px' });
        });

        //Input parcelas
        $('#pagamento_id').change(function () { 
            var pagamento = $('#pagamento_id option:selected').val();
            if (pagamento == 7) 
            {
                $('.parcelas').html('<div class="form-group row">'+
                    '<label for="parcelas" class="col-md-4 col-form-label text-md-right"><b>*Número de Parcelas</b></label>'+
                    '<div class="col-md-1">'+
                        '<input id="parcelas" type="text" class="form-control" name="parcelas" required autofocus>'+
                    '</div>'+
                '</div>');
            }
            else { $('.parcelas').html('')}
        });
        
    </script>
@endsection
