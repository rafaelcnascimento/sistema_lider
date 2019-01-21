@extends('master')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
@endsection
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
                    <div class="card-header">{{ __('Entrada de produtos') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/entrada">
                            @csrf

                            <div class="form-group row">
                                <label for="produto_id" class="col-md-4 col-form-label text-md-right">{{ __('*Produto') }}</label>
                            
                                <div class="col-md-6">
                                    <select class="select-produto form-control{{ $errors->has('produto_id') ? ' is-invalid' : '' }}" id="produto_id"  name="produto_id" required>
                                        @foreach ($produtos as $produto)
                                                <option value="{{$produto->id}}" {{ (old('produto_id') == $produto->id ? "selected":"") }}>{{$produto->codigo}} - {{$produto->nome}}</option>
                                        @endforeach
                                    </select> 
                            
                                    @if ($errors->has('produto_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('produto_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="quantidade" class="col-md-4 col-form-label text-md-right">{{ __('*Quantidade') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="quantidade" type="number" class="form-control{{ $errors->has('quantidade') ? ' is-invalid' : '' }}" name="quantidade" value="{{ old('quantidade') }}" required>
                            
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
                                    <input id="custo" type="number" class="form-control{{ $errors->has('custo') ? ' is-invalid' : '' }}" name="custo" value="{{ old('custo') }}" required>
                            
                                    @if ($errors->has('custo'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('custo') }}</strong>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select-produto').select2();

            $('#produto_id').select2('open');
        });
    </script>
@endsection
