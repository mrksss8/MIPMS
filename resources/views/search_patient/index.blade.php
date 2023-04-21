<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Patient Management System">
    <meta name="author" content="Mark Anthony Bautista">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Bay Municipal Clinic</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


    <!-- Custom Styles -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap');

        *,
        h1 {
            font-family: 'Poppins', sans-serif;
        }
    </style>

    <!-- data tables-->
    <link href="{{ asset('datatables/dataTables.css') }}" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/logo.png') }}" rel="icon" type="image/png">
</head>

<body
    style="background:linear-gradient(rgba(5, 5, 5, 0.8), rgba(12, 9, 9, 0.6)), url('{{ asset('img/bg-search.jpg') }}'); background-size: cover; background-position: center; background-attachment: fixed;">

    <div class="container vh-100 d-flex justify-content-center align-items-center">
        <form action="{{ route('search_patient.search') }}" method="POST">
            @csrf
            <div class="card" style="width: 40rem;">
                <div class="card shadow">
                    <div class="card-header">
                        <h5 class="text-primary fw-bold">Search Patient</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="category">Enter family ID to search: </label>
                            <input type="text" class="form-control" name="family_id" placeholder="Enter Family ID"
                                required>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-md btn-primary px-5"> Search </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
</body>

</html>
