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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="last_name">Last Name: </label>
                                    <input type="text" class="form-control" name="last_name" id="last_name"
                                        placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="first_name">First Name: </label>
                                    <input type="text" class="form-control" name="first_name" id="first_name"
                                        placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="middle_name">Middle Name: </label>
                                    <input type="text" class="form-control" name="middle_name" id="middle_name"
                                        placeholder="Middle Name">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="birth_date">Birth Date: </label>
                                    <input type="date" class="form-control" name="birth_date" id="birth_date"
                                        placeholder="Birthdate">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="sex">Sex: </label>
                                    <select class="form-control" name="sex" id="sex" required>
                                        <option selected disabled>Sex</option>
                                        <option value="male"> Male </option>
                                        <option value="female"> Female </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="civil_status">Civil Status: </label>
                                    <select class="form-control" name="civil_status" id="civil_status" required>
                                        <option selected disabled>Civil Status</option>
                                        <option value="single"> Single</option>
                                        <option value="married"> Married </option>
                                        <option value="divorced"> Divorced </option>
                                        <option value="separated"> Separated </option>
                                        <option value="widowed"> Widowed </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="contact_num">Contact Number: </label>
                                    <input type="text" name="contact_num" id="contact_num" class="form-control"
                                        placeholder="Contact Number">
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
                                            value="other_info_infants_child">
                                        <label for="Other Information (Infants / Child)">
                                            Infants/Child</label>
                                    </div>
                                    <div>
                                        <input type="checkbox" name="preg_women" id="preg_women" value="preg_women">
                                        <label for="Pregnant Women">Pregnant Women </label>
                                    </div>

                                    <div>
                                        <input type="checkbox" name="phil_health_info" id="phil_health_info"
                                            value="phil_health_info">
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
                                            placeholder="Father's Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mother_name">Mother's Name: </label>
                                        <input type="text" name="mother_name" class="form-control" id="mother_name"
                                            placeholder="Mother's Name">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="place_delivery">Place of Delivey: </label>
                                        <input type="text" name="place_delivery" class="form-control"
                                            id="place_delivery" placeholder="Place of Delivey">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="type_of_delivery">Type of Delivery: </label>
                                        <input type="text" name="type_of_delivery" class="form-control"
                                            id="type_of_delivery" placeholder="Type of Delivery">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="attended_by">Attended By: </label>
                                        <input type="text" name="attended_by" class="form-control" id="attended_by"
                                            placeholder="Attended by">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="birth_weight">Birth Weight: </label>
                                        <input type="number" name="birth_weight" class="form-control" id="birth_weight"
                                            placeholder="Birth Weight">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="birth_height">Birth Height: </label>
                                        <input type="number" name="birth_height" class="form-control" id="birth_height"
                                            placeholder="Birth Height">
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-6">
                                    <div class="form-group">
                                        <label for="date_of_NBS">Date of NBS: </label>
                                        <input type="date" name="date_of_NBS" class="form-control" id="date_of_NBS"
                                            placeholder="Mother TT status">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="mother_TT_status">Mother TT Status: </label>
                                        <input type="text" name="mother_TT_status" class="form-control"
                                            id="mother_TT_status" placeholder="Mother TT status">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="form-group">
                                        <label for="immun_at_other_facility">Immune at other Facilities: </label>
                                        <input type="text" name="immun_at_other_facility" class="form-control"
                                            id="immun_at_other_facility" placeholder="Immune at other Facilities">
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
                                        <input type="text" class="form-control" name="gradiva" id="gradiva"
                                            placeholder="Gradiva">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="para">Para: </label>
                                        <input type="text" class="form-control" name="para" id="para"
                                            placeholder="Para">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="LMP">LMP: </label>
                                        <input type="text" class="form-control" name="LMP" id="LMP"
                                            placeholder="LMP">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="EDC">EDC: </label>
                                        <input type="text" class="form-control" name="EDC" id="EDC"
                                            placeholder="EDC">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="TT_status">TT Status: </label>
                                        <input type="text" class="form-control" name="TT_status" id="TT_status"
                                            placeholder="TT Status">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name_of_husband">Name of Husband: </label>
                                        <input type="text" class="form-control" name="name_of_husband"
                                            id="name_of_husband" placeholder="Name of Husband">
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
                                            placeholder="Category">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="pin">PIN: </label>
                                        <input type="text" class="form-control" name="pin" id="pin"
                                            placeholder="PIN">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="classification">Classification: </label>
                                        <input type="text" class="form-control" name="classification"
                                            id="classification" placeholder="Classification">
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
            $("#other_info_container").hide();
            $("#preg_women_container").hide();
            $("#phil_health_info_container").hide();
        });
    </script>
@endsection
