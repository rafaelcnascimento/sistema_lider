@extends('master')
@section('corpo')
    <br>
    
    @if(session()->has('message.level'))
        <div class="alert alert-{{ session('message.level') }}"> 
        {!! session('message.content') !!}
        </div>
    @endif

    <div class="container">
        <table class="table table-striped">
            <thead class="thead-dark">
                <th>Código</th>
                <th>Tipo</th>
                <th>Destinatário</th>
                <th>Descrição</th>
                <th>Valor</th>
                <th>Pago</th>
                <th>Arquivo</th>
                <th>Data</th>
            </thead>
            <tbody class="resultado">
                @foreach ($despesas as $despesa)
                <tr>
                    <td>
                        <a href="despesa/{{$despesa->id}}" target="_blank">{{$despesa->ano()}}_{{$despesa->id}}</a>
                    </td>
                    <td>{{$despesa->tipo->nome}}</td>
                    <td>{{$despesa->destinatario}}</td>
                    <td>{{$despesa->descricao}}</td>
                    <td>{{$despesa->valor}}</td>
                    <td>{{$despesa->pago}}</td>
                    <td></td>
                    <td>{{$despesa->created_at}}</td>
                </tr>

                @endforeach  
            </tbody>
        </table>
    </div>
    {{ $despesas->links() }}
@endsection


