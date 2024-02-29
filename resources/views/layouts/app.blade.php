<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EMB | Support Service Ticketing System </title>

  <link rel="icon" href="../../AdminLTE-3.2.0/dist/img/denr-emb-logo.gif">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css"> 
  <!-- iCheck -->
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css"> 
  <!-- Select2 -->
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/icheck-bootstrap/icheck-bootstrap.min.css"> 
  <!-- Theme style --> 
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css"> 
  <!-- summernote -->
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css">
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light bg-orange">
    <div class="container">
      <a href="../../AdminLTE-3.2.0/index3.html" class="navbar-brand">
        <img src="../../AdminLTE-3.2.0/dist/img/emb-logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-light">SSTS | </span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            @if(Auth::user()->type == 'manager')
            <a href="{{ route('manager.home') }}" class="nav-link">Home</a>
            @elseif(Auth::user()->type == 'admin')
            <a href="{{ route('admin.home') }}" class="nav-link">Home</a>
            @endif
          </li>
          <li class="nav-item">
            @if(Auth::user()->type == 'manager')
            <a href="{{ route('manager.survey') }}" class="nav-link">Survey</a>
            @elseif(Auth::user()->type == 'admin')
            <a href="{{ route('admin.survey') }}" class="nav-link">Survey</a>
            @endif
          </li>
        </ul>
      </div>
      @guest

      @else
      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge" id="badge-count">0</span>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <span class="dropdown-header" id="header-notification-count">0 Notifications</span>
            <div class="dropdown-divider"></div>

            @if(Auth::user()->type == 'manager')
            <a href="{{route('manager.home')}}" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> <span id="count-message">4 unssen messages</span>
              <!-- <span class="float-right text-muted text-sm" id="count-minutes">3 mins</span> -->
            </a>
            <a href="{{route('manager.home')}}" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> <span id="count-message-unresolve">4 unssen messages</span>
              <!-- <span class="float-right text-muted text-sm" id="count-minutes-unresolve">3 mins</span> -->
            </a>
            @elseif(Auth::user()->type == 'admin')
            <a href="{{route('admin.home')}}" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> <span id="count-message">4 unssen messages</span>
              <!-- <span class="float-right text-muted text-sm" id="count-minutes">3 mins</span> -->
            </a><a href="{{route('manager.home')}}" class="dropdown-item">
              <i class="fas fa-envelope mr-2"></i> <span id="count-message-unresolve">4 unssen messages</span>
              <!-- <span class="float-right text-muted text-sm" id="count-minutes-unresolve">3 mins</span> -->
            </a>
            @endif
            <!-- <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-users mr-2"></i> 8 friend requests
              <span class="float-right text-muted text-sm">12 hours</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item">
              <i class="fas fa-file mr-2"></i> 3 new reports
              <span class="float-right text-muted text-sm">2 days</span>
            </a>
            <div class="dropdown-divider"></div>
            <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> -->
          </div>
        </li>
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            {{ isset(Auth::user()->name) ? Auth::user()->name : Auth::user()->username }}
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <a href="/profile" class="dropdown-item">
              Profile
            </a>
            @if(Auth::user()->type == 'manager')
            <a href="{{ route('manager.accounts') }}" class="dropdown-item">
              Manage Accounts
            </a>
            <div class="dropdown-divider"></div>
            <a href="{{ route('manager.logs') }}" class="dropdown-item">
              Timeline
            </a>
            <div class="dropdown-divider"></div>
            @endif

            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
          </div>
        </li>
      </ul>
      @endif
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      @yield('header')
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        @yield('content')
    </section>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../../AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->

<script src="../../AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js"></script>
<script>
  $.widget.bridge('uibutton', $.ui.button)

</script>
<!-- Bootstrap 4 -->
<script src="../../AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../AdminLTE-3.2.0/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="../../AdminLTE-3.2.0/plugins/sparklines/sparkline.js"></script>
<!-- jQuery Knob Chart -->
<script src="../../AdminLTE-3.2.0/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="../../AdminLTE-3.2.0/plugins/moment/moment.min.js"></script>
<script src="../../AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="../../AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../../AdminLTE-3.2.0/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../AdminLTE-3.2.0/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="../../AdminLTE-3.2.0/dist/js/pages/dashboard.js"></script> -->

<script src="../../AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../AdminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>
<script src="../../AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="../../AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js"></script>

<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="https://kit.fontawesome.com/0e706b6aa8.js" crossorigin="anonymous"></script>

<script src="https://momentjs.com/downloads/moment.js"></script>

<script>

  var user_type = '{{ Auth::user()->type }}';

  $(function() {

    if(user_type != 0) {

      $.ajax({
        url: "{{route('/get-notifications')}}",
        type: 'POST',
        data: {
          _token: '{{csrf_token()}}',
        },
        beforeSend: function () {
          $('.loading-overlay').show();
          $('.loading-overlay-image-container').show();
        },
        complete: function () {
          $('.loading-overlay').hide();
          $('.loading-overlay-image-container').hide();
        },
        success: function (result) {
          console.log(result);

          $("#badge-count").html(result[0]);

          if(result[0] == 1) {
            $("#count-message").html(result[0] + ' unseen concern');
            $("#header-notification-count").html(result[0] + ' Notification');

            $("#count-message-unresolve").html(result[2] + ' pending concern');

          } else {
            $("#count-message").html(result[0] + ' unseen concern');
            $("#header-notification-count").html(result[0] + ' Notifications');

            $("#count-message-unresolve").html(result[2] + ' pending concern');
          }

          // $("#count-minutes").html(moment(result[1]['created_date']).fromNow());
          // $("#count-minutes-unresolve").html(moment(result[3]['created_date']).fromNow());

        }
      });
    }
  })
</script>
</body>
</html>
