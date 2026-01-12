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

    <title>Register</title>
</head>

<body>
    <section class="form-02-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="_lk_de">
                        <div class="form-03-main modern-form">
                            <div class="logo-wrapper">
                                <div class="logo-circle">
                                    <img src="{{ asset('img/user.png') }}" alt="User">
                                </div>
                                <h2 class="form-title">Create Account</h2>
                                <p class="form-subtitle">Sign up to get started</p>
                            </div>

                            @if($errors->any())
                                <div class="alert alert-danger modern-alert" role="alert">
                                    <i class="fa fa-exclamation-circle"></i>
                                    {{ $errors->first() }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('register.submit') }}" class="modern-form-content">
                                @csrf

                                <div class="form-group modern-input-group">
                                    <label class="input-label">
                                        <i class="fa fa-user input-icon"></i>
                                        <input type="text" name="name" class="form-control modern-input"
                                            placeholder="Enter your name" aria-required="true" required
                                            value="{{ old('name') }}">
                                    </label>
                                </div>

                                <div class="form-group modern-input-group">
                                    <label class="input-label">
                                        <i class="fa fa-envelope input-icon"></i>
                                        <input type="email" name="email" class="form-control modern-input"
                                            placeholder="Enter your email" aria-required="true" required
                                            value="{{ old('email') }}">
                                    </label>
                                </div>

                                <div class="form-group modern-input-group">
                                    <label class="input-label">
                                        <i class="fa fa-lock input-icon"></i>
                                        <input type="password" name="password" class="form-control modern-input"
                                            placeholder="Enter your password" aria-required="true" required
                                            id="passwordInput">
                                        <i class="fa fa-eye toggle-password-icon" id="togglePassword"></i>
                                    </label>
                                </div>

                                <div class="form-group modern-input-group">
                                    <label class="input-label">
                                        <i class="fa fa-lock input-icon"></i>
                                        <input type="password" name="password_confirmation" class="form-control modern-input"
                                            placeholder="Confirm your password" aria-required="true" required
                                            id="confirmPasswordInput">
                                        <i class="fa fa-eye toggle-password-icon" id="toggleConfirmPassword"></i>
                                    </label>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="modern-btn" id="registerButton">
                                        <span>Register</span>
                                        <i class="fa fa-arrow-right"></i>
                                    </button>
                                </div>

                                <div class="divider">
                                    <span>Or continue with</span>
                                </div>

                                <div class="form-group social-buttons">
                                    <div class="_social_04">
                                        <ol>
                                            <li class="social-btn" data-social="facebook">
                                                <i class="fa fa-facebook"></i>
                                            </li>
                                            <li class="social-btn" data-social="twitter">
                                                <i class="fa fa-twitter"></i>
                                            </li>
                                            <li class="social-btn" data-social="google">
                                                <a href="{{ route('login') }}">
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
                                </div>

                                <div class="form-footer">
                                    <p>Already have an account? <a href="{{ route('login') }}" class="register-link">Sign in</a></p>
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
