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
                    <div class="card-header">{{ __('Editar Despesa') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/despesa/{{$despesa->id}}">
                            @method('patch')
                            @csrf

                            <div class="form-group row">
                                <label for="destinatario" class="col-md-4 col-form-label text-md-right">{{ __('*Destinatário') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="destinatario" type="text" class="form-control{{$errors->has('destinatario') ? ' is-invalid' : '' }}" name="destinatario" value="{{ $despesa->destinatario }}" required autofocus>
                            
                                    @if ($errors->has('destinatario'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('destinatario') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="descricao" class="col-md-4 col-form-label text-md-right">{{ __('Descrição') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="descricao" type="text" class="form-control{{$errors->has('descricao') ? ' is-invalid' : '' }}" name="descricao" value="{{ $despesa->descricao }}" required autofocus>
                            
                                    @if ($errors->has('descricao'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('descricao') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="valor" class="col-md-4 col-form-label text-md-right">{{ __('*Valor') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="valor" type="text" class="form-control{{$errors->has('valor') ? ' is-invalid' : '' }}" name="valor" value="{{ $despesa->valor }}" required autofocus>
                            
                                    @if ($errors->has('valor'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('valor') }}</strong>
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
                                <form method="post" action="/despesa/{{$despesa->id}}" onSubmit="if(!confirm('Deletar despesa?')){return false;}">
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

