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
                <th>Celular</th>
                <th>Endereço</th>
            </thead>
            <tbody class="resultado">
                @foreach ($fornecedores as $fornecedor)
                <tr>
                    <td><a href="fornecedor/{{$fornecedor->id}}">{{$fornecedor->nome}}</a></td>
                    <td>{{$fornecedor->telefone}}</td>
                    <td>{{$fornecedor->celular}}</td>
                    <td>{{$fornecedor->endereco}}</td>
                </tr>
                @endforeach  
            </tbody>
        </table>
    </div>
    {{ $fornecedores->links() }}
@endsection

@section('js')
    <script type="text/javascript">
        //Busca
        $('#busca').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '/fornecedorAjax',
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
