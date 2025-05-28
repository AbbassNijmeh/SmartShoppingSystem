<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title></title>

    <!-- Custom fonts for this template-->
    <link href="{{asset('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        .register-bg {
            min-height: 100vh;
            width: 100vw;
            background: linear-gradient(120deg, #2196f3 0%, #e3f2fd 100%);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-form-wrapper {
            background: rgba(255,255,255,0.95);
            border-radius: 1.2rem;
            box-shadow: 0 6px 32px 0 rgba(33, 150, 243, 0.10);
            padding: 2.2rem 2rem 1.5rem 2rem;
            width: 100%;
            max-width: 600px;
            min-width: 340px;
            margin: 2rem 0;
        }
        @media (max-width: 991.98px) {
            .register-form-wrapper {
                max-width: 98vw;
                min-width: 0;
            }
        }
        @media (max-width: 575.98px) {
            .register-bg {
                align-items: center !important;
                justify-content: center !important;
            }
            .register-form-wrapper {
                padding: 0.7rem 0.2rem 0.7rem 0.2rem;
                max-width: 100vw;
                min-width: 0;
                margin: 1.2rem auto;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .form-row {
                flex-direction: column;
                margin-right: 0;
                margin-left: 0;
                align-items: center;
            }
            .form-group.pr-1, .form-group.pl-1, .form-group {
                padding-right: 0;
                padding-left: 0;
                width: 95vw;
                max-width: 480px;
                display: flex;
                flex-direction: column;
                align-items: center;
            }
            .form-control {
                width: 100%;
                min-width: 0;
                max-width: 480px;
            }
            .register-title {
                font-size: 1.1rem;
            }
            .register-subtitle {
                font-size: 0.95rem;
            }
            .btn-register {
                font-size: 0.97em;
                padding: 0.5rem 0;
            }
        }
        .register-header {
            margin-bottom: 1.5rem;
        }
        .register-title {
            font-size: 1.5rem;
            font-weight: 800;
            color: #2196f3;
            margin-bottom: 0.2rem;
        }
        .register-subtitle {
            color: #1565c0;
            font-size: 1rem;
            margin-bottom: 0;
        }
        .form-row {
            display: flex;
            flex-wrap: wrap;
            margin-right: -5px;
            margin-left: -5px;
        }
        .form-group.pr-1 {
            padding-right: 5px;
        }
        .form-group.pl-1 {
            padding-left: 5px;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        .form-control {
            border-radius: 0.7rem;
            min-height: 36px;
            border: 1px solid #e3e6f0;
            font-size: 0.97em;
        }
        .form-control:focus {
            border-color: #2196f3;
            box-shadow: 0 0 0 0.15rem rgba(33, 150, 243, 0.10);
        }
        .btn-register {
            background: #2196f3;
            color: #fff;
            border: none;
            border-radius: 0.7rem;
            font-weight: 700;
            font-size: 1em;
            padding: 0.6rem 0;
            transition: background 0.3s;
        }
        .btn-register:hover {
            background: #1565c0;
        }
        .small {
            color: #2196f3;
            font-size: 0.97em;
        }
        .small:hover {
            color: #1565c0;
            text-decoration: underline;
        }
    </style>

</head>

<body>
    <div class="register-bg d-flex justify-content-center align-items-center">
        <div class="register-form-wrapper">
            <div class="register-header text-center mb-4">
                <h1 class="register-title">Create Your Account</h1>
                <p class="register-subtitle">Sign up to get started</p>
            </div>
            <form method="POST" action="{{ route('register') }}" class="justify-content-center">
                @csrf
                <div class="form-row">
                    <div class="form-group col-6 pr-1">
                        <label for="name">Name</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-6 pl-1">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6 pr-1">
                        <label for="phone">Phone</label>
                        <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group col-6 pl-1">
                        <label for="password">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-6 pr-1">
                        <label for="password-confirm">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div class="form-group col-6 pl-1 d-flex align-items-end">
                        <button type="submit" class="btn btn-register w-100">Register</button>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <a class="small" href="{{ route('login') }}">Already have an account? Login!</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('assets/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('assets/js/sb-admin-2.min.js')}}"></script>

</body>

</html>
