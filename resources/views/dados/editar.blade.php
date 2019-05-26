@extends('painel')
@section('css')
@section('corpo')
<div class="container">
    @if(session()->has('message.level'))
        <div class="alert alert-{{ session('message.level') }}"> 
        {!! session('message.content') !!}
        </div>
    @endif

    <div class="card">
        <div class="card-header"><center>{{ __('Editar Dados') }}</center></div>
        <div class="card-body">
            <form method="POST" action="/painel/dados/{{$dados->id}}">
                @method('patch')
                @csrf

                <div class="form-group row">
                    <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('*Nome') }}</label>

                    <div class="col-md-6">
                        <input id="nome" type="text" class="form-control{{$errors->has('nome') ? ' is-invalid' : '' }}" name="nome" value="{{ $dados->nome }}" required >

                        @if ($errors->has('nome'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nome') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="razao_social" class="col-md-4 col-form-label text-md-right">{{ __('*Razão Social') }}</label>
                
                    <div class="col-md-6">
                        <input id="razao_social" type="text" class="form-control{{$errors->has('razao_social') ? ' is-invalid' : '' }}" name="razao_social" value="{{ $dados->razao_social }}" required >
                
                        @if ($errors->has('razao_social'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('razao_social') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="cpf_responsavel" class="col-md-4 col-form-label text-md-right">{{ __('*CPF responsável') }}</label>
                
                    <div class="col-md-6">
                        <input id="cpf_responsavel" type="text" class="form-control{{$errors->has('cpf_responsavel') ? ' is-invalid' : '' }}" name="cpf_responsavel" value="{{ $dados->cpf_responsavel }}" required >
                
                        @if ($errors->has('cpf_responsavel'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('cpf_responsavel') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>



                <div class="form-group row">
                    <label for="cnpj" class="col-md-4 col-form-label text-md-right">{{ __('*CNPJ') }}</label>
                
                    <div class="col-md-6">
                        <input id="cnpj" type="text" class="form-control{{$errors->has('cnpj') ? ' is-invalid' : '' }}" name="cnpj" value="{{ $dados->cnpj }}" required >
                
                        @if ($errors->has('cnpj'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('cnpj') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="lougradouro" class="col-md-4 col-form-label text-md-right">{{ __('*Logradouro') }}</label>
                
                    <div class="col-md-6">
                        <input id="lougradouro" type="text" class="form-control{{$errors->has('lougradouro') ? ' is-invalid' : '' }}" name="lougradouro" value="{{ $dados->lougradouro }}" required >
                
                        @if ($errors->has('lougradouro'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('lougradouro') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                    <div class="form-group row">
                        <label for="numero" class="col-md-4 col-form-label text-md-right">{{ __('*Número') }}</label>
                    
                        <div class="col-md-6">
                            <input id="numero" type="text" class="form-control{{$errors->has('numero') ? ' is-invalid' : '' }}" name="numero" value="{{ $dados->numero }}" required >
                    
                            @if ($errors->has('numero'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('numero') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="bairro" class="col-md-4 col-form-label text-md-right">{{ __('*Bairro') }}</label>
                    
                        <div class="col-md-6">
                            <input id="bairro" type="text" class="form-control{{$errors->has('bairro') ? ' is-invalid' : '' }}" name="bairro" value="{{ $dados->bairro }}" required >
                    
                            @if ($errors->has('bairro'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('bairro') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cidade" class="col-md-4 col-form-label text-md-right">{{ __('*Cidade') }}</label>
                    
                        <div class="col-md-6">
                            <input id="cidade" type="text" class="form-control{{$errors->has('cidade') ? ' is-invalid' : '' }}" name="cidade" value="{{ $dados->cidade }}" required >
                    
                            @if ($errors->has('cidade'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('cidade') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cep" class="col-md-4 col-form-label text-md-right">{{ __('*CEP') }}</label>
                    
                        <div class="col-md-6">
                            <input id="cep" type="text" class="form-control{{$errors->has('cep') ? ' is-invalid' : '' }}" name="cep" value="{{ $dados->cep }}" required >
                    
                            @if ($errors->has('cep'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('cep') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="estado" class="col-md-4 col-form-label text-md-right">{{ __('*Estado') }}</label>
                    
                        <div class="col-md-6">
                            <input id="estado" type="text" class="form-control{{$errors->has('estado') ? ' is-invalid' : '' }}" name="estado" value="{{ $dados->estado }}" required >
                    
                            @if ($errors->has('estado'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('estado') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="agencia" class="col-md-4 col-form-label text-md-right">{{ __('*Agencia') }}</label>
                    
                        <div class="col-md-6">
                            <input id="agencia" type="text" class="form-control{{$errors->has('agencia') ? ' is-invalid' : '' }}" name="agencia" value="{{ $dados->agencia }}" required >
                    
                            @if ($errors->has('agencia'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('agencia') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="conta" class="col-md-4 col-form-label text-md-right">{{ __('*Conta') }}</label>
                    
                        <div class="col-md-6">
                            <input id="conta" type="text" class="form-control{{$errors->has('conta') ? ' is-invalid' : '' }}" name="conta" value="{{ $dados->conta }}" required >
                    
                            @if ($errors->has('conta'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('conta') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="codigo_banco" class="col-md-4 col-form-label text-md-right">{{ __('*Código Banco') }}</label>
                    
                        <div class="col-md-6">
                            <input id="codigo_banco" type="text" class="form-control{{$errors->has('codigo_banco') ? ' is-invalid' : '' }}" name="codigo_banco" value="{{ $dados->codigo_banco }}" required >
                    
                            @if ($errors->has('codigo_banco'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('codigo_banco') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="telefone" class="col-md-4 col-form-label text-md-right">{{ __('*Telefone') }}</label>
                    
                        <div class="col-md-6">
                            <input id="telefone" type="text" class="form-control{{$errors->has('telefone') ? ' is-invalid' : '' }}" name="telefone" value="{{ $dados->telefone }}" required >
                    
                            @if ($errors->has('telefone'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('telefone') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="celular" class="col-md-4 col-form-label text-md-right">{{ __('*Celular') }}</label>
                    
                        <div class="col-md-6">
                            <input id="celular" type="text" class="form-control{{$errors->has('celular') ? ' is-invalid' : '' }}" name="celular" value="{{ $dados->celular }}" required >
                    
                            @if ($errors->has('celular'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('celular') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success">
                                {{ __('Salvar') }}
                            </button>
                        </div>
                    </div>
                </div>
            </form>    
        </div>
    </div>
</div>      
@endsection
