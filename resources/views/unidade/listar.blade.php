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
                <th></th>
            </thead>
            <tbody class="resultado">
                @foreach ($unidades as $unidade)
                <tr>
                    <td style="text-align: center; vertical-align: middle;">
                        <a href="unidade/{{$unidade->id}}">{{$unidade->nome}}</a>
                    </td>
                </tr>
                @endforeach  
            </tbody>
        </table>
    </div>
    {{ $unidades->links() }}
@endsection


