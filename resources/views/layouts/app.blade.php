<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset("images/favicon.png") }}">
    <title>@yield('title') | Saytana</title>
    <!-- Bootstrap Core CSS -->
    <link href="{{ asset("assets/plugins/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href={{ asset("css/style.css") }} rel="stylesheet">
    <link href="{{ asset("css/custom.css") }}" rel="stylesheet">
    <!-- You can change the theme colors from here -->
    <link href={{ asset("css/colors/blue.css") }} id="theme" rel="stylesheet">
    <style>
        body.mm {
            font-size: 0.9rem;
        }
    </style>
</head>

<body class="fix-header fix-sidebar card-no-border {{ app()->getLocale() }}">
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
</div>
<div id="app">
    <div id="main-wrapper">
        <header class="topbar">
            <nav class="navbar top-navbar navbar-toggleable-sm navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ url("/") }}">
                        <b><img src="{{ asset("images/logo-icon.png") }}" alt="homepage" class="dark-logo" /></b>
                        <span> <img src="{{ asset("images/logo-text.png") }}" alt="homepage" class="dark-logo" /></span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0 ">
                        <li class="nav-item">
                            <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark">
                                <i class="ti-menu"></i>
                            </a>
                        </li>
                        <li class="nav-item hidden-sm-down">
                            <form class="app-search p-l-20">
                                <input type="text" class="form-control" placeholder="Search for..."> <a class="srh-btn"><i class="ti-search"></i></a>
                            </form>
                        </li>
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" data-toggle="dropdown"
                               href="#" data-toggle="dropdown" id="navbarDropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ url("images/users/1.jpg") }}" alt="user" class="profile-pic m-r-5"/>
                                {{ Auth::user()->name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"> <i class="fa fa-sign-out" aria-hidden="true"></i>Sign Out
                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li>
                            <a href={{ url("/") }} class="waves-effect"><i class="fa fa-clock-o m-r-10" aria-hidden="true"></i>Dashboard</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <div class="page-wrapper">

            @yield("content")
            <footer class="row footer">
                <div class="mr-auto ml-3 text-left">
                    Version 1.0
                </div>
                <div class="ml-auto mr-3 text-right">
                    © 2020 Saydana
                </div>
            </footer>
        </div>
    </div>
</div>
<script src={{ asset("js/app.js") }}></script>
<!-- slimscrollbar scrollbar JavaScript -->
<script src="{{ asset("js/jquery.min.js")  }}"></script>
<script src={{ asset("js/jquery.slimscroll.js") }}></script>

<script src="{{ asset("assets/plugins/bootstrap/js/tether.min.js")  }}"></script>
<script src="{{ asset("assets/plugins/bootstrap/js/bootstrap.min.js")  }}"></script>
<script src={{ asset("js/jquery.slimscroll.js") }}></script>
<!--Wave Effects -->
<script src={{ asset("js/waves.js") }}></script>
<!--Menu sidebar -->
<script src={{ asset("js/sidebarmenu.js") }}></script>
<!--stickey kit -->
<script src={{ asset("js/sticky-kit.min.js") }}></script>
<!--Custom JavaScript -->
<script src={{ asset("js/custom.min.js") }}></script>
<!-- This page plugins -->
<script src={{ asset("js/jQuery.style.switcher.js") }}></script>
</body>

</html>
