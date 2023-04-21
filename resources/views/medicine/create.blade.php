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
                    <h5>Create Medicine</h5>
                </div>

                <div class="card-body">
                    <p class="bg-success px-5 py-2 text-center " style="color: rgba(255, 255, 255, 0.945)">
                        Create Medicine</p>

                    <form action="{{ route('medicine.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="brand_name">Brand Name: </label>
                                    <input type="text" class="form-control" name="brand_name" id="brand_name"
                                        placeholder="Brand Name" required value="{{ old('brand_name') }}">
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category_id">Category: </label>
                                    <select class="form-control" name="category_id" id="category_id"
                                        value={{ old('category_id') }}>
                                        <option selected disabled>Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ $category->category == old('category_id') ? 'selected' : '' }}>
                                                {{ $category->category }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dosage_id">Dosage: </label>
                                    <select class="form-control" name="dosage_id" id="dosage_id"
                                        value={{ old('dosage_id') }}>
                                        <option selected disabled>Dosage</option>
                                        @foreach ($dosages as $dosage)
                                            <option value="{{ $dosage->id }}"
                                                {{ $dosage->dosage == old('dosage_id') ? 'selected' : '' }}>
                                                {{ $dosage->dosage }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stocks">Stocks: </label>
                                    <input type="number" class="form-control" name="stocks" id="stocks"
                                        placeholder="stocks" required value="{{ old('stocks') }}">
                                    @error('stocks')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="expi_date">expiration date: </label>
                                    <input type="date" class="form-control" name="expi_date" id="expi_date"
                                        placeholder="expi_date" required value="{{ old('expi_date') }}">
                                    @error('expi_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
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
    <script>
        var today = new Date().toISOString().split('T')[0];
        document.getElementsByName("expi_date")[0].setAttribute('min', today);
    </script>
@endsection
