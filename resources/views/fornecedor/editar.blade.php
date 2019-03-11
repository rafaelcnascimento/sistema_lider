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
                    <div class="card-header">{{ __('Editar Fornecedor') }}</div>

                    <div class="card-body">
                        <form method="POST" action="/fornecedor/{{$fornecedor->id}}">
                            @method('patch')
                            @csrf

                            <div class="form-group row">
                                <label for="nome" class="col-md-4 col-form-label text-md-right">{{ __('*Nome') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="nome" type="text" class="form-control{{$errors->has('nome') ? ' is-invalid' : '' }}" name="nome" value="{{ $fornecedor->nome }}" required autofocus>
                            
                                    @if ($errors->has('nome'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nome') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="telefone" class="col-md-4 col-form-label text-md-right">{{ __('Telefone') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="telefone" type="text" class="form-control{{$errors->has('telefone') ? ' is-invalid' : '' }}" name="telefone" value="{{ $fornecedor->telefone }}">
                            
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
                                    <input id="celular" type="text" class="form-control{{$errors->has('celular') ? ' is-invalid' : '' }}" name="celular" value="{{ $fornecedor->celular }}" >
                            
                                    @if ($errors->has('celular'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('celular') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="endereco" class="col-md-4 col-form-label text-md-right">{{ __('Endereço') }}</label>
                            
                                <div class="col-md-6">
                                    <input id="endereco" type="text" class="form-control{{$errors->has('endereco') ? ' is-invalid' : '' }}" name="endereco" value="{{ $fornecedor->endereco }}" >
                            
                                    @if ($errors->has('endereco'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('endereco') }}</strong>
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
                                <form method="post" action="/fornecedor/{{$fornecedor->id}}" onSubmit="if(!confirm('Deletar fornecedor?')){return false;}">
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
        <br>
        <h2>Produtos desse fornecedor:</h2>
        <br>
            <table class="table table-striped">
                <thead class="thead-dark">
                    <th>Material</th>
                    <th>Quantidade</th>
                    <th>Preço</th>
                </thead>
                <tbody class="resultado">
                    @foreach ($produtos as $produto)
                    <tr>
                        <td><a href="/produto/{{$produto->id}}" target="_blank">{{$produto->nome}}</a></td>
                        <td>{{$produto->quantidade}}</td>
                        <td>@moeda($produto->preco)</td>
                    </tr>
                    @endforeach  
                </tbody>
            </table>

        {{ $produtos->links() }}
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

        $('#celular').inputmask({ 
            mask: phones, 
            greedy: false, 
            definitions: { '#': { validator: "[0-9]", cardinality: 1}} 
        });
    });
    </script>
@endsection
