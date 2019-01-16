@extends('master')
@section('corpo')

<div class="container-fluid">
    <form method="POST" action="/produto/{{$produto->id}}">
        @method('patch')
        @csrf
        <div class="row">
            <div class="col">
                {{-- Lado esquerdo    --}}
                @if(session()->has('message.level'))
                    <div class="alert alert-{{ session('message.level') }}"> 
                    {!! session('message.content') !!}
                    </div>
                @endif

                <div class="form-group row">
                    <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('*Nome') }}</label>
                    
                    <div class="col-md-6">
                        <input id="nome" type="text" class="form-control{{$errors->has('nome') ? ' is-invalid' : '' }}" name="nome" value="{{ $produto->nome }}" required autofocus>
                    
                        @if ($errors->has('nome'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('nome') }}</strong>
                            </span>
                        @endif
                    </div>
                
                </div>
                <div class="form-group row">
                    <label for="codigo" class="col-md-4 col-form-label text-md-right">{{ __('Código de Barras') }}</label>
                    
                    <div class="col-md-6">
                        <input id="codigo" type="text" class="form-control{{ $errors->has('codigo') ? ' is-invalid' : '' }}" name="codigo" value="{{ $produto->codigo }}" >
                    
                        @if ($errors->has('codigo'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('codigo') }}</strong>
                            </span>
                        @endif
                    </div>
                
                </div>
                <div class="form-group row">
                    <label for="fornecedor_id" class="col-md-4 col-form-label text-md-right">{{ __('Fornecedor') }}</label>
                    
                    <div class="col-md-6">
                        <select class="form-control{{ $errors->has('fornecedor_id') ? ' is-invalid' : '' }}" id="fornecedor_id"  name="fornecedor_id" >
                    
                            @if(!$produto->fornecedor_id)
                            <option selected="" disabled="">Selecione</option>
                            @endif
                            @foreach ($fornecedores as $fornecedor)
                                @if($fornecedor->id == $produto->fornecedor_id)
                                    <option  selected="" value="{{$fornecedor->id}}" {{ (old('fornecedor_id') == $fornecedor->id ? "selec    ted":"") }}>{{$fornecedor->nome}}</option>
                                @else
                                    <option value="{{$fornecedor->id}}" {{ (old('fornecedor_id') == $fornecedor->id ? "selec    ted":"") }}>{{$fornecedor->nome}}</option>
                                @endif
                            @endforeach

                        </select>
                        @if ($errors->has('fornecedor_id'))
                            <span class="invalid-feedback">
                                <strong>{{ $errors->first('fornecedor_id') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="unidade_id" class="col-md-4 col-form-label text-md-right">{{ __('*Unidade') }}</label>
                    
                    <div class="col-md-6">
                        <select class="form-control{{ $errors->has('unidade_id') ? ' is-invalid' : '' }}" id="unidade_id"  name="unidade_id" required>
        
                            @foreach ($unidades as $unidade)
                                @if($unidade->id == $produto->unidade_id)
                                    <option selected="" value="{{$unidade->id}}" {{ (old('unidade_id') == $unidade->id ? "selected":"")  }}>{{$unidade->nome}}</option>
                                @else
                                    <option value="{{$unidade->id}}" {{ (old('unidade_id') == $unidade->id ? "selected":"")  }}>{{$unidade->nome}}</option>
                                @endif
                            @endforeach
                        </select>
                        
                        @if ($errors->has('unidade_id'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('unidade_id') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="form-group row">
                    <label for="quantidade" class="col-md-4 col-form-label text-md-right">{{ __('Quantidade') }}</label>
                    
                    <div class="col-md-6">
                        <input id="quantidade" type="text" class="form-control{{ $errors->has('quantidade') ? ' is-invalid' : '' }}" name="quantidade" value="{{ $produto->quantidade }}" >
                    
                        @if ($errors->has('quantidade'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('quantidade') }}</strong>
                            </span>
                        @endif
                    </div>
                
                </div>
                <div class="form-group row">
                    <label for="estoque_baixo" class="col-md-4 col-form-label text-md-right">{{ __('Estoque Baixo') }}</label>
                    
                    <div class="col-md-6">
                        <input id="estoque_baixo" type="text" class="form-control{{ $errors->has('estoque_baixo') ? ' is-invalid' : '' }}" name="estoque_baixo" value="{{ $produto->estoque_baixo }}" >
                    
                        @if ($errors->has('estoque_baixo'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('estoque_baixo') }}</strong>
                            </span>
                        @endif
                    </div>
                
                </div>
            </div>
            <div class="col">
                <div class="tabela">  
                {{-- Lado Direiro --}}
                <table class="table table-bordered">
                    <thead>
                        <th class="col-xs-1">C.Inicial</th>
                        <th class="col-xs-1">IPI</th>
                        <th class="col-xs-1">ICMS</th>
                        <th class="col-xs-1">Frete</th>
                        <th class="col-xs-1">C.Unitario</th>
                        <th class="col-xs-1">Margem</th>
                        <th class="col-xs-1">C.Final</th>
                    <tbody>
                        <tr>
                            <td>
                                <div style="width: 100%;">
                                    <input id="custo_inicial" type="text" class="form-control{{ $errors->has('custo_inicial') ? ' is-invalid' : '' }}" name="custo_inicial" value="{{ $produto->custo_inicial }}" >
                            
                                    @if ($errors->has('custo_inicial'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('custo_inicial') }}</strong>
                                        </span>
                                    @endif
                            </td>
                            <td>
                                <div style="width: 100%;">
                                    <input id="ipi" type="text" class="form-control{{ $errors->has('ipi') ? ' is-invalid' : '' }}" name="ipi" value="{{ $produto->ipi }}" >
                            
                                    @if ($errors->has('ipi'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('ipi') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div style="width: 100%;">
                                    <input id="icms" type="text" class="form-control{{ $errors->has('icms') ? ' is-invalid' : '' }}" name="icms" value="{{ $produto->icms }}" >
                            
                                    @if ($errors->has('icms'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('icms') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div style="width: 100%;">
                                    <input id="frete" type="text" class="form-control{{ $errors->has('frete') ? ' is-invalid' : '' }}" name="frete" value="{{ $produto->frete }}" >
                            
                                    @if ($errors->has('frete'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('frete') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div style="width: 100%;">
                                    <input id="custo_unitario" type="text" class="form-control{{ $errors->has('custo_unitario') ? ' is-invalid' : '' }}" name="custo_unitario" value="{{ $produto->custo_unitario }}" readonly="">
                            
                                    @if ($errors->has('custo_unitario'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('custo_unitario') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div style="width: 100%;">
                                    <input id="margem" type="text" class="form-control{{ $errors->has('margem') ? ' is-invalid' : '' }}" name="margem" value="{{ $produto->margem }}" >
                            
                                    @if ($errors->has('margem'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('margem') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div style="width: 100%;">
                                    <input id="custo_final" type="text" class="form-control{{ $errors->has('custo_final') ? ' is-invalid' : '' }}" name="custo_final" value="{{ $produto->custo_final }}" readonly="">
                            
                                    @if ($errors->has('custo_final'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('custo_final') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="form-group row" style="float: left;">
                    <label for="preco" class="col-md-4 col-form-label text-md-right">{{ __('*Preço') }}</label>
                
                    <div class="col-md-8">
                        <input id="preco" type="text" class="form-control{{ $errors->has('preco') ? ' is-invalid' : '' }}" name="preco" value="{{ $produto->preco }}" required>
                
                        @if ($errors->has('preco'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('preco') }}</strong>
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
            </div>
        </div>
    </form>
</div>
@endsection

@section('js')
    <script type="text/javascript">
        //Busca
        $('.tabela').on('keyup', function() {
           var custo_inicial = $("#custo_inicial").val();
           var ipi = $("#ipi").val();
           var icms = $("#icms").val();
           var frete = $("#frete").val();
           var margem = $("#margem").val();
           var custo_unitario;
           var custo_final

           custo_unitario = custo_inicial * (1 + (ipi/100)) * (1 + (icms/100)) * (1 + (frete/100));
           custo_final = custo_unitario * (1 + (margem/100));

           $("#custo_unitario").val(custo_unitario); 
           $("#custo_final").val(custo_final); 
        })
    </script>
@endsection
