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
  <div class="help-block text-center text-danger">
    You don't have an account login here.
  </div>
  <br>
  <div class="lockscreen-footer text-center">
    Do you want to connect your iis account?
  </div>
  <!-- User name -->
  <div class="lockscreen-name">{{ Session::get('username'); }}</div>
  <!-- START LOCK SCREEN ITEM -->
  <div class="lockscreen-item">
    <button class="btn btn-block btn-flat btn-primary" id="btn-connect">Connect <i class="fa-solid fa-link"></i></button>
    <!-- lockscreen image -->
    <!-- <div class="lockscreen-image">
      <img src="../../AdminLTE-3.2.0/dist/img/user1-128x128.jpg" alt="User Image">
    </div> -->
    <!-- /.lockscreen-image -->

    <!-- lockscreen credentials (contains the form) -->
    <!-- <form class="lockscreen-credentials">
      <div class="input-group">
        <input type="password" class="form-control" placeholder="password">

        <div class="input-group-append">
          <button type="button" class="btn">
            <i class="fas fa-arrow-right text-muted"></i>
          </button>
        </div>
      </div>
    </form> -->
    <!-- /.lockscreen credentials -->

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
  $(function () {
    $("#btn-connect").on('click', function() {
      var username = "{{ Session::get('username') }}";
      var email = "{{ Session::get('email') }}";
      var password = "{{ Session::get('password') }}";
      var id_number = "{{ Session::get('id_number') }}";
      var token = "{{ Session::get('token') }}";

      Swal.fire({
        // title: "Are you sure?",
        text: "You want to connect your IIS to Ticketing System?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes",
        cancelButtonText: "No"
      }).then((result) => {
        if (result.isConfirmed) {

          $.ajax({
            url: "{{route('/create/iis-account')}}",
            type: 'POST',
            data: {
              username: username,
              email: email,
              password: password,
              id_number: id_number,
              iis_token: token,
              _token: '{{csrf_token()}}',
            },
            success: function (response) {
              Swal.fire({
                // title: "Success",
                text: "Account successfully created. Try to relogin your account thru IIS",
                icon: "success"
              });
            }

          });

        }
      });
      
    });
  });

</script>
</body>
</html>
