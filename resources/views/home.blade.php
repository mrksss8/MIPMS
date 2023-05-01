@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

    @if (session('success'))
        <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif



    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Patient</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $patient_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-hospital-user fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">For Treatment Patient
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $forTreatment_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-injured fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->

        <!-- Users -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Treated Patients Today
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $treatmentedPatientToday_count }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Number of criticial
                                medicine
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        {{ $criticalMedicine_count }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-medkit fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @hasrole('Admin')
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    {{ $roleNamesAndUserCounts[0]['roleName'] }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $roleNamesAndUserCounts[0]['userCount'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-shield fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    {{ $roleNamesAndUserCounts[1]['roleName'] }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $roleNamesAndUserCounts[1]['userCount'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-md fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    {{ $roleNamesAndUserCounts[2]['roleName'] }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $roleNamesAndUserCounts[2]['userCount'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-nurse fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    {{ $roleNamesAndUserCounts[3]['roleName'] }}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $roleNamesAndUserCounts[3]['userCount'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hospital-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endhasrole
    </div>

    <div class="row">
        <div class="col-md-4">
            <canvas id="patientSexCount" class="border border-primary p-2"></canvas>
        </div>
        <div class="col-md-8">
            <canvas id="patientAgeCount" class="border border-primary p-2"></canvas>
        </div>
    </div>

    @hasrole('Admin')
        <div class="row d-flex justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card border-primary p-2">
                    <div class="card-header">
                        <h5 class="text-primary">List of Users</h5>
                    </div>
                    <div class="card-body">
                        <div style="height: 300px; overflow-y: scroll;">
                            <table class="table" id="myTable">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }} {{ $user->last_name }}
                                            <td>{{ $user->email }}
                                            <td>
                                                @foreach ($user->roles as $role)
                                                    {{ $role->name }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($user->status == 1)
                                                    <a href="{{ route('user.update_status', ['user_id' => $user->id, 'status_code' => 0]) }}"
                                                        class="btn btn-sm btn-danger"><i class="fa fa-ban"></i></a>
                                                @else
                                                    <a href="{{ route('user.update_status', ['user_id' => $user->id, 'status_code' => 1]) }}"
                                                        class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                    @endforelse

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endhasrole
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.2.0/chartjs-plugin-datalabels.min.js"
        integrity="sha512-JPcRR8yFa8mmCsfrw4TNte1ZvF1e3+1SdGMslZvmrzDYxS69J7J49vkFL8u6u8PlPJK+H3voElBtUCzaXj+6ig=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        //Analytics about Patient
        const patientSexCount = document.getElementById('patientSexCount');
        new Chart(patientSexCount, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: [
                        {{ $patientMaleCount }},
                        {{ $patientFemaleCount }},
                    ],
                    borderWidth: 1,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                    ],
                }],
                labels: [
                    'Male',
                    'Female',

                ]
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
                        text: 'No. of Patients by Sex'
                    }
                },
                // scales: {
                //     y: {
                //         beginAtZero: true
                //     }

                // },
            }
        });
        const patientAgeCount = document.getElementById('patientAgeCount');
        new Chart(patientAgeCount, {
            type: 'bar',
            data: {
                labels: [
                    'New Born - 0M to 1M',
                    'Infants - 1M to 1Y',
                    'Children - 1Y to 12Y',
                    'Adolescents - 13Y to 17Y',
                    'Adults - 18Y to 60Y',
                    'Senior - 60Y and Above'
                ],
                datasets: [{
                    label: 'Patient Age Group',
                    data: [
                        {{ $newborns_Cnt }},
                        {{ $infants_Cnt }},
                        {{ $children_Cnt }},
                        {{ $adolescents_Cnt }},
                        {{ $adults_Cnt }},
                        {{ $senior_Cnt }},
                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        'rgb(54, 162, 235)',
                        'rgb(153, 102, 255)',
                    ],
                    borderWidth: 1
                }],
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
                        text: 'Patient Age Group'
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
@endsection
