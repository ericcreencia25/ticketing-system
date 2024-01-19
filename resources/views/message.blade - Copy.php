<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EMB | Contact Us</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="../../AdminLTE-3.2.0/index3.html" class="navbar-brand">
        <img src="../../AdminLTE-3.2.0/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">EMB</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{ route('login') }}" class="nav-link">Login</a>
          </li>
          <!-- <li class="nav-item">
            <a href="#" class="nav-link">Register</a>
          </li> -->
        </ul>

        
      </div>

      
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0"> Contact <small>US</small></h1>
          </div><!-- /.col -->
          
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-body row">
          <div class="col-5 text-center d-flex align-items-center justify-content-center">
            <div class="row">
            </div>
          </div>


          <div class="col-7">
            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="company-name">Company Name</label>
                  <input type="text" id="company-name" class="form-control" />
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="client-name">Client Name</label>
                  <input type="text" id="client-name" class="form-control" />
                </div>
              </div>

              <div class="col-12">
                <div class="form-group">
                  <label for="client-name">Client Name</label>
                  <input type="text" id="client-name" class="form-control" />
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="online-system">Online System</label>
                  <select id="online-system" class="form-control custom-select">
                      <option selected="" disabled="">Select one</option>
                      <option value="ECC">ECC</option>
                      <option value="CNC">CNC</option>
                      <option value="EIAIS">EIAIS</option>
                      <option value="OPMS">OPMS</option>
                      <option value="CRS">CRS</option>s
                      <option value="CMR">CMR</option>
                      <option value="SMR">SMR</option>
                      <option value="IIS">IIS</option>
                    </select>
                </div>
              </div>

              <div class="col-6">
                <div class="form-group">
                  <label for="e-mail">E-Mail</label>
                  <input type="email" id="e-mail" class="form-control" />
                </div>
              </div>
            </div>
            
            <div class="form-group">
              <label for="subject">Subject</label>
              <input type="text" id="subject" class="form-control" />
            </div>
            <div class="form-group">
              <label for="message">Message</label>
              <textarea id="message" class="form-control" rows="4"></textarea>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" id="btn-send" >Send message <i class="fa-solid fa-paper-plane"></i> </div>
            </div>
          </div>
        </div>
      </div>

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="../../AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../AdminLTE-3.2.0/dist/js/demo.js"></script> -->
<script src="../../AdminLTE-3.2.0/plugins/sweetalert2/sweetalert2.min.js"></script>

      <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
      <script src="https://kit.fontawesome.com/0e706b6aa8.js" crossorigin="anonymous"></script>
<script>

  $(function () {

    $("#btn-send").on('click', function() {

      $.ajax({
        url: "{{route('/send-message')}}",
        type: 'POST',
        data: {
          'company-name': $("#company-name").val(),
          'client-name': $("#client-name").val(),
          'e-mail': $("#e-mail").val(),
          'online-system': $("#online-system").val(),
          'subject': $("#subject").val(),
          'message': $("#message").val(),
          _token: '{{csrf_token()}}',
        },
        beforeSend: function () {

          // $('.loading-overlay').show();
          // $('.loading-overlay-image-container').show();
        },
        complete: function () {

          // $('.loading-overlay').hide();
          // $('.loading-overlay-image-container').hide();

        },
        success: function (response) {

          Swal.fire({
              position: "center",
              icon: "success",
              title: "Sent! We a",
              showConfirmButton: false,
              // timer: 1500,
              // timerProgressBar: true,
              // didOpen: (toast) => {
              //   toast.addEventListener('mouseenter', Swal.stopTimer)
              //   toast.addEventListener('mouseleave', Swal.resumeTimer)
              // },
              // didClose: (toast) => {
              //   location.reload();
              // }
          });
        }

      });
    });

  });

  
</script>

</body>
</html>
