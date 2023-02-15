@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Consultation Section') }}</h1>

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
                    <h5 class="mt-3 mb-0">{{ $consultation->patient->last_name }}, {{ $consultation->patient->first_name }}
                    </h5>
                    {{-- <p class="text-muted mb-1">Full Stack Developer</p> --}}
                    <p class="text-muted ">{{ $consultation->patient->address->brgy }},
                        {{ $consultation->patient->address->muniCity }}</p>

                    <a href="{{ route('patient.show', $consultation->patient->id) }}" class="btn btn-primary my-3">See
                        Profile</a>
                    <hr class="my-2">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Sex</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $consultation->patient->sex }}</p>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Birthday</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $consultation->patient->birth_date }}</p>
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
                            <p class="text-muted mb-0">{{ $consultation->patient->contact_num }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="fw-bold bg-success p-3">This is past consultation from
                        <strong>{{ $consultation->date }}</strong>
                    </h5>

                </div>

                <div class="card-body">
                    <p class="bg-primary px-5 py-2 text-center " style="color: rgba(255, 255, 255, 0.945)">
                        Consultation Information</p>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="last_name">Date: </label>
                                <input type="date" class="form-control" disabled value="{{ $consultation->date }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="first_name">Age: </label>
                                <input type="number" class="form-control" disabled value="20">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="middle_name">Height: </label>
                                <input type="number" class="form-control" disabled value="{{ $consultation->height }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="middle_name">Weight: </label>
                                <input type="number" class="form-control" disabled value="{{ $consultation->weight }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="last_name">BP: </label>
                                <input type="text" class="form-control" disabled value="{{ $consultation->BP }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="first_name">PR: </label>
                                <input type="text" class="form-control" disabled value="{{ $consultation->PR }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="middle_name">RR: </label>
                                <input type="text" class="form-control" disabled value="{{ $consultation->RR }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="middle_name">CC: </label>
                                <input type="text" class="form-control" disabled value="{{ $consultation->CC }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Other Information</label>
                                <textarea class="form-control" disabled value="{{ $consultation->other_info }}"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    @if ($consultation->treatment_id != null)
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow">
                    <div class="card-header">
                        <p class="bg-success px-5 py-2 text-center mb-0" style="color: rgba(255, 255, 255, 0.945)">
                            Treatment Given</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Comments/Findings</label>
                                    <textarea class="form-control" disabled>{{ $consultation->treatment->findings }}</textarea>
                                </div>
                            </div>
                        </div>

                        @foreach ($consultation->treatment->medicine as $medicine)
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="quantity">Brand Name: </label>
                                        <input type="text" class="form-control"
                                            value="  {{ $medicine->brand_name }}/{{ $medicine->dosage->dosage }}">

                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="quantity">Quantity: </label>
                                        <input type="text" class="form-control"
                                            value="{{ $medicine->pivot->quantity }}">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="description">Description: </label>
                                        <input type="text" class="form-control"
                                            value="{{ $medicine->pivot->description }}">
                                    </div>
                                </div>

                            </div>
                        @endforeach
                        <div class="card-footer text-center">

                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body text-center bg-warning">
                        <h4>This consultation has no treatment yet!</h4>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
