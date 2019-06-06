    @extends('master')
    @section('css')
        <link href="{{ asset('css/lider.css') }}" rel="stylesheet" />
        <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
        <link href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" rel="stylesheet" >
    @endsection
    @section('corpo')
        @if(session()->has('message.level'))
            <div class="msg alert alert-{{ session('message.level') }}"> 
            {!! session('message.content') !!}
            </div>
        @endif
        <div class="row">
            <div class="col-1"></div>
            <div class="col-8">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" autofocus name="busca" id="busca" onclick="this.select()" placeholder="Buscar">
                </div>
                <div class="tableFixHead">
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
                                        <input id="{{$produto->id}}" type="number" step="1" class="form-control" name="quantidade" >
                                    </div>
                                </td>
                            </tr>
                            @endforeach  
                        </tbody>
                    </table>
                </div>  
                <hr>
            </div>      
            <div class="col-3">
                <form method="POST" action="/pedido">
                    @csrf
                <div class="form-group">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text">Total R$</div>
                    </div>
                        <input type="number" step="0.01" style="color: green;" class="form-control form-control-lg" id="valor" name="valor" required>
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text">Pago R$</div>
                    </div>
                        <input type="number" step="0.01" class="form-control form-control-lg" id="valor_pago" name="valor_pago" required>
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                        <div class="input-group-text">Troco R$</div>
                    </div>
                        <input type="number" step="0.01" style="color: red;" class="form-control form-control-lg" id="troco" name="troco">
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <button type="submit" name="botao" class="btn btn-primary form-control btn-block">Finalizar</button>
                            </div>
                          <div class="col">
                                <button type="submit" name="botao" value="orcamento" class="btn btn-success form-control btn-block">Orçamento</button>
                            </div>
                        </div>
                      </div>
                </div>
            </div>
        </div>
        <br>
        <div class="row">
            {{-- Produtos --}}
            <div class="col-6" style="margin-left: 20px;">
                <h3>Carrinho</h3>
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
                                <tr>
                                    <td>{{$carrinho['produtoNome']}}</td>
                                    <td>
                                        <div class="qtd_cart" style="width: 60px;">
                                            <input id="q{{$carrinho['produtoId']}}" type="number" step="1" class="form-control" value="{{$carrinho['quantidade']}}">
                                        </div>
                                    </td>
                                    <td>@moeda($carrinho['preco'] * $carrinho['quantidade'])</td>
                                    <td><div style="cursor:pointer; margin-left:25px;"><i id="{{$carrinho['produtoId']}}" class="fas fa-minus-circle"></i></div></td>
                                    </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            {{-- Options --}}
            <div class="col-5" style="margin-top: 41px;">
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
                <div class="form-group row">
                    <label for="obs" class="col-sm-2 col-form-label"><b>Observação</b></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="obs" name="obs">
                    </div>
                  </div>
            </div>
        </form>
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

            var preco_carrinho = {{$preco_carrinho}};
            if (preco_carrinho > 0) { $('#valor').val(preco_carrinho);}

            //Remover msg
            setTimeout(function(){
                $( ".msg" ).remove();
            }, 3000);
        </script>
    @endsection
