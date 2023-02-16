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

    <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="text-primary fw-bold">Add Stock</h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('add_stock.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="med_id" value="{{ $medicine->id }}">
                        <input type="hidden" name="brand_name" value="{{ $medicine->brand_name }}">
                        <input type="hidden" name="category_id" value="{{ $medicine->category->id }}">
                        <input type="hidden" name="dosage_id" value="{{ $medicine->dosage->id }}">

                        <div class="row d-flex justify-content-center">
                            <h4 class="my-5"> <strong>Medicine: </strong>
                                {{ $medicine->brand_name }}/{{ $medicine->dosage->dosage }}
                            </h4>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="dosage">Number of Stock: </label>
                                    <input type="number" class="form-control" name="stocks"
                                        placeholder="Enter Stock number" required>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="dosage">Expiration Date: </label>
                                    <input type="date" class="form-control" name="expi_date"
                                        placeholder="Enter Expiration number" required>
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
@endsection
@section('scripts')
@endsection
