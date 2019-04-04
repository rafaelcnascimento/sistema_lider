@extends('master')
@section('corpo')
    <br>
    
    <div class="container">
        @if(session()->has('message.level'))
            <div class="alert alert-{{ session('message.level') }}"> 
            {!! session('message.content') !!}
            </div>
        @endif

        <a href="/tipoDespesa-nova" class="btn btn-success" role="button">Criar Novo Tipo de Despesa</a>
        <br><br>

        <table class="table table-striped">
            <thead class="thead-dark">
                <th></th>
            </thead>
            <tbody class="resultado">
                @foreach ($tipoDespesas as $tipoDespesa)
                <tr>
                    <td style="text-align: center; vertical-align: middle;">
                        <a href="tipoDespesa/{{$tipoDespesa->id}}">{{$tipoDespesa->nome}}</a>
                    </td>
                </tr>
                @endforeach  
            </tbody>
        </table>
    </div>
    {{ $tipoDespesas->links() }}
@endsection


