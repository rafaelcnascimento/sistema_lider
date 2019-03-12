@extends('master')
@section('corpo')
    
    <div class="container">
        @if(session()->has('message.level'))
            <div class="alert alert-{{ session('message.level') }}"> 
            {!! session('message.content') !!}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Editar Unidade') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/unidade/{{$unidade->id}}">
                            @method('patch')
                            @csrf

                            <div class="form-group row">
                                <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('*Nome') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="nome" type="text" class="form-control{{$errors->has('nome') ? ' is-invalid' : '' }}" name="nome" value="{{ $unidade->nome }}" required autofocus>
                            
                                    @if ($errors->has('nome'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nome') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-5">
                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4" style="margin-left: 240px;">
                                            <button type="submit" class="btn btn-success">
                                                {{ __('Salvar') }}
                                            </button>
                                            </form>
                                        </div>
                                    </div>   
                                </div>
                                <form method="post" action="/unidade/{{$unidade->id}}" onSubmit="if(!confirm('Deletar unidade?')){return false;}">
                                    @method('delete')
                                    @csrf
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('Deletar') }}
                                        </button>
                                    </div>   
                                </form>  
                                </div>                 
                    </div>
                </div>
            </div>
        </div>
        <br>
        <h2>Produtos com essa unidade:</h2>
        <br>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <th>Material</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                </thead>
                <tbody class="resultado">
                    @foreach ($produtos as $produto)
                    <tr>
                        <td><a href="/produto/{{$produto->id}}" target="_blank">{{$produto->nome}}</a></td>
                        <td>{{$produto->quantidade}}</td>
                        <td>@moeda($produto->preco)</td>
                    </tr>
                    @endforeach  
                </tbody>
            </table>

        {{ $produtos->links() }}
    </div>
@endsection

