@extends('master')
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
                        <td>{{$produto->nome}}</td>
                        <td>{{$produto->unidade->nome}}</td>
                        <td>{{$produto->quantidade}}</td>
                        <td>@moeda($produto->preco)</td>
                        <td>
                            <div class="qtd" style="width: 110%;">
                                <input id="quantidade" type="text" class="form-control" name="quantidade">
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
                                <label for="cliente_id" class="col-md-4 col-form-label text-md-right">{{ __('Cliente') }}</label>  
                                <div class="col-md-2">
                                    <select class="form-control" id="cliente_id"  name="cliente_id" >
                                        <option selected="" disabled="">Selecione</option>
                                            @foreach ($clientes as $cliente)
                                                <option value="{{$cliente->id}}" {{ (old('cliente_id') == $cliente->id ? "selec    ted":"") }}>{{$cliente->nome}}</option>
                                            @endforeach
                                    </select>
                                </div>
                            </div>
                            <a href="/cliente-novo" target="_blank"  class="btn btn-primary" role="button" style="margin-bottom:8px;">
                                Novo Cliente
                            </a>
                           
                        </form>
                    </th>
                </thead>
                <tbody class="resultado">
                    {{-- @foreach ($produtos as $produto)
                    <tr>
                        <td>{{$produto->nome}}</td>
                        <td>{{$produto->unidade->nome}}</td>
                        <td>{{$produto->quantidade}}</td>
                        <td>@moeda($produto->preco)</td>
                        <td>
                            <div class="qtd" style="width: 110%;">
                                <input id="quantidade" type="text" class="form-control" name="quantidade">
                            </div>
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
    <script type="text/javascript">
        //Busca
        $('#busca').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '/checkoutAjax',
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('.resultado').html(data);
                }
            });
        })
        //Enter vira tab
        $('.qtd').on('keyup', function(e) {
            alert("Hello! I am an alert box!!"); 
        });
    </script>
@endsection
