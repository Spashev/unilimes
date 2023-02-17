@extends('layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-2">
                <canvas id="myChart"></canvas>
            </div>
            <hr class="mt-3">
            <a href="{{route('main')}}" class="btn btn-success mt-1">назад</a>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');
        let data = {{ Js::from($categoryUserLikedStatistic) }};
        let labelSet = [];
        let dataSet = [];
        if (data !== unescape){
            data = JSON.parse(data);
        }
        for (let item in data){
            labelSet.push(data[item].title);
            dataSet.push(data[item].userLikedCount);

        }
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labelSet,
                datasets: [{
                    label: '# Statistic',
                    data: dataSet,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
