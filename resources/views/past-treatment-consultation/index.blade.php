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
        <div class="col-lg-12 ">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="text-primary fw-bold">List of past consulatation</h5>

                </div>
                <div class="card-body">

                    <div>
                        <table class="table" id="myTable">
                            <thead>
                                <tr>
                                    <th>Date of Consultation</th>
                                    <th>Patient Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @forelse ($consultations as $consultation)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($consultation->date)->format('Y, F j') }} </td>
                                        <td>{{ $consultation->patient->last_name }},
                                            {{ $consultation->patient->first_name }}
                                            {{ $consultation->patient->middle_name }}
                                        </td>
                                        <td>
                                            <a href="{{ route('past_treatment_consultation.show', $consultation->id) }}"
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
                            {{ $consultations->onEachSide(2)->links() }}
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
