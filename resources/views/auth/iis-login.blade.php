<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EMB | Ticketing</title>

  <link rel="icon" href="../../AdminLTE-3.2.0/dist/img/denr-emb-logo.gif">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/dist/css/adminlte.min.css">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="lockscreen-wrapper">
  <div class="lockscreen-logo">
    <a href="../../AdminLTE-3.2.0/index2.html"><b>EMB</b>IIS</a>
  </div>

  <!-- /.lockscreen-item -->
  
  <br>
 
  <!-- User name -->
  <div class="lockscreen-name">{{ Session::get('username'); }}</div>
  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <!-- <button class="btn btn-block btn-flat btn-primary" id="btn-connect">Connect <i class="fa-solid fa-link"></i></button> -->
    <!-- lockscreen image -->
    <div class="lockscreen-image">
      <img src="../../AdminLTE-3.2.0/dist/img/denr-emb-logo.gif" alt="User Image">
    </div>
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <form class="lockscreen-credentials" method="POST" action="{{ route('/login/iis-account') }}">
      @csrf
      <div class="input-group">
        <input type="password" class="form-control" placeholder="password" id="password" name="password">

        <div class="input-group-append">
          <button type="button" class="btn" id="btn-login">
            <i class="fas fa-arrow-right text-muted"></i>
          </button>
        </div>
      </div>
    </form>
    <!-- /.lockscreen credentials -->

  </div>
  <div class="lockscreen-footer text-center">
    Enter your password to start your session
  </div>
  
</div>
<!-- /.center -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- jQuery -->
<script src="../../AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/0e706b6aa8.js" crossorigin="anonymous"></script>
<script>
  // $(function () {
  //   $("#btn-login").on('click', function() {
  //     var username = "{{ Session::get('username') }}";
  //     var email = "{{ Session::get('email') }}";
  //     var password = $("#password").val();
  //     var id_number = "{{ Session::get('id_number') }}";
  //     var token = "{{ Session::get('token') }}";

  //     $.ajax({
  //           url: "{{route('/login/iis-account')}}",
  //           type: 'POST',
  //           data: {
  //             username: username,
  //             email: email,
  //             password: password,
  //             id_number: id_number,
  //             iis_token: token,
  //             _token: '{{csrf_token()}}',
  //           },
  //           success: function (response) {

  //           }

  //         });
      
  //   });
  // });

</script>
</body>
</html>
