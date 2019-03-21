@extends('master')
@section('corpo')
    <br>
    <div class="container-fluid">
        <table class="table table-striped">
            <thead class="thead-dark">
                <th>Material</th>
                <th>Quantidade</th>
                <th>Estoque Baixo</th>
            </thead>
            <tbody class="resultado">
                @foreach ($produtos as $produto)
                <tr>
                    <td><a href="/produto/{{$produto->id}}" target="_blank">{{$produto->nome}}</a></td>
                    <td>{{$produto->quantidade}}</td>
                    <td>{{$produto->estoque_baixo}}</td>
                </tr>
                @endforeach  
            </tbody>
        </table>
    </div>
@endsection


