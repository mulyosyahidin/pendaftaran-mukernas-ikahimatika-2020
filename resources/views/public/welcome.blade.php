<!DOCTYPE html>
<html lang="id-ID">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Selamat Datang di {{ getSiteName() }}</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="../node_modules/bootstrap-social/bootstrap-social.css">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/themes/stisla/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/themes/stisla/css/components.css') }}">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-138671814-2"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() {
            dataLayer.push(arguments);
        }
        
        gtag('js', new Date());

        gtag('config', 'UA-138671814-2');
    </script>
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="d-flex flex-wrap align-items-stretch">
                <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                    <div class="p-4 m-3">
                        <img src="{{ getSiteLogo() }}" alt="logo" width="80"
                            class="shadow-light rounded-circle mb-5 mt-2">
                        <h4 class="text-dark font-weight-normal">Selamat Datang di <span
                                class="font-weight-bold">{{ getSiteName() }}</span></h4>
                               
                        @if (Auth::check())
                            @if (getRole() == 'registrant')
                            <p>
                                Halo, <b>{{ Auth::user()->name }}</b>
                            </p>
                            <p>
                                Silahkan menuju ke dasbor untuk melihat data kamu.
                            </p>
                            @else
                                <p>Halo Admin, silahkan menuju ke dasbor untuk mengelola data.</p>
                            @endif

                            <div class="text-center mt-5">
                                @if (getRole() == 'registrant')
                                    <a href="{{ route('reg.home') }}" class="btn btn-primary">Dasbor Saya</a>
                                @else
                                    <a href="{{ route('admin.home') }}" class="btn btn-primary">Dasbor Saya</a>
                                @endif
                                <a class="btn btn-warning" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 {{ __('Logout') }}
                             </a>
                            </div>

                            <div style="margin-top:320px"></div>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @else
                        <p class="text-muted">
                            @if (Session::has('error'))
                            <span class="text-danger">
                                {{ Session::get('error') }}
                            </span>
                            @else
                            Silahkan login dengan email dan password, atau mendaftar jika belum punya akun.
                            @endif
                        </p>

                        

                        <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                            @csrf

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input id="email" type="email" class="form-control" name="email" tabindex="1" required
                                    autofocus>
                                <div class="invalid-feedback">
                                    Masukkan email akun kamu
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-block">
                                    <label for="password" class="control-label">Password</label>
                                </div>
                                <input id="password" type="password" class="form-control" name="password" tabindex="2"
                                    required>
                                <div class="invalid-feedback">
                                    Masukkan password akun kamu
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                                        id="remember-me">
                                    <label class="custom-control-label" for="remember-me">Remember Me</label>
                                </div>
                            </div>

                            <div class="form-group text-right">
                                <a href="auth-forgot-password.html" class="float-left mt-3">
                                    Lupa Password?
                                </a>
                                <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                                    Login
                                </button>
                            </div>

                            <div class="mt-5 text-center">
                                Belum punya akun? <a href="{{ route('register') }}">Daftar disini!</a>
                            </div>
                        </form>
                        @endif

                        <div class="text-center mt-5 text-small">
                            {{ getSiteName() }}
                            <div class="mt-2">
                                <a href="https://jurnalmms.web.id/" target="_blank">Mt Kun</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom"
                    data-background="{{ asset('assets/themes/stisla/img/unsplash/login-bg.jpg') }}">
                    <div class="absolute-bottom-left index-2">
                        <div class="text-light p-5 pb-2">
                            <div class="mb-5 pb-3">
                                <h1 class="mb-2 display-4 font-weight-bold">
                                  @if ($hour < 6)
                                    Selamat Malam
                                  @elseif ($hour > 6 && $hour < 11)
                                    Selamat Pagi
                                  @elseif ($hour > 11 && $hour < 18)
                                    Selamat Sore
                                  @elseif ($hour > 18)
                                    Selamat Malam
                                  @endif
                                </h1>
                                <h5 class="font-weight-normal text-muted-transparent">Bengkulu, Indonesia</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/plugins/jquery/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/popper.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/themes/stisla//js/stisla.js') }}"></script>

    <!-- Template JS File -->
    <script src="{{ asset('assets/themes/stisla/js/scripts.js') }}"></script>
</body>

</html>
