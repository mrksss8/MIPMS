@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Patients Section') }}</h1>

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
        <div class="col-lg-3">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                        class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="mt-3 mb-0">{{ $patient->last_name }}, {{ $patient->first_name }}</h5>
                    {{-- <p class="text-muted mb-1">Full Stack Developer</p> --}}
                    <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
                    <div class="mb-2 border border-primary rounded py-2 ">
                        <p class="text-primary mb-3">PhilHealth Details</p>
                        <p class="text-muted m-0">Category: {{ $patient->philHealthInfo->category ?? 'None' }}</p>
                        <p class="text-muted m-0">PIN: {{ $patient->philHealthInfo->pin ?? 'None' }}</p>
                        <p class="text-muted m-0">Classification: {{ $patient->philHealthInfo->classification ?? 'None' }}
                        </p>
                    </div>
                </div>
            </div>
            {{-- <div class="card shadow mb-4 mb-lg-0">
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush rounded-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fas fa-globe fa-lg text-warning"></i>
                            <p class="mb-0">https://mdbootstrap.com</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                            <p class="mb-0">mdbootstrap</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                            <p class="mb-0">@mdbootstrap</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                            <p class="mb-0">mdbootstrap</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                            <p class="mb-0">mdbootstrap</p>
                        </li>
                    </ul>
                </div>
            </div> --}}
        </div>
        <div class="col-lg-9">
            <div class="card shadow mb-4">
                <div class="card-body">

                    <p class="p-1 bg-primary text-center ">
                        <span class="text-white">
                            Patient Personal Info
                        </span>
                    </p>

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
                            <p class="text-muted mb-0">Bay Area, San Francisco, CA</p>
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
                            <p class="text-muted mb-0">{{ $patient->birth_date }}</p>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Age</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">20</p>
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
                                    <p class="text-muted mb-0">{{ $patient->infaChildInfo->mother_name ?? 'None' }}</p>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Place of Delivey</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">{{ $patient->infaChildInfo->place_delivery ?? 'None' }}</p>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Type of Delivery</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">{{ $patient->infaChildInfo->type_of_delivery ?? 'None' }}
                                    </p>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Attended By</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">{{ $patient->infaChildInfo->attended_by ?? 'None' }}</p>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Birth height</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">{{ $patient->infaChildInfo->birth_weight ?? 'None' }}</p>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Birth Weight</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">{{ $patient->infaChildInfo->birth_height ?? 'None' }}</p>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Date of NBS</p>
                                </div>
                                <div class="col-sm-8">{{ $patient->infaChildInfo->date_of_NBS ?? 'None' }}</p>
                                </div>
                            </div>
                            <hr class="my-2">
                            <div class="row">
                                <div class="col-sm-4">
                                    <p class="mb-0">Mother TT Status</p>
                                </div>
                                <div class="col-sm-8">
                                    <p class="text-muted mb-0">{{ $patient->infaChildInfo->mother_TT_status ?? 'None' }}
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
                                    <p class="text-muted mb-0">{{ $patient->pregWomen->name_of_husband ?? 'None' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
