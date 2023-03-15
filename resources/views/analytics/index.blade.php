@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Analytics') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row p-2">
        <div class="col col-sm-6">
            <div class="row">
                <div class="col-md-12 m-1 p-2">
                    <canvas id="medCountGivenForPastSevenDays" class="border border-primary p-2"></canvas>
                </div>
                <div class="col-md-12 m-1 p-2">
                    <canvas id="patientCountsByBrgy" class="border border-primary p-2"></canvas>
                </div>
            </div>
        </div>
        <div class="col col-sm-6">
            <div class="row">
                <div class="col-md-12 m-1 p-2">
                    <canvas id="treatmentCountForPastSevenDays" class="border border-primary p-2"></canvas>
                </div>
                <div class="col-md-12 m-1 p-2">
                    <canvas id="medCountByCategory" class="border border-primary p-2"></canvas>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"
        integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        const ctz = document.getElementById('patientCountsByBrgy');
        new Chart(ctz, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($DL_patientBrgy); ?>,
                datasets: [{
                    label: 'Patients per Barangay',
                    data: <?php echo json_encode($DP_patientCount); ?>,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                }]
            },
            plugins: [ChartDataLabels],
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'No. of Consultations per Barangay this month'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }

                },
            }
        });

        const ctx = document.getElementById('treatmentCountForPastSevenDays');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($DL_treatmentDay); ?>,
                datasets: [{
                    label: 'No. of Treatment for the last 7 days',
                    data: <?php echo json_encode($DP_treatmentCount); ?>,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                }]
            },
            plugins: [ChartDataLabels],
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }

                }
            }
        });


        const cty = document.getElementById('medCountGivenForPastSevenDays');
        new Chart(cty, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($DL_medGivenDay); ?>,
                datasets: [{
                    label: 'No. of given medicine for the last 7 days',
                    data: <?php echo json_encode($DP_medCount); ?>,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                }]
            },
            plugins: [ChartDataLabels],
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }

                }
            }
        });


        const ctw = document.getElementById('medCountByCategory');
        new Chart(ctw, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($DL_medCategory); ?>,
                datasets: [{
                    label: 'No. given medicine by Category',
                    data: <?php echo json_encode($DP_medCategoryCount); ?>,
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(201, 203, 207, 0.2)'
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                        'rgb(201, 203, 207)'
                    ],
                }]
            },
            plugins: [ChartDataLabels],
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'No. of given medicine by category'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }

                },
            }
        });
    </script>
@endsection
