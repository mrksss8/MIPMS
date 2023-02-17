<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Patient Management System">
    <meta name="author" content="Mark Anthony Bautista">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


    <!-- Custom Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap');

        *,
        h1 {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <!-- data tables-->
    <link href="{{ asset('datatables/dataTables.css') }}" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png">
</head>

<body
    style="background:linear-gradient(rgba(189, 212, 255, 0.8), rgba(155, 172, 204, 0.6)), url('{{ asset('img/bg-search.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card shadow mb-4">
                    <div class="card-body">

                        <p class="p-1 bg-primary text-center ">
                            <span class="text-white">
                                Patient Personal Info
                            </span>
                        </p>

                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Family ID</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $patient->family_id }} </p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $patient->first_name }} {{ $patient->middle_name }}
                                    {{ $patient->last_name }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $patient->address->house_num }},
                                    {{ $patient->address->street }},
                                    {{ $patient->address->purok }},{{ $patient->address->brgy }},
                                    {{ $patient->address->muniCity }},
                                    {{ $patient->address->province }}
                                </p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Sex</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $patient->sex }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Birthday</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    {{ \Carbon\Carbon::parse($patient->birth_date)->format('F j, Y') }}
                                </p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Age</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">
                                    {{ \Carbon\Carbon::parse($patient->birth_date)->diff(\Carbon\Carbon::now())->format('%y years old') }}
                                </p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $patient->contact_num }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Civil Status</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $patient->civil_status }}</p>
                            </div>
                        </div>
                        <p class="mt-2 p-1 bg-primary text-center ">
                            <span class="text-white">
                                PhilHealth Info
                            </span>
                        </p>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Category</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $patient->philHealthInfo->category ?? 'None' }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">PIN</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $patient->philHealthInfo->pin ?? 'None' }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Classification</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $patient->philHealthInfo->classification ?? 'None' }}
                                </p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p class="p-1 bg-primary text-center">
                            <span class="text-white">
                                Infants / Child Info
                            </span>
                        </p>

                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Father's Name</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">
                                    {{ $patient->infaChildInfo->father_name ?? 'None' }}
                                </p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Mother's Name</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">
                                    {{ $patient->infaChildInfo->mother_name ?? 'None' }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Place of Delivey</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">
                                    {{ $patient->infaChildInfo->place_delivery ?? 'None' }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Type of Delivery</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">
                                    {{ $patient->infaChildInfo->type_of_delivery ?? 'None' }}
                                </p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Attended By</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">
                                    {{ $patient->infaChildInfo->attended_by ?? 'None' }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Birth height</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">
                                    {{ $patient->infaChildInfo->birth_weight ?? 'None' }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Birth Weight</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">
                                    {{ $patient->infaChildInfo->birth_height ?? 'None' }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Date of NBS</p>
                            </div>
                            <div class="col-sm-8">


                                @if (!empty($patient->infaChildInfo->date_of_NBS))
                                    {{ \Carbon\Carbon::parse($patient->infaChildInfo->date_of_NBS)->format('F j, Y') }}
                                @else
                                    None
                                @endif

                                </p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Mother TT Status</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">
                                    {{ $patient->infaChildInfo->mother_TT_status ?? 'None' }}
                                </p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Immune at other Facilities</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">
                                    {{ $patient->infaChildInfo->immun_at_other_facility ?? 'None' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p class="p-1 bg-primary text-center ">
                            <span class="text-white">
                                Pregnant Women Info
                            </span>
                        </p>

                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Gradiva</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">{{ $patient->pregWomen->gradiva ?? 'None' }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">PARA</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">{{ $patient->pregWomen->para ?? 'None' }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">LMP</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">{{ $patient->pregWomen->LMP ?? 'None' }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">EDC</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">{{ $patient->pregWomen->EDC ?? 'None' }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">TT status</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">{{ $patient->pregWomen->TT_status ?? 'None' }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Name of Husband</p>
                            </div>
                            <div class="col-sm-8">
                                <p class="text-muted mb-0">
                                    {{ $patient->pregWomen->name_of_husband ?? 'None' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>
