@extends('master')
@section('css')
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
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
                                    <select class="select-produto form-control{{ $errors->has('produto_id') ? ' is-invalid' : '' }}" id="produto_id1"  name="produto_id[]" required>
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
                                    <input id="quantidade" type="number" class="form-control{{ $errors->has('quantidade') ? ' is-invalid' : '' }}" name="quantidade[]" value="{{ old('quantidade') }}" required>
                            
                                    @if ($errors->has('quantidade'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('quantidade') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="mais">
                                
                            </div>   
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-success">
                                        {{ __('Salvar') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                        <br>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button class="btn btn-primary" id="add" value="1">
                                    {{ __('Adicionar produto') }}
                                </button>
                            </div>
                        </div> 

                    </div> 
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <div class="selectjs">
        <script>
                $('#produto_id1').select2();
        </script>
    </div>   
    <script>
        $(document).on('click','#add' ,function(event)
        {
            var $num = $(this).val();
            $num ++;

            $.ajax({
                type: 'get',
                url: '/entradaAjax',
                data: {
                    'num': $num
                },
                success: function(data) {
                    $('.mais').append(data);
                    $('#add').val($num);
                }
            });  

            $('.selectjs').append("<script>$('#produto_id"+$num+"').select2();<\/script>");
        });
    </script>
@endsection
