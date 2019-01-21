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
                <th>Unidade</th>
                <th>Preço</th>
            </thead>
            <tbody class="resultado">
                @foreach ($produtos as $produto)
                <tr>
                    <td>{{$produto->nome}}</td>
                    <td>{{$produto->unidade->nome}}</td>
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
