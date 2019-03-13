@extends('master')
@section('corpo')
    <br>
    @if(session()->has('message.level'))
        <div class="alert alert-{{ session('message.level') }}"> 
        {!! session('message.content') !!}
        </div>
    @endif
    <center>
        <div class="form-group has-feedback" style="width: 50%">
            <input type="text" class="form-control" name="busca" id="busca" placeholder="Buscar">
        </div>
    </center>
    <br>
    <div class="container-fluid">
        <table class="table table-striped">
            <thead class="thead-dark">
                <th>Material</th>
                <th>Quantidade</th>
                <th>Unidade</th>
                <th>Fornecedor</th>
                <th>Código de Barras</th>
                <th>Remover</th>
            </thead>
            <tbody class="resultado">
                @foreach ($produtos as $produto)
                <tr>
                    <td><a href="/produto/{{$produto->id}}" target="_blank">{{$produto->nome}}</a></td>
                    <td style="width: 10%">
                        <input id="quantidade{{$produto->id}}" type="text" class="form-control qtd" name="quantidade" >
                    </td>
                    <td>{{$produto->unidade->nome}}</td>
                    <td><a href="/fornecedor/{{$produto->getFornecedorId()}}" target="_blank">{{$produto->getFornecedorNome()}}</a></td>
                    <td style="width: 20%">
                        <input id="codigo{{$produto->id}}" type="text" class="form-control cb" name="codigo" >
                    </td>
                    <td>
                        <form method="post" action="/produto/{{$produto->id}}" onSubmit="if(!confirm('Deletar produto?')){return false;}">
                            @method('delete')
                            @csrf
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-danger">
                                    {{ __('Deletar') }}
                                </button>
                            </div>   
                        </form>   
                    </td>
                </tr>
                @endforeach  
            </tbody>
        </table>
    </div>
    {{ $produtos->links() }}
@endsection

@section('js')
    <script type="text/javascript">
        //Busca
        $('#busca').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '/estocadorAjax',
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('.resultado').html(data);
                }
            });
        })
        //Atualizar qtd
        $(document).on('keyup','.qtd' ,function(event)
        {
            var quantidade = $(this).val();
            var id = $(this).attr('id').replace('quantidade','');

            $.ajax({
                type: 'get',
                url: '/estocadorQuantidadeAjax',
                data: {
                    'quantidade': quantidade,
                    'id' : id
                },
            });
        });

        //Atualizar código de barras
        $(document).on('keyup','.cb' ,function(event)
        {
            var codigo = $(this).val();
            var id = $(this).attr('id').replace('codigo','');

            $.ajax({
                type: 'get',
                url: '/estocadorCodigoAjax',
                data: {
                    'codigo': codigo,
                    'id' : id
                },
            });
        });
    </script>
@endsection
