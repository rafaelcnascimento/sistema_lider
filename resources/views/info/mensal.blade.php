@extends('painel')
@section('corpo')
    <div class="container">
        

        @foreach ($meses as $mes)
        <p><b>{{$mes['nome']}}</b>: {{$resultados[$mes['num']]}}</p><br>
        @endforeach
    </div>    
@endsection
