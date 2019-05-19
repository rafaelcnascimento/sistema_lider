@extends('painel')
@section('css')
    <link href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" rel="stylesheet" >
@endsection
@section('corpo')
<div class="container">
    @if (!$hoje->isEmpty())
        <h3>Vencem hoje</h3>
        <table class="table table-striped">
            <thead class="thead-dark">
                <th>Código</th>
                <th>Tipo</th>
                <th>Destinatário</th>
                <th>Descrição</th>
                <th>Valor pago</th>
                <th>Valor total</th>
                <th>Pago</th>
                <th>Parcelas</th>
                <th>Vencimento</th>
            </thead>
            <tbody class="resultado">
                @foreach ($hoje as $despesa)
                <tr>
                    <td>
                        <a href="despesa/{{$despesa->id}}">{{$despesa->ano()}}_{{$despesa->id}}</a>
                    </td>
                    <td>{{$despesa->tipo->nome}}</td>
                    <td>{{$despesa->destinatario}}</td>
                    <td>{{$despesa->descricao}}</td>
                    <td>
                        @if ($despesa->valor_pago)
                            R${{$despesa->valor_pago}}
                        @endif
                    </td>
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
                        @if ($despesa->parcela_atual)
                            {{$despesa->parcela_atual}}/{{$despesa->parcela_total}}
                        @endif
                    </td>
                    <td>{{$despesa->vence_em}}</td>
                </tr>
                @endforeach  
            </tbody>
        </table>
    @endif

    @if (!$amanha->isEmpty())
        <h3>Vencem amanhã</h3>
        <table class="table table-striped">
            <thead class="thead-dark">
                <th>Código</th>
                <th>Tipo</th>
                <th>Destinatário</th>
                <th>Descrição</th>
                <th>Valor pago</th>
                <th>Valor total</th>
                <th>Pago</th>
                <th>Parcelas</th>
                <th>Vencimento</th>
            </thead>
            <tbody class="resultado">
                @foreach ($amanha as $despesa)
                <tr>
                    <td>
                        <a href="despesa/{{$despesa->id}}">{{$despesa->ano()}}_{{$despesa->id}}</a>
                    </td>
                    <td>{{$despesa->tipo->nome}}</td>
                    <td>{{$despesa->destinatario}}</td>
                    <td>{{$despesa->descricao}}</td>
                    <td>
                        @if ($despesa->valor_pago)
                            R${{$despesa->valor_pago}}
                        @endif
                    </td>
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
                        @if ($despesa->parcela_atual)
                            {{$despesa->parcela_atual}}/{{$despesa->parcela_total}}
                        @endif
                    </td>
                    <td>{{$despesa->vence_em}}</td>
                </tr>
                @endforeach  
            </tbody>
        </table>
    @endif

    @if (!$semana->isEmpty())
        <h3>Vencem na próxima semana</h3>
        <table class="table table-striped">
            <thead class="thead-dark">
                <th>Código</th>
                <th>Tipo</th>
                <th>Destinatário</th>
                <th>Descrição</th>
                <th>Valor pago</th>
                <th>Valor total</th>
                <th>Pago</th>
                <th>Parcelas</th>
                <th>Vencimento</th>
            </thead>
            <tbody class="resultado">
                @foreach ($semana as $despesa)
                <tr>
                    <td>
                        <a href="despesa/{{$despesa->id}}">{{$despesa->ano()}}_{{$despesa->id}}</a>
                    </td>
                    <td>{{$despesa->tipo->nome}}</td>
                    <td>{{$despesa->destinatario}}</td>
                    <td>{{$despesa->descricao}}</td>
                    <td>
                        @if ($despesa->valor_pago)
                            R${{$despesa->valor_pago}}
                        @endif
                    </td>
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
                        @if ($despesa->parcela_atual)
                            {{$despesa->parcela_atual}}/{{$despesa->parcela_total}}
                        @endif
                    </td>
                    <td>{{$despesa->vence_em}}</td>
                </tr>
                @endforeach  
            </tbody>
        </table>
    @endif

    @if (!$mes->isEmpty())
        <h3>Vencem nos próximos 30 dias</h3>
        <table class="table table-striped">
            <thead class="thead-dark">
                <th>Código</th>
                <th>Tipo</th>
                <th>Destinatário</th>
                <th>Descrição</th>
                <th>Valor pago</th>
                <th>Valor total</th>
                <th>Pago</th>
                <th>Parcelas</th>
                <th>Vencimento</th>
            </thead>
            <tbody class="resultado">
                @foreach ($mes as $despesa)
                <tr>
                    <td>
                        <a href="despesa/{{$despesa->id}}">{{$despesa->ano()}}_{{$despesa->id}}</a>
                    </td>
                    <td>{{$despesa->tipo->nome}}</td>
                    <td>{{$despesa->destinatario}}</td>
                    <td>{{$despesa->descricao}}</td>
                    <td>
                        @if ($despesa->valor_pago)
                            R${{$despesa->valor_pago}}
                        @endif
                    </td>
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
                        @if ($despesa->parcela_atual)
                            {{$despesa->parcela_atual}}/{{$despesa->parcela_total}}
                        @endif
                    </td>
                    <td>{{$despesa->vence_em}}</td>
                </tr>
                @endforeach  
            </tbody>
        </table>
    @endif
</div>    
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
