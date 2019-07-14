<!DOCTYPE html>
<html>
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
    <link rel="image_src" type="image/jpeg" href="/images/logo.png" />
    <link rel="icon" href="img/favicon.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon" />
    <!-- Site Properities -->
    <meta name="generator" content="Visual Studio" />
    <title>Sign In | Golgi Admin</title>
    <meta name="description" content="Golgi Admin Theme" />
    <meta name="keywords" content="html5, ,semantic,ui, library, framework, javascript,jquery,admin,theme" />
    <link href="dist/semantic.min.css" rel="stylesheet" />
    <link href="css/main.min.css" rel="stylesheet" />
</head>
<body class="signin">

    <div class="ui container">
        <div class="ui equal width center aligned padded grid stackable">
            <div class="row">
                <div class="five wide column">
                    <div class="ui segments">
                        <div class="ui segment inverted nightli">
                            <h3 class="ui header">
                                Sayatanar
                            </h3>
                        </div>
                        <div class="ui segment">
                            <div class="description">
                                Make Desired Dream
                            </div>
                            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                              <div class="ui divider">
                                {{ csrf_field() }}
                              </div>
                              <div class="ui input fluid">
                                  <input id="email" type="email"  name="email" value="{{ old('email') }}" placeholder ="Email" required autofocus>
                              </div>
                              @if ($errors->has('email'))
                              <span class="help-block">
                                  <strong>{{ $errors->first('email') }}</strong>
                              </span>
                              @endif
                              <div class="ui divider hidden"></div>
                              <div class="ui input fluid">
                                <input id="password" type="password" name="password"
                                placeholder ="Password"  required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                              </div>
                              <div class="ui divider hidden"></div>
                              <div class="ui divider hidden"></div>
                              <button class="ui primary fluid button">
                                  <i class="key icon"></i>
                                  Sign In
                              </button>
                            </form>
                            
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>



    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript">
        var onloadCallback = function () {
            alert("grecaptcha is ready!");
        };
    </script>
</body>
</html>
