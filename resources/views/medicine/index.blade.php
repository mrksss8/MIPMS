@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800 mb-5">{{ __('Medicine Section') }}</h1>

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
                    <h5 class="text-primary fw-bold">Medicine List</h5>
                </div>
                <div class="card-body">

                    {{-- <div class="d-flex justify-content-end mb-4">
                            <button type="button" class="btn btn-primary mr-5" data-toggle="modal" data-target="#store">
                                Add Patient
                            </button>
                        </div> --}}


                    <div>
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Brand Name</th>
                                    <th>Dosage</th>
                                    <th>Stocks</th>
                                    <th>Expiration</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($medicines as $medicine)
                                    <tr>
                                        <td>{{ $medicine->category->category }}</td>
                                        <td>{{ $medicine->brand_name }}</td>
                                        <td>{{ $medicine->dosage->dosage }}</td>
                                        <td>{{ $medicine->stocks }}</td>
                                        <td>{{ $medicine->expi_date }}</td>
                                        <td>
                                            <a href="{{ route('add_stock.create', $medicine->id) }}"
                                                class="btn btn-sm btn-success">Add
                                                Stocks</a>
                                            <a href="{{ route('medicine.edit', $medicine->id) }}"
                                                class="btn btn-sm btn-success">Edit</a>
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
                            {{ $medicines->onEachSide(2)->links() }}
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
                    "targets": [0, 1, 2, 3, 4, 5],
                    "orderable": false,
                }]
            });
        });
    </script>
@endsection
