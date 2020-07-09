<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

  <title>@yield('title') | {{ getSiteName() }}</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/plugins/font-awesome/css/all.min.css') }}">

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('assets/themes/stisla/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/themes/stisla/css/components.css') }}">

  <link rel="icon" href="{{ getSiteLogo() }}">

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

  @yield('custom_head')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                  class="fas fa-search"></i></a></li>
          </ul>
        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown"
              class="nav-link dropdown-toggle nav-link-lg nav-link-user">
              <!-- <img alt="image" src="" class="rounded-circle mr-1"> -->
              <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Halo</div>
              <a href="{{ route('reg.account') }}" class="dropdown-item has-icon">
                <i class="far fa-user"></i> Akun
              </a>
              <div class="dropdown-divider"></div>
              <a href="#" class="dropdown-item has-icon text-danger" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
      </form>

      <div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ route('home') }}">{{ getSiteName() }}</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}">St</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Welcome to Dashboard</li>
            <li class="nav-item{{ __active('RegistrantController', 'index') }}">
              <a href="{{ route('reg.home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">PENDAFTARAN</li>
            <li class="nav-item{{ __active('RegistrantController', 'data') }}">
              <a href="{{ route('reg.data') }}" class="nav-link"><i class="fas fa-user"></i>
                <span>Data Pendaftaran</span></a>
            </li>
            <li class="nav-item{{ __active('RegistrantController', 'status') }}">
              <a class="nav-link" href="{{ route('reg.status') }}"><i class="fa fa-check"></i>
                <span>Status Pendaftaran</span></a></li>

            <li class="menu-header">Bantuan</li>
            <li class="nav-item{{ __active('HelpController', 'banks') }}">
              <a href="{{ route('reg.help.banks') }}" class="nav-link">
                <i class="fa fa-credit-card"></i> Pembayaran
              </a>
            </li>
            <li class="nav-item{{ __active('HelpController', 'contacts') }}">
              <a href="{{ route('reg.help.contacts') }}" class="nav-link">
                <i class="fa fa-phone"></i> Kontak
              </a>
            </li>
          </ul>
        </aside>
      </div>

      @yield('content')

      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2020 {{ getSiteName() }}
        </div>
        <div class="footer-right">
          Stisla admin
        </div>
      </footer>
    </div>
  </div>

  @yield('custom_html')

  <!-- General JS Scripts -->
  <script src="{{ asset('assets/plugins/jquery/jquery-3.2.1.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap/js/popper.js') }}"></script>
  <script src="{{ asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/plugins/jquery.nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('assets/themes/stisla/js/stisla.js') }}"></script>
  <script src="{{ asset('assets/themes/stisla/js/scripts.js') }}"></script>

  @stack('custom_js')
</body>

</html>