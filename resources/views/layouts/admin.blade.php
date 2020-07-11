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
              <img alt="image" src="{{ getSiteLogo() }}" class="rounded-circle mr-1">
              <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
              <div class="dropdown-title">Halo</div>
              <a href="{{ route('admin.settings') }}" class="dropdown-item has-icon">
                <i class="fas fa-cog"></i> Pengaturan
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
            <a href="{{ route('home') }}">{{ createAcronym(getSiteName()) }}</a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Welcome to Dashboard</li>
            <li class="nav-item{{ __active('AdminController', 'index') }}">
              <a href="{{ route('admin.home') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Pendaftaran Peserta</li>
            <li class="nav-item{{ __active('RegistrantController', ['index', 'show']) }}">
              <a href="{{ route('admin.reg.all') }}" class="nav-link"><i class="fas fa-columns"></i>
                <span>Data Pendaftaran</span></a>
            </li>
            <li class="nav-item{{ __active('RegistrantController', 'display', '|1') }}">
              <a class="nav-link" href="{{ route('admin.reg.display', 1) }}"><i class="fas fa-file-pdf"></i>
                <span>Verifikasi Berkas</span></a></li>
            <li class="nav-item{{ __active('RegistrantController', 'display', '|2') }}">
              <a class="nav-link " href="{{ route('admin.reg.display', 2) }}"><i class="fas fa-credit-card"></i>
                <span>Verifikasi Pembayaran</span></a></li>
            <li class="nav-item{{ __active('RegistrantController', 'display', '|3') }}">
              <a class="nav-link" href="{{ route('admin.reg.display', 3) }}"><i class="fas fa-check"></i>
                <span>Pendaftaran Selesai</span></a></li>
            <li class="nav-item{{ __active('RegistrantController', 'display', '|4') }}">
                  <a class="nav-link" href="{{ route('admin.reg.display', 4) }}"><i class="fas fa-times"></i>
                    <span>Pendaftaran Gagal</span></a></li>
            <li class="nav-item{{ __active('RegistrantController', 'export') }}">
              <a href="{{ route('admin.reg.export') }}" class="nav-link"><i class="fas fa-file-excel"></i>
                <span>Ekspor Data</span>
              </a>
            </li>

            <li class="menu-header">HIMPUNAN</li>
            <li class="nav-item{{ __active('RegionController', 'index') }}">
              <a href="{{ route('admin.region') }}" class="nav-link"><i class="fas fa-map-signs"></i>
                <span>Wilayah</span></a>
            </li>
            <li class="nav-item{{ __active('UniversityController', 'index') }}">
              <a class="nav-link" href="{{ route('admin.university') }}"><i class="fas fa-university"></i>
                <span>Universitas</span></a></li>
            <li class="nav-item{{ __active('HimpunanController', ['index', 'create']) }}">
              <a class="nav-link " href="{{ route('admin.himpunan') }}"><i class="fas fa-users"></i>
                <span>Himpunan</span></a></li>

            <li class="menu-header">PENGATURAN</li>
            <li class="nav-item{{ __active('SettingController', 'banks') }}">
              <a href="{{ route('admin.settings.banks') }}" class="nav-link"><i class="fas fa-info-circle"></i>
                <span>Rekening Bank</span></a>
            </li>
            <li class="nav-item{{ __active('SettingController', 'contacts') }}">
              <a class="nav-link" href="{{ route('admin.settings.contacts') }}"><i class="fas fa-phone"></i>
                <span>Kontak Peserta</span></a></li>
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