@extends('painel')
@section('corpo')
    <div class="container-fluid">
        <select class="form-control espaco20" style="width: 200px;" id="ano" name="ano" onchange="location = this.value;">
            <option selected="" disabled="">Escolha o ano</option>
            @foreach ($anos as $ano)
                <option value='/painel/balanco-mensal/{{$ano->valor}}'>{{$ano->valor}}</option>
            @endforeach
        </select><br>
        <table class="table">
            <thead class="thead-dark">
                <th>Mês</th>
                <th>Vendas pagas</th>
                <th>Vendas abertas</th>
                <th>Vendas totais</th>
                <th>Despesas pagas</th>
                <th>Despesas abertas</th>
                <th>Despesas totais</th>
                <th>Balanço realizado</th>
                <th>Balanço aberto</th>
                <th>Balanço total</th>
            </thead>
            <tbody>
                @foreach ($meses as $mes)
                    <tr>
                        <td>{{$mes['nome']}}</td>
                        {{-- Venda --}}
                        <td class="table-info">@moeda($venda_paga_mes[$mes['num']])</td>
                        <td class="table-info">@moeda($venda_aberta_mes[$mes['num']])</td>
                        <td class="table-info">@moeda($venda_total_mes[$mes['num']])</td>
                        {{-- Despesa --}}
                        <td>@moeda($despesa_paga_mes[$mes['num']])</td>
                        <td>@moeda($despesa_aberta_mes[$mes['num']])</td>
                        <td>@moeda($despesa_total_mes[$mes['num']])</td>
                        {{-- Balanco --}}
                        @if ($balanco_pago_mes[$mes['num']] < 0)
                            <td class="table-danger">@moeda($balanco_pago_mes[$mes['num']])</td>
                        @else
                            <td class="table-success">@moeda($balanco_pago_mes[$mes['num']])</td>
                        @endif
                        @if ($balanco_aberto_mes[$mes['num']] < 0)
                            <td class="table-danger">@moeda($balanco_aberto_mes[$mes['num']])</td>
                        @else
                            <td class="table-success">@moeda($balanco_aberto_mes[$mes['num']])</td>
                        @endif
                        @if ($balanco_total_mes[$mes['num']] < 0)
                            <td class="table-danger">@moeda($balanco_total_mes[$mes['num']])</td>
                        @else
                            <td class="table-success">@moeda($balanco_total_mes[$mes['num']])</td>
                        @endif
                    </tr>
                @endforeach 
                {{-- <p><b>{{$mes['nome']}}</b>: {{$resultados[$mes['num']]}}</p><br> --}}
            </tbody>
        </table>
        <div style="width: 80%; height: 200px;">
            <canvas id="myChart"></canvas>
        </div> 
    </div>    
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js" ></script>
    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($mes_array),
            datasets: [{
                label: 'Balanço realizado por mês',
                data: @json($balanco),
                backgroundColor: @json($cores), 
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
@endsection
