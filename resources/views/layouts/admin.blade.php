<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="MIPMS - BAY MUNICIPAL CLINIC">
    <meta name="author" content="MAB">


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

        .active {
            background-color: rgba(255, 255, 255, 0.233);
        }
    </style>

    <!-- data tables-->
    <link href="{{ asset('datatables/dataTables.css') }}" rel="stylesheet">


    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    <link href="{{ asset('img/logo.png') }}" rel="icon" type="image/png">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <li class="pt-3 pb-2">
                <a class="sidebar-brand p-0">
                    <div class="sidebar-brand-icon">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('img/logo.png') }}" alt="" width="80px">
                        </div>
                        <div class="sidebar-brand-text mx-3 d-flex justify-content-center"> MIPMS - Bay Municipal Clinic
                        </div>
                </a>

            </li>
            <!-- Sidebar - Brand -->

            <!-- Divider -->
            {{-- <hr class="sidebar-divider my-0"> --}}

            @hasanyrole('Admin|Doctor|Nurse|Midwife')
                <!-- Nav Item - Dashboard -->
                <li class="nav-item {{ Nav::isRoute('dashboard.index') }}">
                    <a class="nav-link" href="{{ route('dashboard.index') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>{{ __('Dashboard') }}</span></a>
                </li>
            @endhasanyrole
            @hasanyrole('Admin|Doctor|Nurse|Midwife')
                <li class="nav-item {{ Nav::isRoute('analytics.index') }}">
                    <a class="nav-link" href="{{ route('analytics.index') }}">
                        <i class="fas fa-fw fa-tachometer-alt"></i>
                        <span>{{ __('Analytics') }}</span></a>
                </li>
            @endhasanyrole

            <!-- Divider -->
            {{-- <hr class="sidebar-divider"> --}}

            {{-- <!-- Heading -->
            <div class="sidebar-heading">
                {{ __('Pages') }}
            </div> --}}

            <!-- Nav Item - Patient -->
            {{-- <li class="nav-item">
                <a class="nav-link" href="{{ route('patient.index') }}">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Patients</span>
                </a>
            </li> --}}

            @unlessrole('Admin')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePatient"
                        aria-expanded="true" aria-controls="collapsePatient">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Patients</span>
                    </a>
                    <div id="collapsePatient"
                        class="collapse {{ Request::is('patients') ? 'show' : '' }} {{ Request::is('patient/create') ? 'show' : '' }}"
                        aria-labelledby="headingPatient" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                            @hasanyrole('Doctor|Nurse|Midwife')
                                <a class="collapse-item {{ Nav::isRoute('patient.index') }}"
                                    href="{{ route('patient.index') }}">Patients Record</a>
                            @endhasanyrole()
                            @hasanyrole('Nurse|Midwife')
                                <a class="collapse-item {{ Nav::isRoute('patient.create') }}"
                                    href="{{ route('patient.create') }}">Add Patient</a>
                            @endhasanyrole()
                        </div>
                    </div>
                </li>
            @endunlessrole

            @hasanyrole('Doctor')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConsultation"
                        aria-expanded="true" aria-controls="collapseConsultation">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Consultations</span>
                    </a>
                    <div id="collapseConsultation"
                        class="collapse {{ Request::is('consultation/create') ? 'show' : '' }} {{ Request::is('consultation') ? 'show' : '' }}"
                        aria-labelledby="headingConsultation" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                            <a class="collapse-item {{ Nav::isRoute('consultation.create') }}"
                                href="{{ route('consultation.create') }}">Add Consultation</a>

                        </div>
                    </div>
                </li>
            @endhasanyrole

            @hasanyrole('Doctor')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTreatment"
                        aria-expanded="true" aria-controls="collapseTreatment">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Treatment</span>
                    </a>
                    <div id="collapseTreatment" class="collapse {{ Request::is('treatment/create') ? 'show' : '' }}"
                        aria-labelledby="headingTreatment" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                            <a class="collapse-item {{ Nav::isRoute('treatment.create') }}"
                                href="{{ route('treatment.create') }}">For Treatment Patients</a>
                        </div>
                    </div>
                </li>
            @endhasanyrole

            @hasanyrole('Doctor|Nurse|Midwife')
                <!-- Nav Item - Patient -->
                <li class="nav-item  {{ Nav::isRoute('past_treatment_consultation.index') }}">
                    <a class="nav-link d-flex align-items-center" href="{{ route('past_treatment_consultation.index') }}">
                        <i class="fas fa-fw fa-user"></i>
                        <span class="ml-2">Past Consultation and Treated </span>
                    </a>
                </li>
            @endhasanyrole
            @hasanyrole('Nurse|Midwife')
                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInventory"
                        aria-expanded="true" aria-controls="collapseInventory">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Inventory</span>
                    </a>
                    <div id="collapseInventory"
                        class="collapse  {{ Request::is('medicine') ? 'show' : '' }} {{ Request::is('medicine/create') ? 'show' : '' }} {{ Request::is('medicine-category') ? 'show' : '' }} {{ Request::is('medicine-dosage') ? 'show' : '' }}"
                        aria-labelledby="headingConsultation" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                            <a class="collapse-item  {{ Nav::isRoute('medicine.index') }}"
                                href="{{ route('medicine.index') }}">Medicine List</a>
                            <a class="collapse-item  {{ Nav::isRoute('medicine.create') }}"
                                href="{{ route('medicine.create') }}">Add Medicine</a>
                            <a class="collapse-item  {{ Nav::isRoute('medicine_category.create') }}"
                                href="{{ route('medicine_category.create') }}">Add Medicine
                                Category</a>
                            <a class="collapse-item  {{ Nav::isRoute('medicine_dosage.create') }}"
                                href="{{ route('medicine_dosage.create') }}">Add Medicine
                                Dosage</a>

                        </div>
                    </div>
                </li>
            @endhasanyrole

            @hasanyrole('Admin')
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRegister"
                        aria-expanded="true" aria-controls="collapseRegister">
                        <i class="fas fa-fw fa-cog"></i>
                        <span>Register</span>
                    </a>
                    <div id="collapseRegister"
                        class="collapse  {{ Request::is('brgy') ? 'show' : '' }} {{ Request::is('register') ? 'show' : '' }}"
                        aria-labelledby="headingConsultation" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            {{-- <h6 class="collapse-header">Custom Components:</h6> --}}
                            <a class="collapse-item  {{ Nav::isRoute('register') }}"
                                href="{{ route('register') }}">Register User</a>
                            <a class="collapse-item {{ Nav::isRoute('brgy.index') }}"
                                href="{{ route('brgy.index') }}">Register Barangay</a>
                        </div>
                    </div>
                </li>
            @endhasanyrole

            {{-- @auth
                <a href="{{ url('/home') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                <a href="{{ route('register') }}">Register</a>
            @endauth --}}

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            {{-- @can('Nurse Permission')
                <li class="nav-item">

                    <a class="nav-link" href="{{ route('register') }}">
                        <i class="fas fa-fw fa-hands-helping"></i>
                        <span>Nurse Permission</span>
                    </a>

                </li>
            @endcan

            @can('Doctor Permission')
                <li class="nav-item">

                    <a class="nav-link" href="">
                        <i class="fas fa-fw fa-hands-helping"></i>
                        <span>Doctor Permission</span>
                    </a>

                </li>
            @endcan

            @can('Midwife Permission')
                <li class="nav-item">

                    <a class="nav-link" href="">
                        <i class="fas fa-fw fa-hands-helping"></i>
                        <span>Midwife Permission</span>
                    </a>

                </li>
            @endcan --}}

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100">
                        <h5>Medicine Inventory and Patient Information with Descriptive Analytics</h5>
                    </div>

                    <!-- Topbar Search -->
                    <form
                        class="d-none
                        d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">

                            {{-- <input type="text" class="form-control bg-light border-0 small"
                                placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div> --}}
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        {{-- <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li> --}}

                        <!-- Nav Item - Alerts -->
                        {{-- <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to
                                            download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All
                                    Alerts</a>
                            </div>
                        </li> --}}

                        <!-- Nav Item - Messages -->


                        {{-- <div class="topbar-divider d-none d-sm-block"></div> --}}

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span
                                    class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                                <figure class="img-profile rounded-circle avatar font-weight-bold"
                                    data-initial="{{ Auth::user()->name[0] }}"></figure>
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="{{ route('profile') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Profile') }}
                                </a>

                                <!-- Nav Item - About -->
                                {{-- <a class="dropdown-item" href="{{ route('about') }}">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('About') }}

                                </a> --}}
                                {{-- <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Settings') }}
                                </a>
                                <a class="dropdown-item" href="javascript:void(0)">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Activity Log') }}
                                </a> --}}
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Logout') }}
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    @yield('main-content')

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Laguna University BSIT 4 - B7 (2023)</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to Leave?') }}</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-link" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>
                    <a class="btn btn-danger" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/sb-admin-2.min.js') }}"></script>

    @yield('scripts')

</body>

</html>
