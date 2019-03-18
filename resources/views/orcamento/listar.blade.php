@extends('master')
@section('corpo')
    <br>
    @if(session()->has('message.level'))
        <div class="alert alert-{{ session('message.level') }}"> 
        {!! session('message.content') !!}
        </div>
    @endif
    
    </center>
    {{-- Filtrar depois por ano e mes --}}
    <br>
    <div class="container-fluid">
        <table class="table table-striped">
            <thead class="thead-dark">
                <th>Código</th>
                <th>Cliente</th>
                <th>Valor</th>
                <th>Data</th>
                <th>Img Orcamento</th>
                <th>Realizar Pedido</th>
            </thead>
        <tbody class="resultado">
            @foreach ($orcamentos as $orcamento)
                <tr>
                    <td>
                        <a href="orcamento/{{$orcamento->id}}" target="_blank">{{$orcamento->ano()}}_{{$orcamento->id}}</a>
                    </td>
                <td>
                @if(empty($orcamento->cliente->id))
                @else
                    <a href="cliente/{{$orcamento->cliente->id}}" target="_blank">{{$orcamento->cliente->nome}}</a>
                @endif
                </td>
                <td>R${{$orcamento->valor}}</td>
                <td>{{$orcamento->created_at}}</td>
                <td>
                    <a href="/redirect-orcamento/{{$orcamento->id}}&1" target="_blank" class="btn btn-primary" role="button">Gerar</a>
                </td>
                <td>
                    <a href="/orcamento-converter/{{$orcamento->id}}" class="btn btn-primary" role="button">Pedido</a>
                </td>
                </tr>
            @endforeach    
        </tbody>
    </table>
    </div>
    
    {{ $orcamentos->links() }}
    
@endsection
    

