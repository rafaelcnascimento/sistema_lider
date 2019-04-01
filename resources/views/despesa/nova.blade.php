@extends('master')
@section('corpo')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Nova Despesa') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/despesa">
                            @csrf

                            <div class="form-group row">
                                <label for="tipo_despesa_id" class="col-md-4 col-form-label text-md-right">{{ __('Tipo') }}</label>
                                
                                <div class="col-md-6">
                                    <select class="form-control{{ $errors->has('tipo_despesa_id') ? ' is-invalid' : '' }}" id="tipo_despesa_id"  name="tipo_despesa_id" >
                                
                                        <option selected="" disabled="">Selecione</option>
                                            @foreach ($tipos as $tipo)
                                                <option value="{{$tipo->id}}" {{ (old('tipo_despesa_id') == $tipo->id ? "selected":"") }}>{{$tipo->nome}}</option>
                                            @endforeach
                                    </select>
                                    @if ($errors->has('tipo_despesa_id'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('tipo_despesa_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="destinatario" class="col-md-4 col-form-label text-md-right">{{ __('*Destinatário') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="destinatario" type="text" class="form-control{{$errors->has('destinatario') ? ' is-invalid' : '' }}" name="destinatario" value="{{ old('destinatario') }}" required>
                            
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
                                    <input id="descricao" type="text" class="form-control{{$errors->has('descricao') ? ' is-invalid' : '' }}" name="descricao" value="{{ old('descricao') }}" >
                            
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
                                    <input id="valor" type="text" class="form-control{{$errors->has('valor') ? ' is-invalid' : '' }}" name="valor" value="{{ old('valor') }}" required>
                            
                                    @if ($errors->has('valor'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('valor') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            {{-- Filé aqui --}}
                           
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

