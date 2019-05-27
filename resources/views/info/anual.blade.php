@extends('painel')
@section('corpo')
    <div class="container">
        <div class="row">
            <div class="col-3" >
                <table class="table">
                    <thead class="thead-dark">
                        <th>Ano</th>
                        <th>Balanço total</th>
                    </thead>
                    <tbody>
                        @foreach ($anos as $ano)
                            <tr>
                                <td>
                                    <a href="/painel/balanco-mensal/{{$ano->valor}}">{{$ano->valor}}</a>
                                </td>
                                @if ($resultados[$ano->valor] < 0)
                                    <td class="table-danger">
                                        {{$resultados[$ano->valor]}}
                                    </td>
                                @else
                                    <td class="table-success">
                                        {{$resultados[$ano->valor]}}
                                    </td>
                                @endif
                            </tr>
                        @endforeach 
                    </tbody>
                </table>
            </div>
            <div class="col-9" >
                <div style="width: 100%; height: 200px;">
                    <canvas id="myChart"></canvas>
                </div>    
            </div>
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
            labels: @json($anos_array),
            datasets: [{
                label: 'Balanço realizado por ano',
                data: @json($resultados_array),
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
