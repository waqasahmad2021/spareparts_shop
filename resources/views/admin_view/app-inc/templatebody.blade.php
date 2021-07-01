<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="waqas ahmad">
    <title>Admin Dashboard</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/charts/apexcharts.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/extensions/toastr.min.css') }}">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/bootstrap-extended.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/colors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/components.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/themes/dark-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/themes/bordered-layout.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/themes/semi-dark-layout.min.css') }}">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/core/menu/menu-types/vertical-menu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/pages/dashboard-ecommerce.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/plugins/charts/chart-apex.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/plugins/extensions/ext-component-toastr.min.css') }}">
    <!-- END: Page CSS-->

    <!-- BEGIN: Datatable CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/vendors/css/tables/datatable/responsive.bootstrap.min.css') }}">
    <!-- END: Datatable CSS-->

    <!-- BEGIN: users CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/pages/app-user.min.css') }}">
    <!-- END: users CSS-->

    <!-- BEGIN: Custom CSS-->
    <!-- <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css"> -->
    <!-- END: Custom CSS-->

     <link rel="stylesheet" type="text/css" href="{{ asset('admin/css/pages/ui-feather.min.css') }}">

    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/css/custom.css') }}">

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern  navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="">
    {{-- @php
    phpinfo(); exit;
@endphp --}}
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow">
        <div class="navbar-container d-flex content">

            <ul class="nav navbar-nav align-items-center ml-auto">

                <li class="nav-item dropdown dropdown-user">
                    <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name font-weight-bolder">
                         {{-- {{ Auth::user()->name }} --}}
                        {{Auth::user()->name}}
                        </span><span class="user-status">
                        {{
                            (Auth::user()->choices == "0") ? 'Supper Admin' : 'Admin'
                        }}
                        </span></div><span class="avatar">

                        @php
                            if(Auth::user()->image != ""){
                                echo '<img class="round" src="'.asset('storage/profile_images/'.Auth::user()->image ).'" alt="users avatar" height="40" width="40" >';
                            }else{
                                echo '<img class="round" src="'.asset('admin/dummy/profile2.png').'" alt="users avatar" height="40" width="40" >';
                            }
                        @endphp
                        {{-- <img class="round" src="{{asset('') }}" alt="avatar" height="40" width="40"> --}}

                        <span class="avatar-status-online"></span></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdown-user">
                        <a class="dropdown-item" href="{{route('profile.create')}}"><i class="mr-50" data-feather="user"></i> Profile</a>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <i class="mr-50" data-feather="power"></i> {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">

        @if(!empty(Auth::user()))
            @php
                $permission = json_decode(Auth::user()->permission);
                //dd($permission);
                $show_tab_pro = "no";
                $show_tab_user = "no";
                $show_tab_general = "no";
            @endphp
            @if(!empty($permission))
            @foreach($permission as $row)
                @php
                    if(!empty($row->product)){
                        $proarr = $row->product;
                        if($proarr == "read" || $proarr == "add" || $proarr == "edit" || $proarr == "delete"){
                            $show_tab_pro = "yes";
                        }
                    }
                    if(!empty($row->users)){
                        $usersarr = $row->users;
                        if($usersarr == "read" || $usersarr == "add" || $usersarr == "edit" || $usersarr == "delete"){
                            $show_tab_user = "yes";
                        }
                    }
                    if(!empty($row->general)){
                        $generalsarr = $row->general;
                        if($generalsarr == "read" || $generalsarr == "add" || $generalsarr == "edit" || $generalsarr == "delete"){
                            $show_tab_general = "yes";
                        }
                    }
                @endphp
            @endforeach
            @endif
        @endif

            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto">
                    <a class="navbar-brand" href="javascript:void(0);">
                        <span class="brand-logo">Logo</span>
                    </a>
                </li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item"><a class="d-flex align-items-center" href="javascript:void(0);"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboards</span></a></li>
                <li class=" navigation-header"><span data-i18n="Apps &amp; Pages"> Pages</span><i data-feather="more-horizontal"></i></li>


                @if($show_tab_pro === "yes" || Auth::user()->choices == "0")
                    <li class="nav-item">
                        <a href="{{ route('product') }}" class="d-flex align-items-center">
                            <svg xmlns="" width="14px" height="14px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                            <span class="menu-title text-truncate">Products</span>
                        </a>
                    </li>
                @endif

                @if($show_tab_user == "yes" || Auth::user()->choices == "0")
                    <li class="nav-item">
                        <a href="{{ route('common_users.index') }}" class="d-flex align-items-center">
                            <svg xmlns="" width="14px" height="14px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                            <span class="menu-title text-truncate">User Registeration</span>
                        </a>
                    </li>
                @endif

                @if($show_tab_general == "yes" || Auth::user()->choices == "0")
                    <li class="nav-item">
                        <a href="{{route('general.index')}}" class="d-flex align-items-center">
                            <svg xmlns="" width="14px" height="14px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                            <span class="menu-title text-truncate">General Setting</span>
                        </a>
                    </li>
                @endif

                <li class="nav-item">
                    <a href="{{route('profile.create')}}" class="d-flex align-items-center">
                        <svg xmlns="" width="14px" height="14px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>
                        <span class="menu-title text-truncate">Profile Setting</span>
                    </a>
                </li>

            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard content Starts -->
                    @yield('content')
                <!-- Dashboard content ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- Buynow Button-->
    <!-- <div class="buy-now">
      <a href="javascript:;" target="_blank" class="btn btn-danger">Buy Now</a>
    </div> -->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT  &copy; <?php echo date("Y");?> <a class="ml-25" href="javascript:void(0);" target="_blank">Dill Muhammad</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span>
        </p>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{ asset('admin/vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ asset('admin/vendors/js/charts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/extensions/toastr.min.js') }}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ asset('admin/js/core/app-menu.min.js') }}"></script>
    <script src="{{ asset('admin/js/core/app.min.js') }}"></script>
    <script src="{{ asset('admin/js/scripts/customizer.min.js') }}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('admin/js/scripts/pages/dashboard-ecommerce.min.js') }}"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: DataTable JS-->
    <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/js/tables/datatable/responsive.bootstrap.min.js') }}"></script>
    <!-- END: DataTable JS-->

    <!-- BEGIN: Users JS-->
    <script src="{{ asset('admin/js/scripts/pages/app-user-view.min.js') }}"></script>
    <!-- END: Users JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ asset('admin/js/scripts/ui/ui-feather.min.js') }}"></script>

    <script>
        $(window).on('load', function() {
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>

    <!-- Custom js Start-->
    <script src="{{ asset('frontend/js/custom.js') }}"></script>

</body>
<!-- END: Body-->

</html>

