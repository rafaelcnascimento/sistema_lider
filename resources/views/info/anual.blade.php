@extends('painel')
@section('corpo')
    <div class="container">
        @foreach ($anos as $ano)
            <a href="/painel/balanco-mensal/{{$ano->valor}}">{{$ano->valor}}</a> = {{$resultados[$ano->valor]}}<br>
        @endforeach
        <div style="width: 100%; height: 200px;">
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
