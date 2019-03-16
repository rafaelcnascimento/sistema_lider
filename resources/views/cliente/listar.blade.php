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
                <th>Nome</th>
                <th>Telefone</th>
                <th>Documento</th>
                <th>Endereço</th>
                <th>Saldo</th>
            </thead>
            <tbody class="resultado">
                @foreach ($clientes as $cliente)
                <tr>
                    <td><a href="cliente/{{$cliente->id}}">{{$cliente->nome}}</a></td>
                    <td>{{$cliente->telefone}}</td>
                    <td>{{$cliente->documento}}</td>
                    <td>{{$cliente->logradouro}} {{$cliente->numero}}</td> 
                    <td>{{$cliente->saldo}}</td>
                </tr>
                @endforeach  
            </tbody>
        </table>
    </div>
    {{ $clientes->links() }}
@endsection

@section('js')
    <script type="text/javascript">
        //Busca
        $('#busca').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '/clienteAjax',
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
