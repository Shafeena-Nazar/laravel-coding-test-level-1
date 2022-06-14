<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Admin | ACN Events</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Machine Test" name="description" />
    <meta content="Shafeena Nazar" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{ asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/bootstrap-datepicker.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/dropzone.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/select2.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body data-sidebar="dark">

    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">


            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="{{ route('home') }}" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/images/logo.svg') }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('assets/images/logo-dark.png') }}" alt="" height="17">
                                </span>
                            </a>

                            <a href="{{ route('home') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('assets/images/logo-light.svg') }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('assets/images/logo-light.png') }}" alt="" height="19">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                            <i class="fa fa-fw fa-bars"></i>
                        </button>
                    </div>
                    @if(session()->has('error'))
                        <div class="alert alert-danger">
                            <strong>Warning ! {{ session()->get('error') }}</strong>
                        </div>
                    @endif
                    @if(session()->has('success'))
                        <div class="alert alert-success">
                            <strong>Success ! {{ session()->get('success') }}</strong>
                        </div>
                    @endif
                </div>
            </header>
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li>
                                <a href="{{ route('home') }}" class="waves-effect">
                                    <i class="bx bx-calendar"></i>
                                    <span key="t-calendar">Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('events') }}" class="waves-effect">
                                    <i class="bx bx-calendar"></i>
                                    <span key="t-calendar">Events</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('logout') }}" class="waves-effect">
                                    <i class="bx bx-calendar"></i>
                                    <span key="t-calendar">Logout</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <div class="main-content">

                <div class="page-content">
                    <div class="container-fluid">
