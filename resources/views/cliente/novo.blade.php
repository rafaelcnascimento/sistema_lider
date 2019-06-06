@extends('master')
@section('corpo')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Novo Cliente') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/cliente">
                            @csrf

                            <div class="form-group row">
                                <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('*Nome') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="nome" type="text" class="form-control{{$errors->has('nome') ? ' is-invalid' : '' }}" name="nome" value="{{ old('nome') }}"  autofocus required>
                            
                                    @if ($errors->has('nome'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nome') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="saldo" class="col-md-4 col-form-label text-md-right">{{ __('Saldo') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="saldo" type="number" step="0.01" class="form-control{{ $errors->has('saldo') ? ' is-invalid' : '' }}" name="saldo" value="{{ old('saldo') }}" required>
                            
                                    @if ($errors->has('saldo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('saldo') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="telefone" class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="telefone" type="text" class="form-control{{$errors->has('telefone') ? ' is-invalid' : '' }}" name="telefone" value="{{ old('telefone') }}">
                            
                                    @if ($errors->has('telefone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('telefone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="celular" class="col-md-4 col-form-label text-md-right">{{ __('Celular') }}</label>

                                <div class="col-md-6">
                                    <input id="celular" type="text" class="form-control{{$errors->has('celular') ? ' is-invalid' : '' }}" name="celular" value="{{ old('celular') }}">

                                    @if ($errors->has('celular'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('celular') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="documento" class="col-md-4 col-form-label text-md-right">{{ __('CPF/CNPJ') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="documento" type="text" class="form-control{{ $errors->has('documento') ? ' is-invalid' : '' }}" name="documento" value="{{ old('documento') }}" >
                            
                                    @if ($errors->has('documento'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('documento') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="logradouro" class="col-md-4 col-form-label text-md-right">{{ __('Logradouro') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="logradouro" type="text" class="form-control{{ $errors->has('logradouro') ? ' is-invalid' : '' }}" name="logradouro" value="{{ old('logradouro') }}" >
                            
                                    @if ($errors->has('logradouro'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('logradouro') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="numero" class="col-md-4 col-form-label text-md-right">{{ __('Número') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="numero" type="text" class="form-control{{ $errors->has('numero') ? ' is-invalid' : '' }}" name="numero" value="{{ old('numero') }}" >
                            
                                    @if ($errors->has('numero'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('numero') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="complemento" class="col-md-4 col-form-label text-md-right">{{ __('Complemento') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="complemento" type="text" class="form-control{{ $errors->has('complemento') ? ' is-invalid' : '' }}" name="complemento" value="{{ old('complemento') }}" >
                            
                                    @if ($errors->has('complemento'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('complemento') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="bairro" class="col-md-4 col-form-label text-md-right">{{ __('Bairro') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="bairro" type="text" class="form-control{{ $errors->has('bairro') ? ' is-invalid' : '' }}" name="bairro" value="{{ old('bairro') }}" >
                            
                                    @if ($errors->has('bairro'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('bairro') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cep" class="col-md-4 col-form-label text-md-right">{{ __('CEP') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="cep" type="text" class="form-control{{ $errors->has('cep') ? ' is-invalid' : '' }}" name="cep" value="{{ old('cep') }}" >
                            
                                    @if ($errors->has('cep'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cep') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cidade" class="col-md-4 col-form-label text-md-right">{{ __('Cidade') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="cidade" type="text" class="form-control{{ $errors->has('cidade') ? ' is-invalid' : '' }}" name="cidade" value="{{ old('cidade') }}" >
                            
                                    @if ($errors->has('cidade'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('cidade') }}</strong>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
        
    <script type="text/javascript">
    $(window).on('load',function()
    {
       var phones = [{ "mask": "(##) ####-####"}, { "mask": "(##) #####-####"}];
        $('#telefone').inputmask({ 
            mask: phones, 
            greedy: false, 
            definitions: { '#': { validator: "[0-9]", cardinality: 1}} 
        });

        $('#celular').inputmask({ 
            mask: phones, 
            greedy: false, 
            definitions: { '#': { validator: "[0-9]", cardinality: 1}} 
        });
    });
    </script>
@endsection
