@extends('master')
@section('corpo')
        @if(session()->has('message.level'))
            <div class="alert alert-{{ session('message.level') }}"> 
            {!! session('message.content') !!}
            </div>
        @endif
        <div class="row">
            <div class="col-6" >
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header"><center>{{ __('Editar Cliente') }}</center></div>
                            <div class="card-body">
                                <form method="POST" action="/cliente/{{$cliente->id}}">
                                    @method('patch')
                                    @csrf

                                    <div class="form-group row">
                                        <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('*Nome') }}</label>
                                    
                                        <div class="col-md-6">
                                            <input id="nome" type="text" class="form-control{{$errors->has('nome') ? ' is-invalid' : '' }}" name="nome" value="{{ $cliente->nome }}" required autofocus>
                                    
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
                                            <input id="saldo" type="text" class="form-control{{ $errors->has('saldo') ? ' is-invalid' : '' }}" name="saldo" value="{{ $cliente->saldo }}" >
                                    
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
                                            <input id="telefone" type="text" class="form-control{{$errors->has('telefone') ? ' is-invalid' : '' }}" name="telefone" value="{{ $cliente->telefone }}">
                                    
                                            @if ($errors->has('telefone'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('telefone') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="documento" class="col-md-4 col-form-label text-md-right">{{ __('CPF/CNPJ') }}</label>
                                    
                                        <div class="col-md-6">
                                            <input id="documento" type="text" class="form-control{{ $errors->has('documento') ? ' is-invalid' : '' }}" name="documento" value="{{ $cliente->documento }}" >
                                    
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
                                            <input id="logradouro" type="text" class="form-control{{$errors->has('logradouro') ? ' is-invalid' : '' }}" name="logradouro" value="{{ $cliente->logradouro }}" >
                                    
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
                                            <input id="numero" type="text" class="form-control{{$errors->has('numero') ? ' is-invalid' : '' }}" name="numero" value="{{ $cliente->numero }}" >
                                    
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
                                            <input id="complemento" type="text" class="form-control{{$errors->has('complemento') ? ' is-invalid' : '' }}" name="complemento" value="{{ $cliente->complemento }}" >
                                    
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
                                            <input id="bairro" type="text" class="form-control{{$errors->has('bairro') ? ' is-invalid' : '' }}" name="bairro" value="{{ $cliente->bairro }}" >
                                    
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
                                            <input id="cep" type="text" class="form-control{{$errors->has('cep') ? ' is-invalid' : '' }}" name="cep" value="{{ $cliente->cep }}" >
                                    
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
                                            <input id="cidade" type="text" class="form-control{{$errors->has('cidade') ? ' is-invalid' : '' }}" name="cidade" value="{{ $cliente->cidade }}" >
                                    
                                            @if ($errors->has('cidade'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('cidade') }}</strong>
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
                                        <form method="post" action="/cliente/{{$cliente->id}}" onSubmit="if(!confirm('Deletar cliente?')){return false;}">
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
            <div class="col-6">
                    <center>
                        <h2>Compras desse cliente</h2>
                        <h5>Total de compras: R${{$valor_pago}} </h5>
                        <h5>Saldo devedor: R${{$valor_devido}}</h5>
                    </center>
                    <br>
                    <div class="container-fluid">
                        <table class="table table-striped">
                            <thead class="thead-dark">
                                <th>Código</th>
                                <th>Valor</th>
                                <th>Forma de Pagamento</th>
                                <th>Parcelas/Pagas</th>
                                <th>Situação</th>
                                <th>Data</th>
                            </thead>
                            <tbody class="resultado">
                                @foreach ($pedidos as $pedido)
                                <tr>
                                    <td><a href="/pedido/{{$pedido->id}}" target="_blank">{{$pedido->ano($pedido->created_at)}}_{{$pedido->id}}</a></td>
                                    <td>R${{$pedido->valor}}</td>
                                    <td>{{$pedido->pagamento->nome}}</td>
                                    @if($pedido->pagamento_id == 7)
                                        <td>{{$pedido->parcela_paga}}/<b>{{$pedido->parcela_total}}</b></td>
                                    @else
                                        <td></td>
                                    @endif
                                    @if ($pedido->pago)
                                        <td class="table-success">
                                            Pago
                                        </td>
                                    @elseif (!$pedido->pago && $pedido->parcela_paga > 1 )
                                        <td class="table-warning">
                                            Em Aberto
                                        </td>
                                    @else
                                        <td class="table-danger">
                                            Não Pago
                                        </td>
                                    @endif
                                    <td>{{$pedido->created_at}}</td>
                                </tr>
                                @endforeach    
                            </tbody>
                        </table>
                    </div>
                    {{ $pedidos->links() }}
                </div>
            </div>
        </div>   
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
        
    <script type="text/javascript">
    $(window).load(function()
    {
       var phones = [{ "mask": "(##) ####-####"}, { "mask": "(##) #####-####"}];
        $('#telefone').inputmask({ 
            mask: phones, 
            greedy: false, 
            definitions: { '#': { validator: "[0-9]", cardinality: 1}} 
        });
    });
    </script>
@endsection
