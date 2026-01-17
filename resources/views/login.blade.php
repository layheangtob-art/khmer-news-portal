<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="{{ asset('loginForm/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('loginForm/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('loginForm/css/style.css') }}" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <title>Login</title>
</head>

<body>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="_lk_de">
                        <div class="form-03-main modern-form">
                            <div class="logo-wrapper">
                                <div class="logo-circle">
                                    <img src="{{ asset('img/user.png') }}" alt="User">
                                </div>
                                <h2 class="form-title">Welcome Back</h2>
                                <p class="form-subtitle">Sign in to continue</p>
                            </div>

                            @if($errors->any())
                                <div class="alert alert-danger modern-alert" role="alert">
                                    <i class="fa fa-exclamation-circle"></i>
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <form id="loginForm" method="POST" action="{{ route('login.submit') }}" class="modern-form-content">
                                @csrf

                                <div class="form-group modern-input-group">
                                    <label class="input-label">
                                        <i class="fa fa-envelope input-icon"></i>
                                        <input type="email" name="email" class="form-control modern-input"
                                            placeholder="Enter your email" aria-required="true" required
                                            value="{{ old('email', Cookie::get('email')) }}">
                                    </label>
                                </div>

                                <div class="form-group modern-input-group">
                                    <label class="input-label">
                                        <i class="fa fa-lock input-icon"></i>
                                        <input type="password" name="password" class="form-control modern-input"
                                            placeholder="Enter your password" aria-required="true" required
                                            value="{{ old('password', Cookie::get('password')) }}" id="passwordInput">
                                        <i class="fa fa-eye toggle-password-icon" id="togglePassword"></i>
                                    </label>
                                </div>

                                <div class="form-group modern-options">
                                    <div class="form-check modern-checkbox">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                                        <label class="form-check-label" for="remember">
                                            Remember me
                                        </label>
                                    </div>
                                    <a href="#" class="forgot-link">Forgot Password?</a>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="modern-btn" id="loginButton">
                                        <span>Login</span>
                                        <i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>

                                <div class="divider">
                                    <span>Or continue with</span>
                                </div>

                                {{-- <div class="form-group social-buttons">
                                    <div class="_social_04">
                                        <ol>
                                            <li class="social-btn" data-social="facebook">
                                                <i class="fa fa-facebook"></i>
                                            </li>
                                            <li class="social-btn" data-social="twitter">
                                                <i class="fa fa-twitter"></i>
                                            </li>
                                            <li class="social-btn" data-social="google">
                                                <a href="{{ route('register') }}">
                                                    <i class="fa fa-google"></i>
                                                </a>
                                            </li>
                                            <li class="social-btn" data-social="instagram">
                                                <i class="fa fa-instagram"></i>
                                            </li>
                                            <li class="social-btn" data-social="linkedin">
                                                <i class="fa fa-linkedin"></i>
                                            </li>
                                        </ol>
                                    </div>
                                </div> --}}

                                <div class="form-footer">
                                    <p>Don't have an account? <a href="{{ route('register') }}" class="register-link">Sign up</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('components.admin-footer')
    <script src="{{ asset('js/togglePassword.js') }}"></script>
</body>

</html>
