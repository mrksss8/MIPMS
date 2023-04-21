@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Patients Section') }} / Edit</h1>

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
    <form action="{{ route('patient.update', $patient->id) }}" method="POST">
        @csrf
        <div class="row px-5 py-2">
            <div class="col-flex justify-content-end ml-auto">
                <button class="btn btn-success btn-md shadow"> <i class="fas fa-fw fa-save"></i> Save Info</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="card shadow mb-4">
                    <div class="card-body text-center">
                        <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava3.webp" alt="avatar"
                            class="rounded-circle img-fluid" style="width: 150px;">
                        <h5 class="mt-3 mb-0">{{ $patient->last_name }}, {{ $patient->first_name }}</h5>
                        {{-- <p class="text-muted mb-1">Full Stack Developer</p> --}}
                        <p class="text-muted mb-4">{{ $patient->address->brgy }}, {{ $patient->address->muniCity }}</p>
                        <div class="mb-2 border border-primary rounded py-2 px-4">

                            <p class="text-primary mb-3">PhilHealth Details</p>
                            <div class="form-group row">
                                <label for="classification">Category: </label>
                                <input type="text" class="form-control" name="category" id="category"
                                    placeholder="Category" value="{{ $patient->philHealthInfo->category ?? 'None' }}">
                                @error('category')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="pin">PIN: </label>
                                <input type="text" class="form-control" name="pin" id="pin" placeholder="PIN"
                                    value="{{ $patient->philHealthInfo->pin ?? 'None' }}">
                                @error('pin')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group row">
                                <label for="classification">Classification:</label>
                                <select class="form-control" name="classification" id="classification">
                                    <option value="none" {{ $patient->philHealthInfo ? '' : 'selected' }}>None</option>
                                    <option value="member"
                                        {{ $patient->philHealthInfo && $patient->philHealthInfo->classification === 'member' ? 'selected' : '' }}>
                                        Member</option>
                                    <option value="dependent"
                                        {{ $patient->philHealthInfo && $patient->philHealthInfo->classification === 'dependent' ? 'selected' : '' }}>
                                        Dependent</option>
                                </select>
                                @error('classification')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- <p class="text-muted m-0">Category: {{ $patient->philHealthInfo->category ?? 'None' }}</p> --}}
                            {{-- <p class="text-muted m-0">PIN: {{ $patient->philHealthInfo->pin ?? 'None' }}</p> --}}
                            {{-- <p class="text-muted m-0">Classification: {{ $patient->philHealthInfo->classification ?? 'None' }} --}}
                            </p>
                        </div>
                    </div>
                </div>
                {{-- <div class="card shadow mb-4 mb-lg-0">
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush rounded-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fas fa-globe fa-lg text-warning"></i>
                            <p class="mb-0">https://mdbootstrap.com</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fab fa-github fa-lg" style="color: #333333;"></i>
                            <p class="mb-0">mdbootstrap</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fab fa-twitter fa-lg" style="color: #55acee;"></i>
                            <p class="mb-0">@mdbootstrap</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fab fa-instagram fa-lg" style="color: #ac2bac;"></i>
                            <p class="mb-0">mdbootstrap</p>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                            <i class="fab fa-facebook-f fa-lg" style="color: #3b5998;"></i>
                            <p class="mb-0">mdbootstrap</p>
                        </li>
                    </ul>
                </div>
            </div> --}}
            </div>
            <div class="col-lg-9">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p class="p-1 bg-primary text-center ">
                            <span class="text-white">
                                Patient Personal Info
                            </span>
                        </p>
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Family ID</p>
                            </div>
                            <div class="col-sm-9">
                                <p class="text-muted mb-0">{{ $patient->family_id }}</p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Full Name</p>
                            </div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-md-3 mx-2">
                                        <div class="form-group row">
                                            <label for="middle_name">First Name: </label>
                                            <input type="text" class="form-control" name="first_name"
                                                value="{{ $patient->first_name ?? 'None' }}">
                                            @error('first_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 mx-2">
                                        <div class="form-group row">
                                            <label for="middle_name">Middle Name: </label>
                                            <input type="text" class="form-control" name="middle_name"
                                                value="{{ $patient->middle_name ?? 'None' }}">
                                            @error('middle_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3 mx-2">
                                        <div class="form-group row">
                                            <label for="middle_name">Last Name: </label>
                                            <input type="text" class="form-control" name="last_name"
                                                value="{{ $patient->last_name ?? 'None' }}">
                                            @error('last_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                {{-- <p class="text-muted mb-0">{{ $patient->first_name }} {{ $patient->middle_name }}
                                {{ $patient->last_name }}</p> --}}
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Address</p>
                            </div>
                            <div class="col-sm-9">
                                <div class="row">
                                    <div class="col-4">
                                        <label for="house_num">House Number: </label>
                                        <input type="text" class="form-control" name="house_num" id="house_num"
                                            placeholder="House Number" value="{{ $patient->address->house_num }}">
                                        @error('house_num')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="street">Street: </label>
                                        <input type="text" class="form-control" name="street" id="street"
                                            placeholder="Street" value="{{ $patient->address->street }}">
                                        @error('street')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="purok">Purok: </label>
                                        <input type="text" class="form-control" name="purok" id="purok"
                                            placeholder="Purok" value="{{ $patient->address->purok }}">
                                        @error('purok')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-4">
                                        <label for="brgy">Barangay: </label>
                                        <select class="form-control" name="brgy" id="brgy">
                                            <option selected disabled>Barangay</option>
                                            @foreach ($brgys as $brgy)
                                                <option value="{{ $brgy->barangay }}"
                                                    {{ $brgy->barangay == $patient->address->brgy ? 'selected' : '' }}>
                                                    {{ $brgy->barangay }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('brgy')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="muniCity">Municipality/City: </label>
                                        <input type="text" class="form-control" name="muniCity" id="muniCity"
                                            placeholder="Municipality/City" value="{{ $patient->address->muniCity }}">
                                        @error('muniCity')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-4">
                                        <label for="province">Province: </label>
                                        <input type="text" class="form-control" name="province" id="province"
                                            placeholder="province" value="{{ $patient->address->province }}">
                                        @error('province')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- <p class="text-muted mb-0">{{ $patient->address->house_num }},
                                {{ $patient->address->street }},
                                {{ $patient->address->purok }},{{ $patient->address->brgy }},
                                {{ $patient->address->muniCity }},
                                {{ $patient->address->province }}
                            </p> --}}
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Sex</p>
                            </div>
                            <div class="col-sm-9">
                                <select class="form-control" name="sex" id="sex" value="{{ $patient->sex }}">
                                    <option selected disabled>Sex</option>
                                    <option value="male" {{ $patient->sex == 'male' ? 'selected' : '' }}>
                                        Male </option>
                                    <option value="female" {{ $patient->sex == 'female' ? 'selected' : '' }}>
                                        Female </option>
                                </select>
                                @error('sex')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">{{ $patient->sex }}</p> --}}
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Birthday</p>
                            </div>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" name="birth_date" id="birth_date"
                                    placeholder="Birthdate" value="{{ $patient->birth_date }}">
                                @error('birth_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">{{ \Carbon\Carbon::parse($patient->birth_date)->format('F j, Y') }}
                            </p> --}}
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Phone</p>
                            </div>
                            <div class="col-sm-9">
                                <input type="text" name="contact_num" id="contact_num" class="form-control"
                                    placeholder="Contact Number" value="{{ $patient->contact_num }}">
                                @error('contact_num')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">{{ $patient->contact_num }}</p> --}}
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-3">
                                <p class="mb-0">Civil Status</p>
                            </div>
                            <div class="col-sm-9">
                                <select class="form-control" name="civil_status" id="civil_status"
                                    value={{ $patient->civil_status }}>
                                    <option selected disabled>Civil Status</option>
                                    <option value="single" {{ $patient->civil_status == 'single' ? 'selected' : '' }}>
                                        Single</option>
                                    <option value="married" {{ $patient->civil_status == 'married' ? 'selected' : '' }}>
                                        Married </option>
                                    <option value="divorced" {{ $patient->civil_status == 'divorced' ? 'selected' : '' }}>
                                        Divorced </option>
                                    <option value="separated"
                                        {{ $patient->civil_status == 'separated' ? 'selected' : '' }}>
                                        Separated </option>
                                    <option value="widowed" {{ $patient->civil_status == 'widowed' ? 'selected' : '' }}>
                                        Widowed </option>
                                </select>
                                @error('civil_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">{{ $patient->civil_status }}</p> --}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-6">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p class="p-1 bg-primary text-center">
                            <span class="text-white">
                                Infants / Child Info
                            </span>
                        </p>

                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Father's Name</p>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="father_name" class="form-control" id="father_name"
                                    placeholder="Father's Name"
                                    value="{{ $patient->infaChildInfo->father_name ?? ' ' }}">
                                @error('father_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">
                                    {{ $patient->infaChildInfo->father_name ?? 'None' }}
                                </p> --}}
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Mother's Name</p>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="mother_name" class="form-control" id="mother_name"
                                    placeholder="Mother's Name"
                                    value="{{ $patient->infaChildInfo->mother_name ?? ' ' }}">
                                @error('mother_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">{{ $patient->infaChildInfo->mother_name ?? 'None' }}</p> --}}
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Place of Delivey</p>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="place_delivery" class="form-control" id="place_delivery"
                                    placeholder="Place of Delivey"
                                    value="{{ $patient->infaChildInfo->place_delivery ?? ' ' }}">
                                @error('place_delivery')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">{{ $patient->infaChildInfo->place_delivery ?? 'None' }}</p> --}}
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Type of Delivery</p>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="type_of_delivery" class="form-control" id="type_of_delivery"
                                    placeholder="Type of Delivery"
                                    value="{{ $patient->infaChildInfo->type_of_delivery ?? ' ' }}">
                                @error('type_of_delivery')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">{{ $patient->infaChildInfo->type_of_delivery ?? 'None' }} --}}
                                </p>
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Attended By</p>
                            </div>
                            <div class="col-sm-8">
                                <select class="form-control" name="attended_by" id="attended_by"
                                    value="{{ $patient->infaChildInfo->attended_by ?? 'None' }}">

                                    <option selected disabled>Attended By</option>
                                    <option value="Nurse"
                                        {{ $patient->infaChildInfo->attended_by ?? 'None' === 'Nurse' ? 'selected' : '' }}>
                                        Nurse</option>
                                    <option value="Doctor"
                                        {{ $patient->infaChildInfo->attended_by ?? 'None' === 'Doctor' ? 'selected' : '' }}>
                                        Doctor</option>
                                    <option value="Midwife"
                                        {{ $patient->infaChildInfo->attended_by ?? 'None' === 'Midwife' ? 'selected' : '' }}>
                                        Midwife</option>

                                </select>
                                @error('attended_by')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">{{ $patient->infaChildInfo->attended_by ?? 'None' }}</p> --}}
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Birth height (CM)</p>
                            </div>
                            <div class="col-sm-8">
                                <input type="number" name="birth_height" class="form-control" id="birth_height"
                                    placeholder="Birth Height"
                                    value="{{ $patient->infaChildInfo->birth_weight ?? 'None' }}">
                                @error('birth_height')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">{{ $patient->infaChildInfo->birth_weight ?? 'None' }} CM
                                </p> --}}
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Birth Weight</p>
                            </div>
                            <div class="col-sm-8">
                                <input type="number" name="birth_weight" class="form-control" id="birth_weight"
                                    placeholder="Birth Weight"
                                    value="{{ $patient->infaChildInfo->birth_height ?? 'None' }}">
                                @error('birth_weight')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">{{ $patient->infaChildInfo->birth_height ?? 'None' }} KG
                                </p> --}}
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Date of NBS</p>
                            </div>
                            <div class="col-sm-8">
                                <input type="date" name="date_of_NBS" class="form-control" id="date_of_NBS"
                                    placeholder="Mother TT status"
                                    value="{{ $patient->infaChildInfo->date_of_NBS ?? 'None' }}">
                                @error('date_of_NBS')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                {{-- <p>
                                    @if (isset($patient->infaChildInfo->date_of_NBS))
                                        {{ \Carbon\Carbon::parse($patient->infaChildInfo->date_of_NBS)->format('F j, Y') }}
                                    @else
                                        None
                                    @endif
                                </p> --}}

                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Mother TT Status</p>
                            </div>
                            <div class="col-sm-8">
                                <select class="form-control" name="mother_TT_status" id="mother_TT_status"
                                    value={{ $patient->infaChildInfo->mother_TT_status ?? 'None' }}>

                                    <option value="T1"
                                        {{ $patient->infaChildInfo->mother_TT_status ?? 'None' === 'T1' ? 'selected' : '' }}>
                                        T1</option>
                                    <option value="T2"
                                        {{ $patient->infaChildInfo->mother_TT_status ?? 'None' === 'T2' ? 'selected' : '' }}>
                                        T2</option>
                                    <option value="T3"
                                        {{ $patient->infaChildInfo->mother_TT_status ?? 'None' === 'T3' ? 'selected' : '' }}>
                                        T3</option>
                                    <option value="T4"
                                        {{ $patient->infaChildInfo->mother_TT_status ?? 'None' === 'T4' ? 'selected' : '' }}>
                                        T4</option>
                                    <option value="T5"
                                        {{ $patient->infaChildInfo->mother_TT_status ?? 'None' === 'T5' ? 'selected' : '' }}>
                                        T5</option>

                                </select>
                                @error('mother_TT_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">{{ $patient->infaChildInfo->mother_TT_status ?? 'None' }}
                                </p> --}}
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Immune at other Facilities</p>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" name="immun_at_other_facility" class="form-control"
                                    id="immun_at_other_facility" placeholder="Immune at other Facilities"
                                    value="{{ $patient->infaChildInfo->immun_at_other_facility ?? ' ' }}">
                                @error('immun_at_other_facility')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">
                                    {{ $patient->infaChildInfo->immun_at_other_facility ?? 'None' }}</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6" id="preg_women">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <p class="p-1 bg-primary text-center ">
                            <span class="text-white">
                                Pregnant Women Info
                            </span>
                        </p>

                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Gradiva</p>
                            </div>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="gradiva"
                                    id="gradiva"value="{{ $patient->pregWomen->gradiva ?? ' ' }}">
                                @error('gradiva')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">{{ $patient->pregWomen->gradiva ?? 'None' }}</p> --}}
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">PARA</p>
                            </div>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="para" id="para"
                                    value="{{ $patient->pregWomen->para ?? ' ' }}">
                                @error('para')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">{{ $patient->pregWomen->para ?? 'None' }}</p> --}}
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">LMP</p>
                            </div>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="LMP" id="LMP"
                                    placeholder="LMP" value="{{ $patient->pregWomen->LMP ?? ' ' }}">
                                @error('LMP')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">{{ $patient->pregWomen->LMP ?? 'None' }}</p> --}}
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">EDC</p>
                            </div>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="EDC" id="EDC"
                                    placeholder="EDC" value="{{ $patient->pregWomen->EDC ?? ' ' }}">
                                @error('EDC')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">{{ $patient->pregWomen->EDC ?? 'None' }}</p> --}}
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">TT status</p>
                            </div>
                            <div class="col-sm-8">
                                <select class="form-control" name="TT_status" id="TT_status"
                                    value={{ $patient->pregWomen->TT_status ?? 'None' }}>

                                    <option value="T1"
                                        {{ $patient->pregWomen->TT_status ?? 'None' === 'T1' ? 'selected' : '' }}>
                                        T1</option>
                                    <option value="T2"
                                        {{ $patient->pregWomen->TT_status ?? 'None' === 'T2' ? 'selected' : '' }}>
                                        T2</option>
                                    <option value="T3"
                                        {{ $patient->pregWomen->TT_status ?? 'None' === 'T3' ? 'selected' : '' }}>
                                        T3</option>
                                    <option value="T4"
                                        {{ $patient->pregWomen->TT_status ?? 'None' === 'T4' ? 'selected' : '' }}>
                                        T4</option>
                                    <option value="T5"
                                        {{ $patient->pregWomen->TT_status ?? 'None' === 'T5' ? 'selected' : '' }}>
                                        T5</option>

                                </select>
                                @error('TT_status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">{{ $patient->pregWomen->TT_status ?? 'None' }}</p> --}}
                            </div>
                        </div>
                        <hr class="my-2">
                        <div class="row">
                            <div class="col-sm-4">
                                <p class="mb-0">Name of Husband</p>
                            </div>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="name_of_husband" id="name_of_husband"
                                    placeholder="Name of Husband"
                                    value="{{ $patient->pregWomen->name_of_husband ?? ' ' }}">
                                @error('name_of_husband')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                {{-- <p class="text-muted mb-0">{{ $patient->pregWomen->name_of_husband ?? 'None' }}</p> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <h5 class="fw-bold bg-warning p-3 text-center">Past Consultation History</strong></h5>
        </div>
    </form>

    <div class="row">
        @foreach ($patient->consultation as $consultation)
            <div class="col-md-12">
                <div class="card shadow mb-5 border border-primary">
                    <div class="card-header">
                        <h5 class="fw-bold bg-success p-3">This is past consultation from
                            <strong>{{ $consultation->date }}</strong>
                        </h5>

                    </div>

                    <div class="card-body pb-0">
                        <p class="bg-primary px-5 py-2 text-center " style="color: rgba(255, 255, 255, 0.945)">
                            Consultation Information</p>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="last_name">Date: </label>
                                    <input type="date" class="form-control" disabled
                                        value="{{ $consultation->date }}">
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
                                    <input type="number" class="form-control" disabled
                                        value="{{ $consultation->height }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="middle_name">Weight: </label>
                                    <input type="number" class="form-control" disabled
                                        value="{{ $consultation->weight }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="last_name">BP: </label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ $consultation->BP }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="first_name">PR: </label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ $consultation->PR }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="middle_name">RR: </label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ $consultation->RR }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="middle_name">CC: </label>
                                    <input type="text" class="form-control" disabled
                                        value="{{ $consultation->CC }}">
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

                    <div class="card-body">
                        @if ($consultation->treatment_id != null)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card shadow">
                                        <div class="card-header">
                                            <p class="bg-success px-5 py-2 text-center mb-0"
                                                style="color: rgba(255, 255, 255, 0.945)">
                                                Treatment Given</p>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlTextarea1">Comments/Findings</label>
                                                        <textarea class="form-control" disabled>{{ $consultation->treatment->findings }}</textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            @foreach ($consultation->treatment->medicine as $medicine)
                                                @if ($loop->first)
                                                    <p class="bg-success text-center py-2" style="width: 30%;">
                                                        Medicine
                                                        Given
                                                    </p>
                                                @endif
                                                <div class="row">
                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="quantity">Brand Name: </label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $medicine->brand_name }}/{{ $medicine->dosage->dosage }}">

                                                        </div>
                                                    </div>

                                                    <div class="col-3">
                                                        <div class="form-group">
                                                            <label for="quantity">Quantity: </label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $medicine->pivot->quantity }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="description">Description: </label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $medicine->pivot->description }}">
                                                        </div>
                                                    </div>

                                                </div>
                                            @endforeach

                                            @foreach ($consultation->treatment->laboratories as $laboratory)
                                                @if ($loop->first)
                                                    <p class="bg-success text-center py-2" style="width: 30%;">
                                                        Requested Laboratories
                                                    </p>
                                                @endif
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="quantity">Laboratory: </label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $laboratory->lab_name }}" disabled>

                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="quantity">Description: </label>
                                                            <input type="text" class="form-control"
                                                                value="{{ $laboratory->lab_des }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col">
                                    <div class="card shadow">
                                        <div class="card-body text-center bg-warning">
                                            <h4>This consultation has no treatment yet!</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var sexElement = $('#sex');
            var pregWomenElement = $('#preg_women');

            if (sexElement.val() === 'male') {
                pregWomenElement.hide();
            } else {
                pregWomenElement.show();
            }

            sexElement.change(function() {
                if ($(this).val() === 'male') {
                    pregWomenElement.hide();
                } else {
                    pregWomenElement.show();
                }
            });
        });
    </script>
@endsection
