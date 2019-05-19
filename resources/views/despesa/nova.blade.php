@extends('painel')
@section('css')
    <link href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" rel="stylesheet" >
@endsection
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
                                <label for="tipo_despesa_id" class="col-md-4 col-form-label text-md-right">{{ __('*Tipo') }}</label>
                                
                                <div class="col-md-6">
                                    <select class="form-control{{ $errors->has('tipo_despesa_id') ? ' is-invalid' : '' }}" id="tipo_despesa_id"  name="tipo_despesa_id" required >
                                
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
                                <label for="pagamento_id" class="col-md-4 col-form-label text-md-right">{{ __('*Forma de pagamento') }}</label>
                                <div class="col-md-6">
                                    <select class="form-control{{ $errors->has('pagamento_id') ? ' is-invalid' : '' }}" id="pagamento_id"  name="pagamento_id" required >
                                        <option selected="" disabled="">Selecione</option>
                                            @foreach ($pagamentos as $pagamento)
                                                <option value="{{$pagamento->id}}" {{ (old('pagamento_id') == $pagamento->id ? "selected":"") }}>{{$pagamento->nome}}</option>
                                            @endforeach
                                    </select>
                                    @if ($errors->has('pagamento_id'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('pagamento_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="valor" class="col-md-4 col-form-label text-md-right">{{ __('*Valor total') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="valor" type="number" step="0.01" class="form-control{{$errors->has('valor') ? ' is-invalid' : '' }}" name="valor" value="{{ old('valor') }}" placeholder="Total a vista ou de cada parcela" required>
                            
                                    @if ($errors->has('valor'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('valor') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                             <div class="form-group row">
                                 <label for="valor_pago" class="col-md-4 col-form-label text-md-right">{{ __('Valor Pago') }}</label>
                             
                                 <div class="col-md-6">
                                     <input id="valor_pago" type="text" class="form-control{{$errors->has('valor_pago') ? ' is-invalid' : '' }}" name="valor_pago" value="{{ old('valor_pago')  }}" placeholder="Preencher se não foi pago integralmente" >
                             
                                     @if ($errors->has('valor_pago'))
                                         <span class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('valor_pago') }}</strong>
                                         </span>
                                     @endif
                                 </div>
                             </div>

                            <div class="form-group row">
                                <label for="parcelas" class="col-md-4 col-form-label text-md-right">{{ __('Numero de parcelas') }}</label>

                                <div class="col-md-6">
                                    <input id="parcelas" type="number" step="1" class="form-control{{$errors->has('parcelas') ? ' is-invalid' : '' }}" name="parcelas" value="{{ old('parcelas') }}" >

                                    @if ($errors->has('parcelas'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('parcelas') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="vence_em" class="col-md-4 col-form-label text-md-right">{{ __('Data vencimento') }}</label>

                                <div class="col-md-6">
                                    <input id="vence_em" type="date" class="form-control{{$errors->has('vence_em') ? ' is-invalid' : '' }}" name="vence_em" value="{{ old('vence_em') }}" >

                                    @if ($errors->has('vence_em'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('vence_em') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="pago" class="col-md-4 col-form-label text-md-right">Situação </label>
                    
                                   <div style="margin-left: 20px; font-size: 30px;">
                                        <div class="form-check form-check-inline ">
                                           <input class="form-check-input" type="radio" name="pago" id="r1" value="1" required>
                                           <label class="form-check-label" for="r1">Pago</label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="radio" name="pago" id="r2"value="0">
                                           <label class="form-check-label" for="r2">Não Pago</label>
                                       </div>
                                   </div>    
                            </div>

                            {{-- <div class="form-group row">
                                <label for="parcelado" class="col-md-4 col-form-label text-md-right">Parcelado? </label>

                                   <div style="margin-left: 20px; font-size: 30px;">
                                        <div class="form-check form-check-inline ">
                                           <input class="form-check-input" type="radio" name="parcelado" id="p1" value="1" required>
                                           <label class="form-check-label" for="p1">Sim </label>
                                       </div>
                                       <div class="form-check form-check-inline">
                                           <input class="form-check-input" type="radio" name="parcelado" id="p2" value="0" checked>
                                           <label class="form-check-label" for="p2">Não</label>
                                       </div>
                                   </div>    
                            </div> --}}

                            {{-- Parcelas --}}
                            <div class="parcelas">
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
