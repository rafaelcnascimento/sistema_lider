@extends('painel')
@section('corpo')
    <br>

    <div class="container">
            @if(session()->has('message.level'))
                <div class="alert alert-{{ session('message.level') }}"> 
                {!! session('message.content') !!}
                </div>
            @endif
            <h3>Colocar o arquivo excel na pasta "Importação" na Área de Trabalho</h3>
            <h3>Com o nome 'produtos'</h3>

            <div>
                <form method="GET" action="/importar" onSubmit="if(!confirm('Tem certeza?')){return false;}">
                    @method('delete')
                    @csrf
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-danger">
                            {{ __('Importar do excel') }}
                        </button>
                    </div>   
                </form>   
            </div>    

    </div>
@endsection


