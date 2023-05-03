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

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif


    <div class="row">
        <div class="col-lg-12 ">
            <div class="card shadow">
                <div class="card-header">
                    <h5 class="text-primary fw-bold">Add Patient</h5>

                </div>
                <form action="{{ route('patient.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <p class="bg-primary px-5 py-2 text-center " style="color: rgba(255, 255, 255, 0.945)">
                            Patient
                            Information</p>

                        <div class="row">
                            <div class="col-md-6 ">
                                <div class="d-flex flex-column align-items-center ">
                                    <div id="my_camera"></div>
                                    <div>
                                        <input type=button class="btn btn-sm btn-primary" value="Capture"
                                            onClick="take_snapshot()">
                                    </div>
                                </div>
                                <input type="hidden" name="image" class="image-tag">
                            </div>

                            <div class="col-md-6">
                                <div id="results">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name">Last Name: </label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                        placeholder="Last Name" value="{{ old('last_name') }}">
                                    @error('last_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name">First Name: </label>
                                    <input type="text" class="form-control" name="first_name" id="first_name"
                                        placeholder="First Name" value="{{ old('first_name') }}">
                                    @error('first_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="middle_name">Middle Name: </label>
                                    <input type="text" class="form-control" name="middle_name" id="middle_name"
                                        placeholder="Middle Name" value="{{ old('middle_name') }}">
                                    @error('middle_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="birth_date">Birth Date: </label>
                                    <input type="date" class="form-control" name="birth_date" id="birth_date"
                                        placeholder="Birthdate" value="{{ old('birth_date') }}">
                                    @error('birth_date')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sex">Sex: </label>
                                    <select class="form-control" name="sex" id="sex" value={{ old('sex') }}>
                                        <option selected disabled>Sex</option>
                                        <option value="male" {{ old('sex') == 'male' ? 'selected' : '' }}>
                                            Male </option>
                                        <option value="female" {{ old('sex') == 'female' ? 'selected' : '' }}>
                                            Female </option>
                                    </select>
                                    @error('sex')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="civil_status">Civil Status: </label>
                                    <select class="form-control" name="civil_status" id="civil_status"
                                        value={{ old('civil_status') }}>



                                        <option selected disabled>Civil Status</option>
                                        <option value="single" {{ old('civil_status') == 'single' ? 'selected' : '' }}>
                                            Single</option>
                                        <option value="married" {{ old('civil_status') == 'married' ? 'selected' : '' }}>
                                            Married </option>
                                        <option value="divorced" {{ old('civil_status') == 'divorced' ? 'selected' : '' }}>
                                            Divorced </option>
                                        <option value="separated"
                                            {{ old('civil_status') == 'separated' ? 'selected' : '' }}>
                                            Separated </option>
                                        <option value="widowed" {{ old('civil_status') == 'widowed' ? 'selected' : '' }}>
                                            Widowed </option>
                                    </select>
                                    @error('civil_status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="contact_num">Contact Number: </label>
                                    <input type="text" name="contact_num" id="contact_num" class="form-control"
                                        placeholder="Contact Number"
                                        value="{{ old('contact_num') ? old('contact_num') : '09' }}">
                                    @error('contact_num')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <p class="bg-primary px-5 py-2 text-center " style="color: rgba(255, 255, 255, 0.945)">
                            Address</p>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="house_num">House Number: </label>
                                    <input type="text" class="form-control" name="house_num" id="house_num"
                                        placeholder="House Number" value="{{ old('house_num') }}">
                                    @error('house_num')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="street">Street: </label>
                                    <input type="text" class="form-control" name="street" id="street"
                                        placeholder="Street" value="{{ old('street') }}">
                                    @error('street')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="purok">Purok: </label>
                                    <input type="text" class="form-control" name="purok" id="purok"
                                        placeholder="Purok" value="{{ old('purok') }}">
                                    @error('purok')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="brgy">Barangay: </label>
                                    <select class="form-control" name="brgy" id="brgy">
                                        <option selected disabled>Barangay</option>
                                        @foreach ($brgys as $brgy)
                                            <option value="{{ $brgy->barangay }}"
                                                {{ $brgy->barangay == old('brgy') ? 'selected' : '' }}>
                                                {{ $brgy->barangay }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('brgy')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="muniCity">Municipality/City: </label>
                                    <input type="text" class="form-control" name="muniCity" id="muniCity"
                                        placeholder="Municipality/City" value="Bay" readonly>
                                    {{-- @error('muniCity')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror --}}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="province">Province: </label>
                                    <input type="text" class="form-control" name="province" id="province"
                                        placeholder="province" value="Laguna" readonly>
                                    {{-- @error('province')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror --}}
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12 mt-5 mb-4">
                                <h5 class="text-center text-primary">Check Other Applicable Infomation</h5>
                                <div class="d-flex
                                        justify-content-around">
                                    <div>
                                        <input type="checkbox" name="infants_child_info" id="other_info_IC"
                                            value="other_info_infants_child" @checked(old('infants_child_info')) />

                                        <label for="Other Information (Infants / Child)">
                                            Infants/Child</label>
                                    </div>
                                    <div id="preg_women_div">
                                        <input type="checkbox" name="preg_women" value="preg_women" id="preg_women"
                                            @checked(old('preg_women'))>
                                        <label for="Pregnant Women">Pregnant Women </label>
                                    </div>

                                    <div>
                                        <input type="checkbox" name="phil_health_info" id="phil_health_info"
                                            value="phil_health_info" @checked(old('phil_health_info'))>
                                        <label for="PhilHealth Info">PhilHealth</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="other_info_container">
                            <p class="bg-primary px-5 py-2 text-center mt-5" style="color: rgba(255, 255, 255, 0.945)">
                                Other Informations (Infants / Child)</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="father_name">Father's Name: </label>
                                        <input type="text" name="father_name" class="form-control" id="father_name"
                                            placeholder="Father's Name" value="{{ old('father_name') }}">
                                        @error('father_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mother_name">Mother's Name: </label>
                                        <input type="text" name="mother_name" class="form-control" id="mother_name"
                                            placeholder="Mother's Name" value="{{ old('mother_name') }}">
                                        @error('mother_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="place_delivery">Place of Delivey: </label>
                                        <input type="text" name="place_delivery" class="form-control"
                                            id="place_delivery" placeholder="Place of Delivey"
                                            value="{{ old('place_delivery') }}">
                                        @error('place_delivery')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="type_of_delivery">Type of Delivery: </label>
                                        <input type="text" name="type_of_delivery" class="form-control"
                                            id="type_of_delivery" placeholder="Type of Delivery"
                                            value="{{ old('type_of_delivery') }}">
                                        @error('type_of_delivery')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="attended_by">Attended By: </label>
                                        <select class="form-control" name="attended_by" id="attended_by"
                                            value="{{ old('attended_by') }}">

                                            <option selected disabled>Attended By</option>
                                            <option value="Nurse" {{ old('attended_by') == 'Nurse' ? 'selected' : '' }}>
                                                Nurse</option>
                                            <option value="Doctor" {{ old('attended_by') == 'Doctor' ? 'selected' : '' }}>
                                                Doctor</option>
                                            <option value="Midwife"
                                                {{ old('attended_by') == 'Midwife' ? 'selected' : '' }}>
                                                Midwife</option>

                                        </select>
                                        @error('attended_by')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="birth_weight">Birth Weight (KG): </label>
                                        <input type="number" name="birth_weight" class="form-control" id="birth_weight"
                                            placeholder="Birth Weight" value="{{ old('birth_weight') }}">
                                        @error('birth_weight')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="birth_height">Birth Height (CM): </label>
                                        <input type="number" name="birth_height" class="form-control" id="birth_height"
                                            placeholder="Birth Height" value="{{ old('birth_height') }}">
                                        @error('birth_height')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="date_of_NBS">Date of NBS: </label>
                                        <input type="date" name="date_of_NBS" class="form-control" id="date_of_NBS"
                                            placeholder="Mother TT status" value="{{ old('date_of_NBS') }}">
                                        @error('date_of_NBS')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="mother_TT_status">Mother TT Status: </label>
                                        <select class="form-control" name="mother_TT_status" id="mother_TT_status"
                                            value={{ old('mother_TT_status') }}>

                                            <option value="T1" {{ old('attended_by') == 'T1' ? 'selected' : '' }}>
                                                T1</option>
                                            <option value="T2" {{ old('attended_by') == 'T2' ? 'selected' : '' }}>
                                                T2</option>
                                            <option value="T3" {{ old('attended_by') == 'T3' ? 'selected' : '' }}>
                                                T3</option>
                                            <option value="T4" {{ old('attended_by') == 'T4' ? 'selected' : '' }}>
                                                T4</option>
                                            <option value="T5" {{ old('attended_by') == 'T5' ? 'selected' : '' }}>
                                                T5</option>

                                        </select>
                                        @error('mother_TT_status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="immun_at_other_facility">Immune at other Facilities: </label>
                                        <input type="text" name="immun_at_other_facility" class="form-control"
                                            id="immun_at_other_facility" placeholder="Immune at other Facilities"
                                            value="{{ old('immun_at_other_facility') }}">
                                        @error('immun_at_other_facility')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="preg_women_container">
                            <p class="bg-primary px-5 py-2 text-center mt-5" style="color: rgba(255, 255, 255, 0.945)">
                                Pregnant Women</p>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="gradiva">Gradiva: </label>
                                        <input type="number" class="form-control" name="gradiva" id="gradiva"
                                            placeholder="Gradiva" value="{{ old('gradiva') }}">
                                        @error('gradiva')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="para">Para: </label>
                                        <input type="number" class="form-control" name="para" id="para"
                                            placeholder="Para" value="{{ old('para') }}">
                                        @error('para')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="LMP">LMP: </label>
                                        <input type="date" class="form-control" name="LMP" id="LMP"
                                            placeholder="LMP" value="{{ old('LMP') }}">
                                        @error('LMP')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="EDC">EDC: </label>
                                        <input type="date" class="form-control" name="EDC" id="EDC"
                                            placeholder="EDC" value="{{ old('EDC') }}">
                                        @error('EDC')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="TT_status">TT Status: </label>
                                        <select class="form-control" name="TT_status" id="TT_status"
                                            value={{ old('TT_status') }}>

                                            <option value="T1" {{ old('TT_status') == 'T1' ? 'selected' : '' }}>
                                                T1</option>
                                            <option value="T2" {{ old('TT_status') == 'T2' ? 'selected' : '' }}>
                                                T2</option>
                                            <option value="T3" {{ old('TT_status') == 'T3' ? 'selected' : '' }}>
                                                T3</option>
                                            <option value="T4" {{ old('TT_status') == 'T4' ? 'selected' : '' }}>
                                                T4</option>
                                            <option value="T5" {{ old('TT_status') == 'T5' ? 'selected' : '' }}>
                                                T5</option>

                                        </select>
                                        @error('TT_status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name_of_husband">Name of Husband: </label>
                                        <input type="text" class="form-control" name="name_of_husband"
                                            id="name_of_husband" placeholder="Name of Husband"
                                            value="{{ old('name_of_husband') }}">
                                        @error('name_of_husband')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="phil_health_info_container">
                            <p class="bg-primary px-5 py-2 text-center mt-5" style="color: rgba(255, 255, 255, 0.945)">
                                PhilHealth Info</p>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="category">Category: </label>
                                        <input type="text" class="form-control" name="category" id="category"
                                            placeholder="Category" value="{{ old('category') }}">
                                        @error('category')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pin">PIN: </label>
                                        <input type="text" class="form-control" name="pin" id="pin"
                                            placeholder="PIN" value="{{ old('pin') }}">
                                        @error('pin')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="classification">Classification: </label>
                                        <select class="form-control" name="classification" id="classification"
                                            value={{ old('classification') }}>
                                            <option selected disabled>Classification</option>
                                            <option value="member"
                                                {{ old('classification') == 'member' ? 'selected' : '' }}>
                                                Member </option>
                                            <option value="dependent"
                                                {{ old('classification') == 'dependent' ? 'selected' : '' }}>
                                                dependent </option>
                                        </select>
                                        @error('classification')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-md btn-primary"> Submit </button>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#other_info_IC").click(function() {
                if ($(this).is(":checked")) {
                    $("#other_info_container").show();
                } else {
                    $("#other_info_container").hide();

                }
            });
            $("#preg_women").click(function() {
                if ($(this).is(":checked")) {
                    $("#preg_women_container").show();
                } else {
                    $("#preg_women_container").hide();

                }
            });
            $("#phil_health_info").click(function() {
                if ($(this).is(":checked")) {
                    $("#phil_health_info_container").show();
                } else {
                    $("#phil_health_info_container").hide();

                }
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            if ($("#other_info_IC").is(":checked")) {
                $("#other_info_container").show();
            } else {
                $("#other_info_container").hide();

            }


            if ($("#preg_women").is(":checked")) {
                $("#preg_women_container").show();
            } else {
                $("#preg_women_container").hide();

            }


            if ($("#phil_health_info").is(":checked")) {
                $("#phil_health_info_container").show();
            } else {
                $("#phil_health_info_container").hide();

            }

            // $("#other_info_container").hide();
            // $("#preg_women_container").hide();
            // $("#phil_health_info_container").hide();
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('#sex').change(function() {
                if ($(this).val() == 'male') {
                    $('#preg_women').hide();
                } else {
                    $('#preg_women').show();
                }
            });
        });
    </script> --}}
    {{-- <script>
        $(document).ready(function() {
            var sexElement = $('#sex');
            var pregWomenElement = $('#preg_women');

            sexElement.change(function() {
                if (sexElement.val() == 'male') {
                    pregWomenElement.hide();
                } else {
                    pregWomenElement.show();
                }
            });
        });
    </script> --}}

    <script>
        $(document).ready(function() {
            var sexElement = $('#sex');
            var pregWomenElement = $('#preg_women_div');

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

    <!-- webcam setup -->

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#category-img-tag').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#cat_image").change(function() {
            readURL(this);
        });
    </script>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
    <!-- Configure a few settings and attach camera -->
    <script language="JavaScript">
        Webcam.set({
            width: 490,
            height: 390,
            image_format: 'jpeg',
            jpeg_quality: 90
        });
        Webcam.attach('#my_camera');

        function take_snapshot() {
            Webcam.snap(function(data_uri) {
                $(".image-tag").val(data_uri);
                document.getElementById('results').innerHTML =
                    '<img style = "width:480px; height:auto; padding:20px;" src="' + data_uri + '"/>';
            });
        }
    </script>
@endsection
