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

    <div class="row mb-3">
        <div class="col-lg-12 ">
            <div class="card shadow">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-primary fw-bold">Search Patient</h5>
                        </div>
                        <div class="col-md-6">



                            <form action="{{ route('consultation.create') }}" method="GET" role="search">

                                <div class="input-group">
                                    <span class="input-group-btn mr-5 mt-1">
                                        <button class="btn btn-info" type="submit" title="Search Patient">
                                            <span class="fas fa-search"></span>
                                        </button>
                                    </span>
                                    <input type="text" class="form-control mr-2" name="term"
                                        placeholder="Search projects" id="term">
                                    <a href="#" class=" mt-1">
                                        <span class="input-group-btn">
                                            <button class="btn btn-danger" type="button" title="Refresh page">
                                                <span class="fas fa-sync-alt"></span>
                                            </button>
                                        </span>
                                    </a>
                                </div>
                            </form>


                            {{-- 

                            <form>
                                <input type="search" class="form-control" name="search"
                                    placeholder="Search Patient">
                            </form> --}}



                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Full Name</td>
                                <td>Test</td>
                                <td>Test</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                                <tr>
                                    <td>{{ $patient->last_name }}, {{ $patient->first_name }} {{ $patient->middle_name }}
                                    </td>
                                    <td>Test</td>
                                    <td>Test</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12 ">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="text-primary fw-bold">Add Consultation</h5>

                </div>
                <form action="#" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <p class="bg-primary px-5 py-2 text-center " style="color: rgba(255, 255, 255, 0.945)">
                            Consultation Info</p>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="last_name">Date: </label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                        placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="first_name">Age: </label>
                                    <input type="text" class="form-control" name="first_name" id="first_name"
                                        placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="middle_name">Weight: </label>
                                    <input type="text" class="form-control" name="middle_name" id="middle_name"
                                        placeholder="Middle Name">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="birth_date">Height: </label>
                                    <input type="date" class="form-control" name="birth_date" id="birth_date"
                                        placeholder="Birthdate">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="contact_num">Blood Pressure: </label>
                                    <input type="text" name="contact_num" id="contact_num" class="form-control"
                                        placeholder="Contact Number">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="contact_num">Pulse Rate: </label>
                                    <input type="text" name="contact_num" id="contact_num" class="form-control"
                                        placeholder="Contact Number">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="contact_num">Resperatory Rate: </label>
                                    <input type="text" name="contact_num" id="contact_num" class="form-control"
                                        placeholder="Contact Number">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="contact_num">CC: </label>
                                    <input type="text" name="contact_num" id="contact_num" class="form-control"
                                        placeholder="Contact Number">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-md btn-primary"> Submit </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
