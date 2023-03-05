@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Medicine Section') }}</h1>

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


    <div class="row d-flex justify-content-center">
        <div class="col-lg-9">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Update Medicine</h5>
                </div>

                <div class="card-body">
                    <p class="bg-success px-5 py-2 text-center " style="color: rgba(255, 255, 255, 0.945)">
                        Update Medicine</p>

                    <form action="{{ route('medicine.update', $medicine->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="brand_name">Brand Name: </label>
                                    <input type="text" class="form-control" name="brand_name" id="brand_name"
                                        placeholder="Brand Name" value={{ $medicine->brand_name }}>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">Category: </label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->category == $medicine->category_id ? 'selected' : '' }}>
                                                {{ $category->category }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dosage_id">Dosage: </label>
                                    <select class="form-control" name="dosage_id" id="dosage_id"
                                        value={{ $medicine->dosage_id }}>
                                        @foreach ($dosages as $dosage)
                                            <option value="{{ $dosage->id }}"
                                                {{ $dosage->dosage == $medicine->dosage_id ? 'selected' : '' }}>
                                                {{ $dosage->dosage }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stocks">Stocks: </label>
                                    <input type="number" class="form-control" name="stocks" id="stocks"
                                        value={{ $medicine->stocks }}>


                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expi_date">expiration date: </label>
                                    <input type="date" class="form-control" name="expi_date"
                                        id="expi_date"value={{ $medicine->expi_date }}>

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
