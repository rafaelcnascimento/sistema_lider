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
                <th>Editar</th>
            </thead>
            <tbody class="resultado">
                @foreach ($clientes as $cliente)
                <tr>
                    <td>{{$cliente->nome}}</td>
                    <td>{{$cliente->telefone}}</td>
                    <td>{{$cliente->documento}}</td>
                    <td>{{$cliente->logradouro}} {{$cliente->numero}}</td>
                    <td>
                        <a href="cliente/{{$cliente->id}}">
                            <button type="submit" class="btn btn-primary custom-btn">
                                {{ __('Editar') }}
                            </button>
                        </a>
                    </td>    
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
