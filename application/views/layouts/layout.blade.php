@php
$CI =& get_instance();
$account = $CI->session->userdata('account');
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>Pegawai | | | </title>
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ base_url('assets/template/utama/plugins/fontawesome-free/css/all.min.css') }}">
  <link rel="stylesheet" href="{{ base_url('assets/plugins/fancybox/jquery.fancybox.min.css') }}">

  @yield('css-export')

  <!-- Theme style -->
  <link rel="stylesheet" href="{{ base_url('assets/template/utama/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  @yield('css-inline')
  <style>
    .close:before {
      display: none;
    }
    
    .action-no-wrap {
      width: 1%;
      white-space: nowrap;
    }
    .loading-overlay {
      z-index: 99999999 !important;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <li><a href="{{ base_url('logout') }}">Logout</a></li>
      </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="#" class="brand-link">
        <img src="{{ base_url('assets/template/utama/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
        style="opacity: .8">
        <span class="brand-text font-weight-light">Pegawai</span>
      </a>
      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <div class="elevation-2">

              <i class="fas fa-user-circle fa-2x"></i>
            </div>
          </div>
          <div class="info">
            <a href="#" class="d-block">{{ $account['username'] }}</a>
          </div>
        </div>
        <!-- Sidebar Menu -->
        @include('layouts.navbar')
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    <footer class="main-footer"></footer>
  </div>
  <!-- ./wrapper -->
  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="{{ base_url('assets/template/utama/plugins/jquery/jquery.min.js') }}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{ base_url('assets/template/utama/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ base_url('assets/plugins/axios.min.js') }}"></script>
  <script src="{{ base_url('assets/plugins/sweetalert2.all.min.js') }}"></script>
  <script src="{{ base_url('assets/plugins/jquery.loading.min.js') }}"></script>
  <script src="{{ base_url('assets/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
  <script>
    function toggleModal(modal, state) {
      if(state == $('body').hasClass('modal-open')) {
        throw new Error(
          'Modal is already ' + (state ? 'shown' : 'hidden') + '!'
          );
      }
      
      var d = $.Deferred();
      
      modal
      .one(state ? 'shown.bs.modal' : 'hidden.bs.modal', d.resolve)
      .modal(state ? 'show' : 'hide');

      return d.promise();
    };
  </script>
  @yield('js-export')

  <!-- AdminLTE App -->
  <script src="{{ base_url('assets/template/utama/dist/js/adminlte.min.js') }}"></script>


  @yield('js-inline')
  <script>

    $("body").loading({
      stoppable: false,
      theme: "light",
      start: false,
    });

    

  </script>
</body>
</html>
