<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Laramento</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/solid.min.css') }}">
    <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/skins/skin-green-light.css') }}">
    @yield('css')

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-green-light sidebar-mini">
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            <!-- Logo -->
            <a href="{{ url('/dashboard') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini">
                    {{-- <img src="{{ asset('dist/img/habibi-minis.png') }}" class="img-responsive" alt=""> --}}
                    <b>#</b>
                </span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg">
                    {{-- <img src="{{ asset('dist/img/habibi-minis.png') }}" class="hidden-xs img-responsive pull-left" alt="">{{" "}} --}}
                    <b>Lara</b>mento
                </span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- Tasks Menu -->
                        {{-- <li class="dropdown tasks-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-bell"></i>
                                <span class="label bgc-orange">9</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 9 notification</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <h3>Design some buttons<small class="pull-right">20%</small></h3>
                                                <div class="progress xs">
                                                    <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                        <span class="sr-only">20% Complete</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer">
                                    <a href="#">View all tasks</a>
                                </li>
                            </ul>
                        </li> --}}

                        <!-- Logout Menu -->
                        <li class="dropdown logout-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <span class="pull-left" style="margin-right:15px;">Hi, {{ Auth::user()->name }}</span>
                                <img src="{{ asset('dist/img/avatar.jpg') }}" class="logout-image" alt="Logout Image">
                                <i class="ion ion-android-arrow-dropdown"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header"><b>Menu</b></li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            {{-- <a href="{{ route('additional.profile') }}"><h3>My Profile</h3></a> --}}
                                            <a href="#"><h3>Pengaturan Akun</h3></a>
                                            <hr class="batas">
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                                {{ csrf_field() }}
                                                <a onclick="document.getElementById('logout-form').submit()" role="button"><h3><b><i class="fa fa-sign-out pull-right"></i>Keluar</b></h3></a>
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">
            <section class="sidebar">
                <ul class="sidebar-menu" data-widget="tree">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{{ asset('dist/img/avatar.jpg') }}" class="img-circle" alt="User Image">
                        </div>
                        <div class="pull-left info">
                            <p>{{ Auth::user()->name }}</p>
                            @role('owner')
                                <p><span class="label bgc-green">Owner</span></p>
                            @endrole
                            @role('employee')
                                <p><span class="label bgc-orange">Karyawan</span></p>
                            @endrole
                            @role('reseller')
                                <p><span class="label bgc-blue">Reseller</span></p>
                            @endrole
                            @role('guest')
                                <p><span class="label bgc-blue">Tamu</span></p>
                            @endrole
                        </div>
                    </div>
                    @include('layouts.menu')
                </ul>
            </section>
        </aside>

        @yield('content')

        <!-- Main Footer -->
        <footer class="main-footer">
            <div class="pull-right hidden-xs"><b>Made with <i style="color:red" class="fas fa-heart fa-xs"></i> from Bandung by <a href="#"><i class="fas fa-at fa-xs"></i>ardanfeb</a></b></div>
            <strong>Copyright &copy; 2019 <a href="#">Laramento</a></strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- JS -->
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    @yield('js')
</body>
</html>
