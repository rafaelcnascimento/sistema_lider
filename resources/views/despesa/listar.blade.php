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


