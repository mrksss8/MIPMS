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

    <div class="card shadow-lg p-3">
        <h4 class="text-center text-primary">Analytics for month of

            {{ match ($currentMonth) {
                '01' => 'January',
                '02' => 'February',
                '03' => 'March',
                '04' => 'April',
                '05' => 'May',
                '06' => 'June',
                '07' => 'July',
                '08' => 'August',
                '09' => 'September',
                '10' => 'October',
                '11' => 'November',
                '12' => 'December',
                default => 'Unknown month',
            } }}
        </h4>
        <div class="row">
            <div class="col-md-12 d-flex align-items-center justify-content-center">
                <div class="form-group">
                    <form action="{{ route('analytics.index') }}" method="GET" class="d-flex align-items-center ">
                        @csrf
                        <select class="form-control-sm" name="month" id="month">
                            <option selected disabled>Month</option>
                            @foreach ($past_months as $month_number => $month_name)
                                <option value="{{ $month_number }}">
                                    {{ $month_name }}
                                </option>
                            @endforeach
                        </select>
                        <button class="btn btn-success btn-sm text-center ml-2" type="submit">View Month</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm">
                <canvas id="patientCountsByBrgys" class="border border-primary p-2"></canvas>
            </div>
            <div class="col-sm">
                <canvas id="consultationCountsByBrgy" class="border border-primary p-2"></canvas>
            </div>
        </div>
        <div class="row">
            <div class="col-sm">
                <canvas id="treatmentCountsByBrgy" class="border border-primary p-2"></canvas>
            </div>
            <div class="col-sm">
                <canvas id="medicineGivenCountsByBrgy" class="border border-primary p-2"></canvas>
            </div>
        </div>

    </div>

    <div class="card shadow-lg p-3 mt-3">
        <h4 class="text-center text-primary p-1">Analytics about Barangay</h4>
        <div class="row mb-3 d-flex justify-content-center">
            <div class="col-md-5">
                <canvas id="numPatientsPerBRGY" class="border border-primary p-2"></canvas>
            </div>
            <div class="col-md-5">
                <canvas id="numConsultationPerBRGY" class="border border-primary p-2"></canvas>
            </div>
        </div>
        <div class="row d-flex justify-content-center">
            <div class="col-md-5">
                <canvas id="numGivenMedPerBRGY" class="border border-primary p-2"></canvas>
            </div>
            <div class="col-md-5 border border-primary">

                <form action="{{ route('analytics.index') }}" method="GET"
                    class="d-flex align-items-center justify-content-center pt-3">
                    @csrf
                    <select class="form-control-sm" name="brgy" id="brgy">
                        <option selected disabled>Barangay</option>
                        @foreach ($brgys as $brgy)
                            <option value="{{ $brgy->barangay }}">
                                {{ $brgy->barangay }}
                            </option>
                        @endforeach
                    </select>
                    <button class="btn btn-success btn-sm text-center ml-2" type="submit">View Brgy</button>
                </form>

                <canvas id="medicineGivenByBrgy" class=" p-2"></canvas>
            </div>
        </div>
    </div>

    <div class="card shadow-lg p-3 mt-3">
        <h4 class="text-center text-primary mt-5">Analytics about Medicine</h4>
        <div class="row  d-flex justify-content-center">
            <div class="col-md-5 mb-3">
                <canvas id="medNumGivenByCategory" class="border border-primary p-2"></canvas>
            </div>
            <div class="col-md-5">
                <canvas id="criticalMed" class="border border-primary p-2"></canvas>
            </div>
        </div>
        <div class="row  d-flex justify-content-center">
            <div class="col-md-5">
                <canvas id="toexpiredMed" class="border border-primary p-2"></canvas>
            </div>
            <div class="col-md-5">
                <canvas id="expiredMed" class="border border-primary p-2"></canvas>
            </div>
        </div>
    @endsection

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"
            integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <script>
            //Analytics about Barangay
            const numPatientsPerBRGY = document.getElementById('numPatientsPerBRGY');
            new Chart(numPatientsPerBRGY, {
                type: 'pie',
                data: {
                    labels: <?php echo json_encode($DL_patientsBrgy); ?>,
                    datasets: [{
                        label: 'No. of Patients',
                        data: <?php echo json_encode($DP_patientsBrgyCount); ?>,
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
                            text: 'No. of Patients per Barangay'
                        }
                    },
                    // scales: {
                    //     y: {
                    //         beginAtZero: true
                    //     }

                    // },
                }
            });

            const numConsultationPerBRGY = document.getElementById('numConsultationPerBRGY');
            new Chart(numConsultationPerBRGY, {
                type: 'pie',
                data: {
                    labels: <?php echo json_encode($DL_consultationBrgy); ?>,
                    datasets: [{
                        label: 'No. of Consultation',
                        data: <?php echo json_encode($DP_consultationBrgyCount); ?>,
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
                            text: 'No. of Consultations per Barangay'
                        }
                    }
                }
            });

            const numGivenMedPerBRGY = document.getElementById('numGivenMedPerBRGY');
            new Chart(numGivenMedPerBRGY, {
                type: 'pie',
                data: {
                    labels: <?php echo json_encode($DL_medicinesBrgy); ?>,
                    datasets: [{
                        label: 'No. of Given Medicines',
                        data: <?php echo json_encode($DP_medicinesBrgyCount); ?>,
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
                            text: 'No. of Given Medicines per Barangay'
                        }
                    },
                    // scales: {
                    //     y: {
                    //         beginAtZero: true
                    //     }

                    // },
                }
            });

            //Analytics about Medicine
            const medNumGivenByCategory = document.getElementById('medNumGivenByCategory');
            new Chart(medNumGivenByCategory, {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode($DL_medCategory); ?>,
                    datasets: [{
                        label: 'No. Given Medicine',
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
                            text: 'No. of Given Medicine by Category'
                        }
                    },
                    // scales: {
                    //     y: {
                    //         beginAtZero: true
                    //     }

                    // },
                }
            });

            const criticalMed = document.getElementById('criticalMed');
            new Chart(criticalMed, {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode($DL_criticalMedicineBrandName); ?>,
                    datasets: [{
                        label: 'Stocks',
                        data: <?php echo json_encode($DP_criticalMedicineBrandNameStock); ?>,
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
                            text: 'Critical Medicines'
                        }
                    },
                    // scales: {
                    //     y: {
                    //         beginAtZero: true
                    //     }

                    // },
                }
            });

            const expiredMed = document.getElementById('expiredMed');
            new Chart(expiredMed, {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode($DL_expiMedicineBrandName); ?>,
                    datasets: [{
                        label: 'Stocks',
                        data: <?php echo json_encode($DP_expiMedicineBrandNameStock); ?>,
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
                            text: 'Expired Medicines'
                        }
                    },
                    // scales: {
                    //     y: {
                    //         beginAtZero: true
                    //     }

                    // },
                }
            });

            const toexpiredMed = document.getElementById('toexpiredMed');
            new Chart(toexpiredMed, {
                type: 'doughnut',
                data: {
                    labels: <?php echo json_encode($DL_toexpiMedicineBrandName); ?>,
                    datasets: [{
                        label: 'Stocks',
                        data: <?php echo json_encode($DP_toexpiMedicineBrandNameStock); ?>,
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
                            text: 'To Expired Medicines within 1 month'
                        }
                    },
                    // scales: {
                    //     y: {
                    //         beginAtZero: true
                    //     }

                    // },
                }
            });

            //Analytics this Month
            const treatmentCountsByBrgy = document.getElementById('treatmentCountsByBrgy');
            new Chart(treatmentCountsByBrgy, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($DL_treatmentBrgy); ?>,
                    datasets: [{
                        label: 'No. of Treament',
                        data: <?php echo json_encode($DP_treatmentBrgyCount); ?>,
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
                            text: 'No. of Treatments per Barangay'
                        }
                    },
                    // scales: {
                    //     y: {
                    //         beginAtZero: true
                    //     }

                    // },
                }
            });

            const patientCountsByBrgys = document.getElementById('patientCountsByBrgys');
            new Chart(patientCountsByBrgys, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($DL_patientBrgy); ?>,
                    datasets: [{
                        label: 'No. of Patients',
                        data: <?php echo json_encode($DP_patientBrgyCount); ?>,
                        borderWidth: 1,
                        backgroundColor: [
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
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
                            text: 'No. of Patients per Barangay'
                        }
                    },
                    // scales: {
                    //     y: {
                    //         beginAtZero: true
                    //     }

                    // },
                }
            });

            const consultationCountsByBrgy = document.getElementById('consultationCountsByBrgy');
            new Chart(consultationCountsByBrgy, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($DL_constultationBrgy); ?>,
                    datasets: [{
                        label: 'No. of Consultation',
                        data: <?php echo json_encode($DP_constultationBrgyCount); ?>,
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
                            text: 'No. of Consultation per Barangay'
                        }
                    },
                    // scales: {
                    //     y: {
                    //         beginAtZero: true
                    //     }

                    // },
                }
            });

            const medicineGivenCountsByBrgy = document.getElementById('medicineGivenCountsByBrgy');
            new Chart(medicineGivenCountsByBrgy, {
                type: 'bar',
                data: {
                    labels: <?php echo json_encode($DL_medicineBrgy); ?>,
                    datasets: [{
                        label: 'Medicine Given',
                        data: <?php echo json_encode($DP_medicineBrgyCount); ?>,
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
                            text: 'No. Given of Medcine per Barangay'
                        }
                    },
                    // scales: {
                    //     y: {
                    //         beginAtZero: true
                    //     }

                    // },
                }
            });

            const medicineGivenByBrgy = document.getElementById('medicineGivenByBrgy');
            new Chart(medicineGivenByBrgy, {
                type: 'pie',
                data: {
                    labels: <?php echo json_encode($DL_medicineBrand_name); ?>,
                    datasets: [{
                        label: 'Medicine Given',
                        data: <?php echo json_encode($DP_medicineTotal_quantity); ?>,
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
                            text: 'No. Given of Medcine to Brgy. {{ $currentBrgy }}'

                        }
                    },
                    // scales: {
                    //     y: {
                    //         beginAtZero: true
                    //     }

                    // },
                }
            });
        </script>

        //
        <script>
            //     $(document).ready(function() {
            //         $('#month').change(function() {
            //             var selectedValue = $(this).val();
            //             console.log(selectedValue);
            //             $.ajax({
            //                 url: '{{ route('analytics.index') }}',
            //                 type: 'GET',
            //                 data: {
            //                     selectedValue: selectedValue
            //                 },
            //                 dataType: 'json',
            //                 success: function(response) {
            //                     console.log(response);
            //                 },
            //                 error: function(xhr, status, error) {
            //                     console.error(xhr.responseText);
            //                 }
            //             });
            //         });
            //     });
            // 
        </script>
    @endsection
