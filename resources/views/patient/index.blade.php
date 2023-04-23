@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 mb-5">{{ __('Patients Section') }}</h1>

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

    <div class="row">
        <div class="col-lg-12 ">
            <div class="card shadow">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h5 class="text-primary fw-bold">Patient List</h5>
                        </div>
                        <div class="col-md-6">



                            <form action="{{ route('patient.index') }}" method="GET" role="search">

                                <div class="input-group">
                                    <span class="input-group-btn mr-2 mt-1">
                                        <button class="btn btn-info" type="submit" title="Search Patient">
                                            <span class="fas fa-search"></span>
                                        </button>
                                    </span>
                                    <input type="text" class="form-control mr-2" name="term"
                                        placeholder="Search Patients" id="term">
                                    <a href="{{ route('patient.index') }}" class=" mt-1">
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

                    {{-- <div class="d-flex justify-content-end mb-4">
                            <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#store">
                                Add Patient
                            </button>
                        </div> --}}


                    <div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($patients as $patient)
                                    <tr>
                                        <td>{{ $patient->last_name }}, {{ $patient->first_name }}
                                            {{ $patient->middle_name }}</td>
                                        <td>
                                            <a href="{{ route('patient.show', $patient->id) }}"
                                                class="btn btn-sm btn-success">View</a>
                                        </td>
                                    </tr>
                                @empty
                                    {{-- <tr>
                                        <td colspan="100">
                                            <p class="text-center">No Data Found!</p>
                                        </td>
                                    </tr> --}}
                                @endforelse

                            </tbody>
                        </table>
                        <div class="card-footer">
                            {{ $patients->onEachSide(2)->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"
        integrity="sha512-STof4xm1wgkfm7heWqFJVn58Hm3EtS31XFaagaa8VMReCXAkQnJZ+jEy8PCC/iT18dFy95WcExNHFTqLyp72eQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('datatables/dataTables.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                dom: 'ft',

                "order": [],
                "columnDefs": [{
                    "targets": 'no-sort',
                    "orderable": false,
                }]
            });
        });
    </script>
@endsection
