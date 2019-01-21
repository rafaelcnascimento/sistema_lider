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
                    <div class="card-header">{{ __('Editar  Entrada') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/entrada/{{$entrada->id}}">
                            @method('patch')
                            @csrf

                            <div class="form-group row">
                                <label for="produto" class="col-md-4 col-form-label text-md-right">{{ __('*Produto') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="produto" type="text" class="form-control{{ $errors->has('produto') ? ' is-invalid' : '' }}" name="produto" value="{{ $entrada->produto->nome }}" disabled>
                            
                                    @if ($errors->has('produto'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('produto') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="quantidade" class="col-md-4 col-form-label text-md-right">{{ __('*Quantidade') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="quantidade" type="text" class="form-control{{$errors->has('quantidade') ? ' is-invalid' : '' }}" name="quantidade" value="{{ $entrada->quantidade }}">
                            
                                    @if ($errors->has('quantidade'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('quantidade') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="custo" class="col-md-4 col-form-label text-md-right">{{ __('*Custo total') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="custo" type="text" class="form-control{{$errors->has('custo') ? ' is-invalid' : '' }}" name="custo" value="{{ $entrada->custo }}" >
                            
                                    @if ($errors->has('custo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('custo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="data" class="col-md-4 col-form-label text-md-right">{{ __('Data') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="data" type="text" class="form-control{{$errors->has('data') ? ' is-invalid' : '' }}" name="data" value="{{ $entrada->created_at }}" disabled>
                            
                                    @if ($errors->has('data'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('data') }}</strong>
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
                                <form method="post" action="/entrada/{{$entrada->id}}" >
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
    </div>
@endsection


