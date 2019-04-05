@extends('master')
@section('css')
    <link href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" rel="stylesheet" >
@endsection
@section('corpo')
    <br>
    
    <div class="container">

        @if(session()->has('message.level'))
            <div class="alert alert-{{ session('message.level') }}"> 
            {!! session('message.content') !!}
            </div>
        @endif

        <form class="form-inline filtrar" method="POST" action="/despesa-filtrar">
            @csrf
            <h3>Filtrar:</h3>
            <select class="form-control espaco20" id="mes"  name="mes" >
                <option selected="" disabled="">Escolha o mês</option>
                <option value="">Todos</option>
                <option value="1">Janeiro</option>
                <option value="2">Fevereiro</option>
                <option value="3">Março</option>
                <option value="4">Abril</option>
                <option value="5">Maio</option>
                <option value="6">Junho</option>
                <option value="7">Julho</option>
                <option value="8">Agosto</option>
                <option value="9">Setembro</option>
                <option value="10">Outubro</option>
                <option value="11">Novembro</option>
                <option value="12">Dezembro</option>
            </select>
            <select class="form-control espaco20" id="ano"  name="ano" >
                <option selected="" disabled="">Escolha o ano</option>
                <option value="">Todos</option>
                @foreach ($anos as $ano)
                    <option value="{{$ano->valor}}">{{$ano->valor}}</option>
                @endforeach
            </select>
            <select class="form-control espaco20" id="pago"  name="pago" >
                <option value ="3">Todos</option>
                <option value ="1">Pagos</option>
                <option value ="0">Não pagos</option>
            </select>
            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                    {{ __('Filtrar') }}
                    </button>
                </div>
            </div>
        </form>
        <br>

        <table class="table table-striped">
            <thead class="thead-dark">
                <th>Código</th>
                <th>Tipo</th>
                <th>Destinatário</th>
                <th>Descrição</th>
                <th>Valor pago</th>
                <th>Valor total</th>
                <th>Pago</th>
                <th>Arquivo</th>
                <th>Data</th>
            </thead>
            <tbody class="resultado">
                @foreach ($despesas as $despesa)
                <tr>
                    <td>
                        <a href="despesa/{{$despesa->id}}">{{$despesa->ano()}}_{{$despesa->id}}</a>
                    </td>
                    <td>{{$despesa->tipo->nome}}</td>
                    <td>{{$despesa->destinatario}}</td>
                    <td>{{$despesa->descricao}}</td>
                    <td>R${{$despesa->valor_pago}}</td>
                    <td><b>R${{$despesa->valor}}</b></td>
                    @if ($despesa->pago)
                        <td class="table-success" id="pago{{$despesa->id}}">
                            Pago <i id="despagar{{$despesa->id}}" class="fas fa-times">
                        </td>
                    @else
                        <td class="table-danger" id="npago{{$despesa->id}}">
                            Não Pago <i id="pagar{{$despesa->id}}" class="fas fa-check"></i>
                        </td>
                    @endif
                    <td>
                        @if ($despesa->arquivo)
                            <a href="/arquivo/{{$despesa->id}}" target="_blank" class="btn btn-primary" role="button">Visualizar</a>
                        @else
                        @endif
                    </td>
                    <td>{{$despesa->created_at}}</td>
                </tr>

                @endforeach  
            </tbody>
        </table>
    </div>
    {{ $despesas->links() }}
@endsection

@section('js')
<script type="text/javascript">
    //Pagar
    $(document).on('click','.fa-check' ,function(event)
    {
        var id = $(this).attr("id").replace('pagar','');

        $.ajax({
            type: 'get',
            url: '/pagarDespesaAjax',
            data: {
            'id': id,
        },
        success: function(data) {
            $('#npago'+id).html(data);
            $('#npago'+id).toggleClass('table-danger table-success');
        }});
    });        

    //Despagar
    $(document).on('click','.fa-times' ,function(event)
    {
        var id = $(this).attr("id").replace('despagar','');

        $.ajax({
            type: 'get',
            url: '/despagarDespesaAjax',
            data: {
            'id': id,
        },
        success: function(data) {
            $('#pago'+id).html(data);
            $('#pago'+id).toggleClass('table-success table-danger');
        }});
    });      
</script>
@endsection


