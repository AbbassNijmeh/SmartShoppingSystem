<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login | Shop</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&display=swap"
        rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Custom styles for this template-->
    <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #2196f3 0%, #ffffff 100%);
            font-family: 'Nunito', sans-serif;
        }

        .card {
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(33, 150, 243, 0.15);
            background: #fff;
            border: none;
        }

        .form-control {
            border-radius: 0.75rem;
            min-height: 48px;
            border: 1px solid #e3e6f0;
        }

        .form-control:focus {
            border-color: #2196f3;
            box-shadow: 0 0 0 0.2rem rgba(33, 150, 243, 0.15);
        }

        .btn-primary {
            background: #2196f3;
            border: none;
            border-radius: 0.75rem;
            font-weight: 600;
            transition: background 0.3s;
        }

        .btn-primary:hover {
            background: #1565c0;
        }

        .login-title {
            font-weight: 800;
            color: #2196f3;
            margin-bottom: 1.5rem;
        }

        .custom-checkbox .custom-control-label::before {
            border-radius: 0.5rem;
        }


        .form-group label {
            font-weight: 600;
            color: #1565c0;
        }

        .small {
            color: #2196f3;
        }

        .small:hover {
            color: #1565c0;
            text-decoration: underline;
        }

        .fa-user-circle.text-primary {
            color: #2196f3 !important;
        }
    </style>

</head>

<body>
    <div class="container d-flex justify-content-center align-items-center " style="height: 100vh;">
        <div class="col-lg-5 col-md-7">
            <div class="card o-hidden border-0 shadow-lg">
                <div class="card-body">
                    <div class="text-center">
                        <i class="fas fa-user-circle fa-3x mb-3 text-primary"></i>
                        <h1 class="login-title">Login to Your Account</h1>
                    </div>
                    <form method="POST" action="{{ route('login') }}" >
                        @csrf
                        <div class="form-group mb-4">
                            <label for="email">Email Address</label>
                            <input id="email" type="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <label for="password">Password</label>
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group mb-4">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mb-3">Login</button>
                        @if (Route::has('password.request'))
                        <div class="text-center mb-2">
                            <a class="small" href="{{ route('password.request') }}">Forgot Your Password?</a>
                        </div>
                        @endif
                        <div class="text-center">
                            <a class="small" href="{{ route('register') }}">Create an Account!</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
