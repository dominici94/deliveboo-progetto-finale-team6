@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.1/dist/chart.min.js"></script>
@if(Auth::user()->restaurants->id == $id)
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card-header">
                <span>Statistiche</span>
            </div>
        </div>
    </div>
    <canvas id="myChart" width="400" height="200"></canvas>

    @php
    $date = json_encode($date);
    @endphp
    <script>
    new Chart(document.getElementById("myChart"), {
    type: 'line',
    data: {
        labels: ['01/2022','02/2022','03/2022','04/2022','05/2022','06/2022','07/2022','08/2022','09/2022','10/2022','11/2022','12/2022',],
        datasets: [{
            label: 'Ordini',
            data: <?php echo $date; ?>,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.3
        }]
    },
    options: {
        scales: {
            y: {
                afterDataLimits: (scale) => {
                scale.max += 0.001;
                scale.min = 0;
                }
            },
        },
        title: {
        display: true,
        text: 'Ordini'
        }
    }
    });
    </script>

</div>
@endif
@endsection