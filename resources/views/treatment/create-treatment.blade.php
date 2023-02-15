@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Treatment Section') }}</h1>

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

        <div class="col-lg-4">
            <div class="card shadow">
                <div class="card-body text-center">
                    <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                        class="rounded-circle img-fluid" style="width: 120px;">
                    <h5 class="mt-3 mb-0">{{ $consultation->patient->last_name }}, {{ $consultation->patient->first_name }}
                    </h5>
                    {{-- <p class="text-muted mb-1">Full Stack Developer</p> --}}
                    <p class="text-muted">{{ $consultation->patient->address->brgy }},
                        {{ $consultation->patient->address->muniCity }}</p>

                    <a href="{{ route('patient.show', $consultation->patient->id) }}" class="btn btn-primary mb-3">See
                        Profile</a>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Sex</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $consultation->patient->sex }}</p>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Birthday</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $consultation->patient->birth_date }}</p>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Age</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">20</p>
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Phone</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0">{{ $consultation->patient->contact_num }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="fw-bold">Consultation date
                        <strong>{{ $consultation->date }}</strong>
                    </h5>

                </div>

                <div class="card-body">
                    <p class="bg-primary px-5 py-2 text-center " style="color: rgba(255, 255, 255, 0.945)">
                        Consultation Information</p>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="last_name">Date: </label>
                                <input type="date" class="form-control" disabled value="{{ $consultation->date }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="first_name">Age: </label>
                                <input type="number" class="form-control" disabled value="20">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="middle_name">Height: </label>
                                <input type="number" class="form-control" disabled value="{{ $consultation->height }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="middle_name">Weight: </label>
                                <input type="number" class="form-control" disabled value="{{ $consultation->weight }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="last_name">BP: </label>
                                <input type="text" class="form-control" disabled value="{{ $consultation->BP }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="first_name">PR: </label>
                                <input type="text" class="form-control" disabled value="{{ $consultation->PR }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="middle_name">RR: </label>
                                <input type="text" class="form-control" disabled value="{{ $consultation->RR }}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="middle_name">CC: </label>
                                <input type="text" class="form-control" disabled value="{{ $consultation->CC }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="exampleFormControlTextarea1">Other Information</label>
                                <textarea class="form-control" disabled value="{{ $consultation->other_info }}"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header">
                    <p class="bg-success px-5 py-2 text-center m-0" style="color: rgba(255, 255, 255, 0.945)">
                        Give Treatment</p>
                </div>
                <div class="card-body">
                    <form action="{{ route('treatment.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="consultation_id" value={{ $consultation->id }}>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Comments/Findings</label>
                                    <textarea class="form-control" name="findings"></textarea>
                                </div>
                            </div>
                        </div>

                        <p class="bg-success text-center py-2" style="width: 30%;">Medicines</p>

                        <div id="items">
                            <div class="row">
                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="medicine_id">Brand Name: </label>
                                        <select class="form-control" name="medicine_id[]" id="medicine_id" required>
                                            <option selected disabled>Brand Name</option>`
                                            @foreach ($medicines->where('stocks', '>', 0) as $medicine)
                                                <option value="{{ $medicine->med_id }}">
                                                    {{ $medicine->brand_name }}/{{ $medicine->dosage->dosage }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <div class="form-group">
                                        <label for="quantity">Quantity: </label>
                                        <input type="text" class="form-control" name="quantity[]" id="quantity"
                                            placeholder="Quantity">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="description">Description: </label>
                                        <input type="text" class="form-control" name="description[]" id="description"
                                            placeholder="Description">
                                    </div>
                                </div>
                            </div>
                        </div>


                        <button id="add" class="btn add-more button-yellow uppercase" type="button">+ Add another
                            Medicine</button>
                        <a class="delete btn button-white uppercase">- Remove Medicine</a>


                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-md btn-primary"> Save Treatment </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $(".delete").hide();
            //when the Add Field button is clicked
            $("#add").click(function(e) {
                $(".delete").fadeIn("1500");
                //Append a new row of code to the "#items" div
                $("#items").append(
                    '<div class="row next-referral"> <div class="col-3"> <div class="form-group"> <label for="medicine_id">Brand Name: </label> <select class="form-control" name="medicine_id[]" id="medicine_id" required> <option selected disabled>Brand Name</option> @foreach ($medicines as $medicine) <option value="{{ $medicine->med_id }}">{{ $medicine->brand_name }}/{{ $medicine->dosage->dosage }}</option> @endforeach </select> </div> </div><div class="col-3"> <div class="form-group"> <label for="quantity">Quantity: </label> <input type="text" class="form-control" name="quantity[]" id="quantity" placeholder="Quantity"> </div> </div> <div class="col-6"> <div class="form-group"> <label for="description">Description: </label> <input type="text" class="form-control" name="description[]" id="description" placeholder="Description"> </div> </div> </div>'
                );
            });
            $("body").on("click", ".delete", function(e) {
                $(".next-referral").last().remove();
            });
        });
    </script>
@endsection
