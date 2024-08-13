@php use App\Models\User; @endphp
    <!doctype html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>SME Management System - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
          content="Manage and optimize your SME operations with our comprehensive dashboard for tracking business activities, managing users, and analyzing performance.">
    <meta name="keywords"
          content="SME Management, Business Dashboard, User Management, Business Analytics, SME Optimization">
    <meta name="author" content="SME Management Team">
    <meta name="email" content="support@smemanagement.com">
    <meta name="website" content="https://www.smemanagement.com">
    <meta name="Version" content="v1.0">

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}"/>

    <!-- Css Libraries -->
    <link href="{{ asset('assets/libs/simplebar/simplebar.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/tiny-slider/tiny-slider.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/libs/tobii/css/tobii.min.css') }}" rel="stylesheet">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" class="theme-opt" rel="stylesheet" type="text/css"/>

    <!-- Icons Css -->
    <link href="{{ asset('assets/libs/@mdi/font/css/materialdesignicons.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/libs/@iconscout/unicons/css/line.css') }}" type="text/css" rel="stylesheet"/>

    <!-- Style Css -->
    <link href="{{ asset('assets/css/style.min.css') }}" class="theme-opt" rel="stylesheet" type="text/css"/>
</head>

<body>

<div class="page-wrapper toggled">
    <!-- sidebar-wrapper -->
    <nav id="sidebar" class="sidebar-wrapper sidebar-dark">
        <div class="sidebar-content" data-simplebar style="height: calc(100% - 60px);">
            <div class="sidebar-brand">
                <a href="{{ route('dashboard') }}">
                    <!-- SVG for light mode -->
                    <svg class="logo-light-mode" height="24" viewBox="0 0 200 50" xmlns="http://www.w3.org/2000/svg">
                        <text x="10" y="35" font-family="Arial, sans-serif" font-size="20" fill="black">EasySME
                        </text>
                    </svg>

                    <!-- SVG for dark mode -->
                    <svg class="logo-dark-mode" height="24" viewBox="0 0 200 50" xmlns="http://www.w3.org/2000/svg">
                        <text x="10" y="35" font-family="Arial, sans-serif" font-size="20" fill="white">EasySME
                        </text>
                    </svg>

                    <span class="sidebar-colored">
                        <!-- Another SVG for colored mode -->
                        <svg height="60" viewBox="0 0 200 50" xmlns="http://www.w3.org/2000/svg"
                             style="width: 100%; height: 60px;">
                            <text x="10" y="35" font-family="Arial, sans-serif" font-size="20"
                                  fill="white">EasySME</text>
                        </svg>
                    </span>
                </a>
            </div>

            <ul class="sidebar-menu">
                <li class="sidebar">
                    <a href="{{ route('dashboard') }}"><i class="ti ti-home me-2"></i>Dashboard</a>
                </li>
                <li class="sidebar">
                    <a href="#"><i class="ti ti-users me-2"></i>Manage Users</a>
                </li>
                <li class="sidebar">
                    <a href="#"><i class="ti ti-building me-2"></i>Manage Businesses</a>
                </li>
                <li class="sidebar">
                    <a href="#"><i class="ti ti-bar-chart me-2"></i>Reports</a>
                </li>
                <li class="sidebar">
                    <a href="#"><i class="ti ti-settings me-2"></i>Settings</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- sidebar-wrapper -->

    <!-- Start Page Content -->
    <main class="page-content bg-light">
        {{ $slot }}
        <!-- Footer Start -->
        <footer class="shadow py-3">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="text-sm-start text-center mx-md-2">
                            <p class="mb-0 text-muted">©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>
                                SME Management Team.
                            </p>
                        </div>
                    </div><!--end col-->
                </div><!--end row-->
            </div><!--end container-->
        </footer><!--end footer-->

        <!-- End -->
    </main>
    <!--End page-content -->
</div>
<!-- page-wrapper -->

<!-- JavaScript -->
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('assets/libs/tiny-slider/min/tiny-slider.js') }}"></script>
<script src="{{ asset('assets/libs/tobii/js/tobii.min.js') }}"></script>

<!-- Main Js -->
<script src="{{ asset('assets/js/plugins.init.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>

</body>
</html>
