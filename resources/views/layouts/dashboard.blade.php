<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta name="theme-color" content="#5e72e4" />

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Dashboard PRO</title>
        <link rel="icon" href="{{ asset('public/assets/img/brand/favicon.png') }}" type="image/png" />
        <!--  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">-->
        <link rel="stylesheet" href="{{ asset('public/assets/css/fonts.css') }}" type="text/css" />
        <!-- Icons -->
        <link rel="stylesheet" href="{{ asset('public/assets/vendor/nucleo/css/nucleo.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('public/assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css" />
        <!-- Page plugins -->
        <!-- Argon CSS -->
        <link rel="stylesheet" href="{{ asset('public/assets/css/argon.min5438.css?v=1.2.0') }}" type="text/css" />
        <link rel="stylesheet" href="{{
                asset(
                    'public/assets/vendor/sweetalert2/dist/sweetalert2.min.css'
                )
              }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('public/assets/css/animate.min.css') }}" type="text/css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">


        @yield('css')
        <style>
            .error {
                border: 1px solid #fb6340;
            }

            .avatar-sm {
                width: 20px;
                height: 20px;
            }

            .table-dark,
            td.back {
                font-weight: bold;
            }

            .table-dark,
            td.lay {
                font-weight: bold;
            }

            .back {
                background-color: #a6d8ff !important;

                font-size: 14px !important;
                color: #172b4d !important
            }

            .lay {
                background-color: #fac9d1 !important;
                font-size: 14px !important;
                color: #172b4d !important
            }

            .is-invalid {
                border: 1px solid #fb6340 !important;
            }

            .eventtype {
                font-size: 12px !important;
                font-weight: bolder;
                padding: 5px !important;
                text-align: left;
            }

            .eventtype span {
                font-size: 12px !important;
                font-weight: bold;
            }

            .back_lay_price {
                cursor: pointer;
            }

            span.size {
                font-size: 12px;
                font-weight: normal;
            }

            .eventtype {
                font-size: 12px !important;
                font-weight: bolder;
                padding: 5px !important;
                text-align: left;
            }

            .eventtype span {
                font-size: 12px !important;
                font-weight: bold;
            }

            .back_lay_price {
                cursor: pointer;
            }

            table.table-flush,
            td {
                padding: 2px 5px 2px 5px !important;
                vertical-align: middle !important;
            }

            table.table-flush,
            th {
                padding: 6px 5px 6px 5px !important;
                vertical-align: middle !important;
            }
        </style>

        <script type="text/javascript">
            var hostname = "{{url('/')}}" + '/';

        </script>

    </head>

    <body>
        <!-- Sidenav -->
        <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
            <div class="scrollbar-inner">
                <!-- Brand -->
                <div class="sidenav-header d-flex align-items-center">
                    <a class="navbar-brand" href="#">
                        <img src="{{
                                asset('public/assets/img/brand/logo.jpg')
                             }}" class="navbar-brand-img" alt="..." />
                    </a>
                    <div class="ml-auto">
                        <!-- Sidenav toggler -->
                        <div class="sidenav-toggler d-none d-xl-block" data-action="sidenav-unpin" data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="navbar-inner">
                    <!-- Collapse -->
                    <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                        <!-- Nav items -->
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" href="{{ url('/dashboard/') }}" role="button" aria-expanded="true" aria-controls="navbar-dashboards">
                                    <i class="ni ni-shop text-primary"></i>
                                    <span class="nav-link-text">Home</span>
                                </a>
                            </li>

                            <li class="nav-item" id="online_user">
                                <a class="nav-link" href="{{ url('/users/profile') }}">
                                    <i class="ni ni-circle-08 text-green"></i>
                                    <span class="nav-link-text">Edit Profile</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Main content -->
        <div class="main-content" id="panel">
            <!-- Topnav -->
            <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
                <div class="container-fluid">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Search form -->
                        <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
                            <div class="form-group mb-0">
                                <div class="input-group input-group-alternative input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                                    </div>
                                    <input class="form-control topSearch" id="topSearch" placeholder="Search" type="text" />
                                    <ul id="ui-id-1ist" tabindex="0" class="ui-menu ui-widget ui-widget-content ui-autocomplete ui-front" style="display: none; top: 46px; width: 423px;border-radius: 6px;">
                                    </ul>
                                </div>
                            </div>
                            <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </form>

                        <!-- Navbar links -->
                        <ul class="navbar-nav align-items-center ml-md-auto">
                            <li class="nav-item d-xl-none">
                                <!-- Sidenav toggler -->
                                <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                                    <div class="sidenav-toggler-inner">
                                        <i class="sidenav-toggler-line"></i>
                                        <i class="sidenav-toggler-line"></i>
                                        <i class="sidenav-toggler-line"></i>
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item d-sm-none">
                                <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main">
                                    <i class="ni ni-zoom-split-in"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="navbar-nav align-items-center ml-md-auto">
                            <li class="nav-item">
                                <a class="nav-link"><i class="ni ni-money-coins"></i> Total Deposite:
                                    <span id="exposer">0</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"><i class="ni ni-money-coins"></i> Total Investment:
                                    <span id="balance"> </span></a>
                            </li>
                        </ul>
                        <ul class="navbar-nav align-items-center ml-auto ml-md-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="media align-items-center">
                                        <span class="avatar avatar-sm rounded-circle">
                                            <img alt="Image placeholder" src="{{
                                                    asset(
                                                        'public/assets/img/theme/team-4.jpg'
                                                    )
                                                 }}" />
                                        </span>
                                        <div class="media-body ml-2 d-none d-lg-block">
                                            <span class="mb-0 text-sm font-weight-bold" id="usr_name"></span>
                                        </div>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="#" class="dropdown-item" onclick="javascript:logout();">
                                        <i class="ni ni-user-run"></i>
                                        <span>Logout</span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- Header -->
            <!-- Header -->
            <!-- Page content -->
            @yield('content')

        </div>

        <!-- Scripts -->
        <!-- Core -->
        <script src="{{asset('public/assets/vendor/jquery/dist/jquery.min.js')}}"></script>
        <script src="{{asset('public/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{asset('public/assets/vendor/js-cookie/js.cookie.js')}}"></script>
        <script src="{{asset('public/assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
        <script src="{{asset('public/assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>
        <!-- Argon JS -->
        <script src="{{asset('public/assets/js/argon.min5438.js?v=1.2.0')}}"></script>
        <!-- Demo JS - remove this in your project -->
        <script src="{{ asset('public/assets/js/demo.min.js') }}"></script>
        <script src="{{asset('public/assets/js/bootstrap-notify.min.js')}}"></script>
        <script src="{{asset('public/assets/vendor/sweetalert2/dist/sweetalert2.min.js')}}"></script>
        <script src="{{asset('public/assets/js/dashboard_custom.js')}}"></script>
        <!-- Initialize data --->



        @yield('script')
    </body>

<!--  <script src="{{ asset('public/assets/vendor/jquery/dist/jquery.min.js') }}"></script>  -->
<!--  <script src="{{ asset('public/assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>-->
    <?php
    $uri = Route::currentRouteName();
    ?>

</html>