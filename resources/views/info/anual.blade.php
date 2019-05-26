@extends('painel')
@section('corpo')
   <div class="container">
       @foreach ($anos as $ano)
           <a href="/painel/balanco-mensal/{{$ano->valor}}">{{$ano->valor}}</a> = {{$resultados[$ano->valor]}}<br>
       @endforeach
   </div>    
@endsection
