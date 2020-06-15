@extends('layouts.app')

@section('content')
<div class="container">
    <canvas id="myChart"></canvas>
</div>
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
<script>
let data = @json($data);
let ctx = $("#myChart")[0].getContext('2d');

let myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: data.lables,
        datasets: [{
            label: 'Активні курси',
            backgroundColor: 'rgba(255,236,66,0.7)',
            borderWidth: 1,
            data: data.active
        }, {
            label: 'Завершені курси',
            backgroundColor: 'rgba(74,74,255,0.7)',
            borderWidth: 1,
            data: data.passed
        }, {
            label: 'Перервані курси',
            backgroundColor: 'rgba(255,54,60,0.7)',
            borderWidth: 1,
            data: data.interrupted
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Навантаженість курсів'
        }
    }
});
</script>
@endsection