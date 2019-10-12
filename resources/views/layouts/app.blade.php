<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ env('APP_NAME', 'Perfect') }}</title>
    <link href="{{ url('css/index.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
</head>

<body class="app is-collapsed">
    <div id="loader">
        <div class="spinner"></div>
    </div>
    <div id="app">
        @include('layouts.sidebar')
        <div class="page-container">
            @include('layouts.header')
            <main class="main-content bgc-grey-100">
                <div id="mainContent">
                    <div class="full-container">
                        <div style="margin-left: 30px; margin-top: 10px">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script type="text/javascript" src="{{ url('js/app.js') }}"></script>
</body>

</html>
