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
                <th>Código</th>
                <th>Material</th>
                <th>Quantidade</th>
                <th>Unidade</th>
                <th>Fornecedor</th>
                <th>Custo Inicial</th>
                <th>IPI</th>
                <th>ICMS</th>
                <th>Frete</th>
                <th>Custo Unitário</th>
                <th>Margem</th>
                <th>Custo Final</th>
                <th>Preço</th>
            </thead>
            <tbody class="resultado">
                @foreach ($produtos as $produto)
                <tr>
                    <td><a href="produto/{{$produto->id}}" target="_blank">{{$produto->nome}}</a></td>
                    <td>{{$produto->quantidade}}</td>
                    <td>{{$produto->unidade->nome}}</td>
                    <td><a href="fornecedor/{{$produto->getFornecedorId()}}" target="_blank">{{$produto->getFornecedorNome()}}</a></td>
                    <td>@moeda($produto->custo_inicial)</td>
                    <td>{{$produto->ipi}}%</td>
                    <td>{{$produto->icms}}%</td>
                    <td>{{$produto->frete}}%</td>
                    <td>@moeda($produto->custo_unitario)</td>
                    <td>{{$produto->margem}}%</td>
                    <td>@moeda($produto->custo_final)</td>
                    <td>@moeda($produto->preco)</td>
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
                url: '/produtoAjax',
                data: {
                    'search': $value
                },
                success: function(data) {
                    $('.resultado').html(data);
                }
            });
        })
    </script>
@endsection
