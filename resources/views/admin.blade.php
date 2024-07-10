@extends('layout.main')

@section('container')
    <!-- Pills navs -->
    <div class="container">

        <div class="row">
            <div class="col-md-3">
                <div class="card mt-3 mb-3">
                    <div class="card-body bg-warning text-light">
                        Total User
                        <h2>{{ $userCount }}</h2>
                    </div>
                    <div class="card-footer">
                        <a href="/admin/user" class="btn btn-warning">selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mt-3 mb-3">
                    <div class="card-body bg-success text-light">
                        Total Parkiran
                        <h2>{{ $parkiranCount }}</h2>
                    </div>
                    <div class="card-footer">
                        <a href="/parkir" class="btn btn-success">selegkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mt-3 mb-3">
                    <div class="card-body bg-danger text-light">
                        Report Parkiran
                        <h2>{{ $reportCount }}</h2>
                    </div>
                    <div class="card-footer">
                        <a href="/admin/report" class="btn btn-danger">selegkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mt-3 mb-3">
                    <div class="card-body bg-info text-light">
                        Pesan
                        <h2>{{ $messageCount }}</h2>
                    </div>
                    <div class="card-footer">
                        <a href="/admin/message" class="btn btn-info">selegkapnya</a>
                    </div>
                </div>
            </div>

            <div class="col-md-12">

                <div class="card">
                    <div class="card-cody">
                        <canvas id="transactionChart"></canvas>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('transactionChart').getContext('2d');
        var labels = {!! $labels !!};
        var data = {!! $data !!};

        var transactionChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Jumlah User',
                    data: data,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
