@extends('master')
@section('css')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
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
                    <input type="text" class="form-control" autofocus name="busca" id="busca" onclick="this.select()" placeholder="Buscar">
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
            <div class="valores">
                    {{-- Total --}}
                    <form method="POST" action="/pedido">
                        @csrf
                    <div class="form-group row" style="font-size:40px" >
                        <label for="valor" class="col-md-4 col-form-label text-md-left">{{ __('Total: R$') }}</label>
                    
                        <div class="col-md-4">
                            <input id="valor" type="text" style="margin-left: -45%;" class="form-control no-border valor" name="valor" required>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4 ">
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
                    {{-- Valor Pago --}}
                    <div class="form-group row" style="font-size:40px" >
                        <label for="valor_pago" class="col-md-4 col-form-label text-md-left">{{ __('Pago: R$') }}</label>
                    
                        <div class="col-md-4">
                            <input id="valor_pago" type="text" style="margin-left: -45%;" class="form-control no-border valor" name="valor_pago" >
                        </div>
                    </div>
                    {{-- Troco --}}
                    <div class="form-group row" style="font-size:40px" >
                        <label for="troco" class="col-md-4 col-form-label text-md-left">{{ __('Troco:R$') }}</label>
                    
                        <div class="col-md-4">
                            <input id="troco" type="text" style="margin-left: -45%;" class="form-control no-border valor" name="troco" >
                        </div>
                    </div>      
                    {{-- listagem --}}
                    <table class="table table-striped">
                        <thead class="thead-dark">
                            <th class="form-inline">
                                <div class="form-group mx-sm-3 mb-2">
                                    <select class="select-cliente form-control" id="cliente_id"  name="cliente_id" >
                                        <option value="" >Cliente</option>
                                    </select> 
                                </div>
                                <a href="/cliente-novo" target="_blank" class="btn btn-primary ml-auto" role="button" style="margin-bottom:8px;">
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
                                {{-- Saldo --}}
                                <div class="saldo">
                                </div>
                                
                                <br>
                            </th>
                        </thead>
                    </table>
                    {{-- Parcelas --}}
                    <div class="parcelas">
                    </div>   

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="via_cliente" id="via_cliente" value="1">
                        <label class="form-check-label" for="via_cliente"><h3>Gerar imagem p/ Cliente</h3></label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="entrega" id="entrega" value="2">
                        <label class="form-check-label" for="entrega"><h3>Entrega</h3></label>
                    </div>
                </form>
            </div>    
            <table class="table table-striped">
                <thead class="thead-dark">
                    <th>Material</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                    <th>Remover</th>
                </thead>
                <tbody class="carrinho">
                    @if(!is_null(Session('carrinho')))
                        @foreach (Session('carrinho') as $key => $carrinho)
                            <tr id=row{{$carrinho['produtoId']}}>
                                <td>{{$carrinho['produtoNome']}}</td>
                                <td>{{$carrinho['quantidade']}}</td>
                                <td>@moeda($carrinho['preco'] * $carrinho['quantidade'])</td>
                                <td>
                                    <div id="{{$carrinho['produtoId']}}" style="cursor:pointer; margin-left:25px;"><i class="fas fa-minus-circle"></i></div>
                                </td>
                            </tr>
                        @endforeach
                    @endif
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
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="{{ asset('js/ajaxCarrinho.js') }}"></script>
    <script type="text/javascript">
        //Select cliente
        $(document).ready(function() {
            $('.select-cliente').select2({ width: '275px', placeholder: "Informe o cliente" });
        });

        //Lista clientes
        $('#cliente_id').on('select2:open', function (e) 
        {
            $.ajax({
                type: 'get',
                url: '/clientesAjax',
                success: function(data) {
                    $('#cliente_id').html(data);
                }
            });
        });

        $("#cliente_id").change(function() 
        { 
            id = $(this).val();
            
            $.ajax({
                type: 'get',
                url: '/saldoAjax',
                data: {
                    'id': id
                },
                success: function(data) {
                    $('.saldo').html(data);
                }
            });
        });


        var preco_carrinho = {{$preco_carrinho}};
        if (preco_carrinho > 0) { $('#valor').val(preco_carrinho);}



    </script>

@endsection
