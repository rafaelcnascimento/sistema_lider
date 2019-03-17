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
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Custo Total</th>
                <th>Data</th>
                <th>Editar</th>
            </thead>
            <tbody class="resultado">
                @foreach ($entradas as $entrada)
                <tr>
                    <td><a href="/produto/{{$entrada->produto->id}}" target="_blank">{{$entrada->produto->nome}}</a></td>
                    <td>{{$entrada->quantidade}}</td>
                    <td>R${{$entrada->custo}}</td>
                    <td>{{$entrada->created_at}}</td>
                    <td>
                        <a href="entrada/{{$entrada->id}}">
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
    {{ $entradas->links() }}
@endsection

@section('js')
    <script type="text/javascript">
        //Busca
        $('#busca').on('keyup', function() {
            $value = $(this).val();
            $.ajax({
                type: 'get',
                url: '/entradaAjax',
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
