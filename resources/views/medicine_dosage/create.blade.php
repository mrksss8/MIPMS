@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Medicine Dosage Section') }}</h1>

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
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header">
                    <h5>Create Medicine Dosage</h5>
                </div>

                <div class="card-body">
                    <p class="bg-success px-5 py-2 text-center " style="color: rgba(255, 255, 255, 0.945)">
                        Create Medicine Dosage</p>

                    <form action="{{ route('medicine_dosage.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="dosage">Dosage: </label>
                                    <input type="text" class="form-control" name="dosage" id="dosage"
                                        placeholder="Dosage">
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
    @endsection
