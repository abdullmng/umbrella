
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') - {{config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="{{ config('app.name') }} Innovations" name="description" />
    <meta content="Unnice" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="/other/assets/images/favicon.ico">

    <!-- App css -->
    <link href="/other/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/other/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/other/assets/css/theme.min.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/datatables/dataTables.bootstrap4.css" rel="stylesheet" type="text/css" />
    <!-- Plugins css -->
    <link href="/plugins/quill/quill.core.css" rel="stylesheet" type="text/css" />
    <link href="/plugins/quill/quill.snow.css" rel="stylesheet" type="text/css" />

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

        <header id="page-topbar">
            <div class="navbar-header">

                <div class="d-flex align-items-left">
                    <button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect"
                        id="vertical-menu-btn">
                        <i class="fa fa-fw fa-bars"></i>
                    </button>

                    <div class="dropdown d-none d-sm-inline-block">

                        <div class="dropdown-menu">


                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center">

                    <div class="dropdown d-none d-sm-inline-block ml-2">

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                            aria-labelledby="page-header-search-dropdown">

                        </div>
                    </div>

                    <div class="dropdown d-inline-block">

                        <div class="dropdown-menu dropdown-menu-right">


                        </div>
                    </div>

                    <div class="dropdown d-inline-block">

                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                            aria-labelledby="page-header-notifications-dropdown">

                        </div>
                    </div>

                    <div class="dropdown d-inline-block ml-2">
                        <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="d-none d-sm-inline-block ml-1"> {{ auth('admin')->user()->name }} </span>
                            <i class="mdi mdi-chevron-down d-none d-sm-inline-block"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right">

                            <a class="dropdown-item d-flex align-items-center justify-content-between"
                                href="/admin/logout">
                                <span>Log Out</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <!-- ========== Left Sidebar Start ========== -->
        <div class="vertical-menu">

            <div data-simplebar class="h-100">

                <div class="navbar-brand-box">
                    <a href="/" class="logo">
                        <i class="mdi mdi-umbrella"></i>
                        <span>
                            {{ config('app.name') }}
                        </span>
                    </a>
                </div>

                <!--- Sidemenu -->
                <div id="sidebar-menu">
                    @include('partials.admin_menus')
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">
                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">@yield('title')</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ config('app.name') }}</a></li>
                                        <li class="breadcrumb-item active">@yield('title')</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->
                    @yield('content')

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            @yield('modals')

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>document.write(new Date().getFullYear())</script> © {{ config('app.name') }}.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                Developed by Unnice
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <!-- Overlay-->
    <div class="menu-overlay"></div>


    <!-- jQuery  -->
    <script src="/other/assets/js/jquery.min.js"></script>
    <script src="/other/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/other/assets/js/metismenu.min.js"></script>
    <script src="/other/assets/js/waves.js"></script>
    <script src="/other/assets/js/simplebar.min.js"></script>

    <script src="/plugins/chart-js/chart.min.js"></script>
    <script src="/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="/plugins/quill/quill.min.js"></script>

    <!-- Morris Custom Js-->
    <script src="/other/assets/pages/dashboard-demo.js"></script>

    <!-- App js -->
    <script src="/other/assets/js/theme.js"></script>
    @yield('scripts')

</body>

</html>
