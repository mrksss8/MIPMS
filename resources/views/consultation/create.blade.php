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
                                    <span class="input-group-btn mr-2 mt-1">
                                        <button class="btn btn-info" type="submit" title="Search Patient">
                                            <span class="fas fa-search"></span>
                                        </button>
                                    </span>
                                    <input type="text" class="form-control mr-2" name="term"
                                        placeholder="Search Patients" id="term">
                                    <a href="{{ route('consultation.create') }}" class=" mt-1">
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
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($patients as $patient)
                                <tr>
                                    <td>{{ $patient->last_name }}, {{ $patient->first_name }} {{ $patient->middle_name }}
                                    </td>
                                    <td><a href="{{ route('create.consultation', $patient->id) }}"
                                            class="btn btn-sm btn-success">Add
                                            Consultation </a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $patients->onEachSide(3)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
