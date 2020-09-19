<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1"/>
    <link rel="image_src" type="image/jpeg" href="/images/logo.png" />
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <!-- Site Properities -->
    <title>Saytanar</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{url('plugins/chartist/chartist.css')}}" rel="stylesheet" />
    <link href="{{url('plugins/datepicker/css/bootstrap-datepicker3.css')}}" rel="stylesheet" />
    <link href="{{url('dist/semantic.min.css')}}" rel="stylesheet" />
    <link href="{{url('css/main.min.css')}}" rel="stylesheet" />
    <link href="{{url('plugins/pacejs/pace.css')}}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ url('css/plugins/toastr/toastr.min.css') }}" />
    @yield('styles')
</head>
<body class="admin" ng-app = "saytanar">
    <!--sidebar mobile-->
    <div class="ui vertical push sidebar menu  thin" id="toc">
    </div>
    <!--sidebar mobile-->
    <!--navbar mobile-->
    <div class="mobilenavbar">
    </div>
    <!--navbar mobile-->

    <div class="pusher">
        <div class="full height">
            <!--Load Sidebar Menu In App.js loadhtml function-->
            <div class="toc" id="sdmu">
              @include('layouts.loadsidemenu')
            </div>
            <!--Load Sidebar Menu In App.js loadhtml function-->

            <div class="article">

                <!--Load Navbar Menu In App.js loadhtml function-->
                <div class="navbarmenu" id="nbr">
                    @include('layouts.loadnavbar')
                </div>
                <!--Load Navbar Menu In App.js loadhtml function-->
                <!--Begin Container-->
                <div class="containerli">
                  @yield('content')
                  <div class="footer"></div>
                </div>
            </div>
                <!--Finish Container-->
                <!--Load Footer Menu In App.js loadhtml function-->

                <!--Load Footer Menu In App.js loadhtml function-->
            </div>
        </div>
    </div>
    <script src="{{url('js/jquery-2.1.4.min.js')}}"></script>
    <script src="{{url('plugins/nicescrool/jquery.nicescroll.min.js')}}"></script>
    <script src="{{url('dist/semantic.min.js')}}"></script>
    <script data-pace-options='{ "ajax": false }' src="{{url('plugins/pacejs/pace.js')}}"></script>
    <script src="{{url('js/app.js')}}"></script>
    <script src="{!! asset('js/sweetalert.js') !!}"></script>
    <script src="{{ url('js/plugins/toastr/toastr.min.js') }}" type="text/javascript"></script>
    @include('flash')
      @yield('scripts')

</body>
</html>
