<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login V19</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="{{ asset("css/login/util.css") }}">
    <link rel="stylesheet" type="text/css" href="{{ asset("css/login/main.css") }}">
</head>
<body>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
            <form method="POST" action="{{ url('/login') }}" class="login100-form validate-form">

                @csrf

                <span class="login100-form-title p-b-33">
						Saydana Admin Login
                </span>

                <div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
                    <input class="input100" type="text" name="email" placeholder="Email">
                    <span class="focus-input100-1"></span>
                    <span class="focus-input100-2"></span>
                </div>

                <div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
                    <input class="input100" type="password" name="password" placeholder="Password">
                    <span class="focus-input100-1"></span>
                    <span class="focus-input100-2"></span>
                </div>

                <div class="container-login100-form-btn m-t-20">
                    <button class="login100-form-btn">
                        Sign in
                    </button>
                </div>
                @error('email')
                <div class="text-center p-t-45 p-b-4">
						<span class="txt3">
							{{ $message }}
						</span>
                </div>
                @enderror
            </form>
        </div>
    </div>
</div>
</body>
</html>
