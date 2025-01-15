@extends('ManageRegistration.Muip Admin.template')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-body">
                <h2 class="card-title">Academic Performance</h2>
                <canvas id="performanceChart" width="800" height="400"></canvas>
            </div>
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-secondary mt-3 float-right ml-3">Back</a>

    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Extracting labels and data from the results
            var labels = {!! json_encode($results->pluck('subject.subjectName')->toArray()) !!};
            var data = {!! json_encode($results->pluck('resultMark')->toArray()) !!};

            // Generate random colors for each bar
            var colors = [];
            for (var i = 0; i < data.length; i++) {
                var randomColor = 'rgba(' + Math.floor(Math.random() * 256) + ',' + Math.floor(Math.random() *
                    256) + ',' + Math.floor(Math.random() * 256) + ', 0.2)';
                colors.push(randomColor);
            }

            // Output labels, data, and colors to console
            console.log(labels);
            console.log(data);
            console.log(colors);

            // Chart configuration
            var config = {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Result Mark', // This label will be displayed in the legend
                        data: data,
                        backgroundColor: colors, // Use the generated colors
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            labels: {
                                generateLabels: function(chart) {
                                    var data = chart.data;
                                    if (data.labels.length && data.datasets.length) {
                                        return data.labels.map(function(label, index) {
                                            return {
                                                text: label, // Display subject name and result mark
                                                fillStyle: data.datasets[0].backgroundColor[
                                                index], // Assign background color
                                                hidden: false,
                                                index: index
                                            };
                                        });
                                    }
                                    return [];
                                }
                            }
                        }
                    }
                }
            };

            // Initialize the chart
            var ctx = document.getElementById('performanceChart').getContext('2d');
            new Chart(ctx, config);
        });
    </script>
@endsection
