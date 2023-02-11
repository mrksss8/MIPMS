@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 mb-5">{{ __('Consultation Section') }}</h1>

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
        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                        class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="mt-3 mb-0">{{ $patient->last_name }}, {{ $patient->first_name }}</h5>
                    {{-- <p class="text-muted mb-1">Full Stack Developer</p> --}}
                    <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>

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
                    <div class="mb-2 border border-primary rounded py-2 mt-4">
                        <p class="text-primary mb-3">PhilHealth Details</p>
                        <p class="text-muted m-0">Category: {{ $patient->philHealthInfo->category ?? 'None' }}</p>
                        <p class="text-muted m-0">PIN: {{ $patient->philHealthInfo->pin ?? 'None' }}</p>
                        <p class="text-muted m-0">Classification: {{ $patient->philHealthInfo->classification ?? 'None' }}
                        </p>
                    </div>
                </div>
            </div>


        </div>

        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="text-primary fw-bold">Create Consultation</h5>

                </div>
                <form action="{{ route('consultation.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="patient_id" id="patient_id" value="{{ $patient->id }}">
                    <div class="card-body">
                        <p class="bg-primary px-5 py-2 text-center " style="color: rgba(255, 255, 255, 0.945)">
                            Information</p>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="last_name">Date: </label>
                                    <input type="date" class="form-control" name="date" id="date"
                                        placeholder="Date">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="first_name">Age: </label>
                                    <input type="number" class="form-control" name="age" id="age"
                                        placeholder="Age">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="middle_name">Height: </label>
                                    <input type="number" class="form-control" name="height" id="height"
                                        placeholder="Height">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="middle_name">Weight: </label>
                                    <input type="number" class="form-control" name="weight" id="weght"
                                        placeholder="Weight">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="last_name">BP: </label>
                                    <input type="text" class="form-control" name="BP" id="BP"
                                        placeholder="BP">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="first_name">PR: </label>
                                    <input type="text" class="form-control" name="PR" id="PR"
                                        placeholder="PR">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="middle_name">RR: </label>
                                    <input type="text" class="form-control" name="RR" id="RR"
                                        placeholder="RR">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="middle_name">CC: </label>
                                    <input type="text" class="form-control" name="CC" id="CC"
                                        placeholder="CC">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Other Information</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="other_info"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-md btn-primary"> Save Consultation </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
