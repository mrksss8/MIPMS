@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 mb-5">{{ __('Barangay Section') }}</h1>

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

    <div class="row d-flex justify-content-center align-items-center mb-5">
        <div class="col-lg-9">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="text-primary fw-bold">Add Barangay</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('brgy.store') }}" method="POST">
                        @csrf
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="brand_name">Barangay Name: </label>
                                    <input type="text" class="form-control" name="barangay" placeholder="Barangay Name"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-md btn-primary px-5"> Save </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 ">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="text-primary fw-bold">List of Barangay</h5>
                </div>
                <div class="card-body">
                    <div>
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>Barangay</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($brgys as $brgy)
                                    <tr>
                                        <td>{{ $brgy->barangay }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        <div class="card-footer">

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
