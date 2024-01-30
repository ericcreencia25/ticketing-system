<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>EMB | Support Service Ticketing System</title>

  <link rel="icon" href="../../AdminLTE-3.2.0/dist/img/denr-emb-logo.gif">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/dropzone/min/dropzone.min.css">

  {!! ReCaptcha::htmlScriptTagJsApi()!!}
</head>
<style>
  .contact {
    padding: 50px 0;
  }

  .contact .heading h2 {
      font-size: 30px;
      font-weight: 700;
      margin: 0;
      padding: 0;

  }

  .contact .heading h2 span {
      color: #ff9100;
  }

  .contact .heading p {
      font-size: 15px;
      font-weight: 400;
      line-height: 1.7;
      color: #999999;
      margin: 20px 0 60px;
      padding: 0;
  }

  .contact .form-control {
/*      padding: 25px;*/
/*      font-size: 13px;*/
      margin-bottom: 20px;
      background: #f9f9f9;
      border: 0;
      border-radius: 10px;
  }

  .contact button.btn {
      padding: 10px;
      border-radius: 10px;
      font-size: 15px;
      background: #ff9100;
      color: #ffffff;
  }

  .contact .title h3 {
      font-size: 24px;
      font-weight: 600;
  }

  .contact .title p {
      font-size: 14px;
      font-weight: 400;
      color: #999;
      line-height: 1.6;
      margin: 0 0 40px;
  }

  .contact .content .info {
      margin-top: 30px;
  }
  .contact .content .info i {
      font-size: 30px;
      padding: 0;
      margin: 0;
      color: #02434b;
      margin-right: 20px;
      text-align: center;
      width: 20px;
  }
  .contact .content .info h4 {
      font-size: 13px;
      line-height: 1.4;
  }

  .contact .content .info h4 span {
      font-size: 13px;
      font-weight: 300;
      color: #999999;
  }
</style>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light bg-orange">
    <div class="container">
      <a href="../../AdminLTE-3.2.0/index3.html" class="navbar-brand">
        <img src="../../AdminLTE-3.2.0/dist/img/emb-logo.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-light">Support Service Ticketing System | </span>
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
    <!-- /.content-header -->

    <!-- Main content -->
      <section class="contact" id="contact">
        <div class="container">
            <div class="heading text-center">
                <h2>Contact <span> Us </span></h2>
                <br>
                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                    <br>incididunt ut labore et dolore magna aliqua.</p> -->
            </div>
            <div class="row">
                <div class="col-md-5">
                    <div class="title">
                        <h3>Let's get in touch</h3>
                        <p>Please feel free to contact us</p>
                    </div>
                    <div class="content">
                        <!-- Info-1 -->
                        <div class="info">
                            <i class="fas fa-phone-alt"></i>
                            <h4 class="d-inline-block">PHONE :
                              <br>
                                <span>(02) 8539-4378 loc. 121</span></h4>
                        </div>
                        <!-- Info-2 -->
                        <div class="info">
                            <i class="far fa-envelope"></i>
                            <h4 class="d-inline-block">EMAIL :
                                <br>
                                <span>support@emb.gov.ph</span></h4>
                        </div>
                        <!-- Info-3 -->
                        <div class="info">
                            <i class="fas fa-map-marker-alt"></i>
                            <h4 class="d-inline-block">ADDRESS :<br>
                                <span>DENR Compound, Visayas Ave.,Diliman, Quezon City</span></h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-7">
                  <div class="card">
                    @if(session()->get('success'))
                    <div class="alert alert-success alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa fa-check"></i> Sent!</h4>
                      We've already sent you an email. You will find the ticket number inside the email. Thank you!
                      <br>
                    </div>
                    @endif

                    <div class="card-body">
                      <form class="form-horizontal" method="POST" action="{{ route('/send-message') }}">
                        @csrf
                          <div class="row">
                              <div class="col-sm-6">
                                 <label for="company-name">Company Name</label>
                                  <!-- <span class="text-danger" id="company-name-error" hidden></span> -->
                                  @error('company-name')
                                    <p class="text-red">{{ $message }}</p>
                                  @enderror
                                  <input type="text" id="company-name" name="company-name" class="form-control" required />
                              </div>
                              <div class="col-sm-6">
                                  <label for="client-name">Client Name</label>
                                  <!-- <span class="text-danger" id="client-name-error" hidden></span> -->
                                  @error('client-name')
                                    <p class="text-red">{{ $message }}</p>
                                  @enderror
                                  <input type="text" id="client-name" name="client-name" class="form-control" required />
                              </div>

                              <div class="col-6">
                                  <label for="online-system">Online System</label>
                                  <!-- <span class="text-danger" id="online-system-error" hidden></span> -->
                                  @error('online-system')
                                    <p class="text-red">{{ $message }}</p>
                                  @enderror
                                  <select id="online-system" name="online-system"  class="form-control custom-select" required>
                                      <option selected="" disabled="" value="">Select one</option>
                                      <option value="ECC">ECC</option>
                                      <option value="CNC">CNC</option>
                                      <option value="EIAIS">EIAIS</option>
                                      <option value="OPMS">OPMS</option>
                                      <option value="CRS">CRS</option>s
                                      <option value="CMR">CMR</option>
                                      <option value="SMR">SMR</option>
                                      <option value="IIS">IIS</option>
                                      <option value="HAZWASTE">HAZWASTE</option>
                                  </select>
                              </div>

                              <div class="col-6">
                                  <label for="e-mail">Email</label>
                                  <!-- <span class="text-danger" id="e-mail-error" hidden></span> -->
                                  @error('e-mail')
                                    <p class="text-red">{{ $message }}</p>
                                  @enderror
                                  <input type="email" id="e-mail" name="e-mail" class="form-control" required/>
                              </div>

                              <div class="col-12">
                                  <label for="subject">Subject</label>
                                  <!-- <span class="text-danger" id="subject-error" hidden></span> -->
                                  @error('subject')
                                    <p class="text-red">{{ $message }}</p>
                                  @enderror
                                  <input type="text" id="subject" name="subject" class="form-control" required/>
                              </div>

                              <div class="col-12">
                                <label for="subject">Message</label>
                                <!-- <span class="text-danger" id="message-error" hidden></span> -->
                                @error('message')
                                    <p class="text-red">{{ $message }}</p>
                                  @enderror
                                <textarea class="form-control" rows="5" id="message" name="message" required></textarea>
                              </div>

                              <div class="col-12">
                                {!! NoCaptcha::renderJs() !!}
                                {!! NoCaptcha::display() !!}

                                @error('g-recaptcha-response')
                                  <p class="text-red">{{ $message }}</p>
                                @enderror
                              </div>

                              <!-- <div class="col-12">
                                <div id="actions" class="row">
                                  <div class="col-lg-6">
                                    <div class="btn-group w-100">
                                      <span class="btn btn-success col fileinput-button">
                                        <i class="fas fa-plus"></i>
                                        <span>Add files</span>
                                      </span>
                                      <button type="button" class="btn btn-primary col start">
                                        <i class="fas fa-upload"></i>
                                        <span>Start upload</span>
                                      </button>
                                      <button type="reset" class="btn btn-warning col cancel">
                                        <i class="fas fa-times-circle"></i>
                                        <span>Cancel upload</span>
                                      </button>
                                    </div>
                                  </div>
                                  <div class="col-lg-6 d-flex align-items-center">
                                    <div class="fileupload-process w-100">
                                      <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                        <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <div class="table table-striped files" id="previews">
                                  <div id="template" class="row mt-2">
                                    <div class="col-auto">
                                        <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
                                    </div>
                                    <div class="col d-flex align-items-center">
                                        <p class="mb-0">
                                          <span class="lead" data-dz-name></span>
                                          (<span data-dz-size></span>)
                                        </p>
                                        <strong class="error text-danger" data-dz-errormessage></strong>
                                    </div>
                                    <div class="col-4 d-flex align-items-center">
                                        <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                                          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                                        </div>
                                    </div>
                                    <div class="col-auto d-flex align-items-center">
                                      <div class="btn-group">
                                        <button class="btn btn-primary start">
                                          <i class="fas fa-upload"></i>
                                          <span>Start</span>
                                        </button>
                                        <button data-dz-remove class="btn btn-warning cancel">
                                          <i class="fas fa-times-circle"></i>
                                          <span>Cancel</span>
                                        </button>
                                        <button data-dz-remove class="btn btn-danger delete">
                                          <i class="fas fa-trash"></i>
                                          <span>Delete</span>
                                        </button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div> -->
                          </div>
                          <button class="btn btn-block" type="submit" id="btn-send" >Send Now <i class="fa-solid fa-paper-plane"></i></button>
                        </form>
                          
                    </div>
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
<!-- dropzonejs -->
<script src="../../AdminLTE-3.2.0/plugins/dropzone/min/dropzone.min.js"></script>


<script src="https://www.google.com/recaptcha/api.js?render=6LdFlVopAAAAAGsNwyWp54ML8GK46Yrg1VbUtMs3" async defer></script>

<script>

  $(function () {

    // $("#btn-send").on('click', function() {

    //   const arr = [];

    //   if($("#company-name").val() == ''){
    //     arr.push("Company Name");
    //     $("#company-name-error").removeAttr('hidden');
    //     $("#company-name-error").text('*this field is required');
    //   } else {
    //     $("#company-name-error").attr('hidden', 'hidden');
    //   }

    //   if($("#client-name").val() == ''){
    //     arr.push("Client Name");
    //     $("#client-name-error").removeAttr('hidden');
    //     $("#client-name-error").text('*this field is required');
    //   } else {
    //     $("#client-name-error").attr('hidden', 'hidden');
    //   }

    //   if($("#e-mail").val() == ''){
    //     arr.push("Email");
    //     $("#e-mail-error").removeAttr('hidden');
    //     $("#e-mail-error").text('*this field is required');
    //   } else {
    //     $("#e-mail-error").attr('hidden', 'hidden');
    //   }

    //   if($("#online-system").val() == '' || $("#online-system").val() == null){
    //     arr.push("Online System");
    //     $("#online-system-error").removeAttr('hidden');
    //     $("#online-system-error").text('*this field is required');
    //   } else {
    //     $("#online-system-error").attr('hidden', 'hidden');
    //   }

    //   if($("#subject").val() == ''){
    //     arr.push("Subject");
    //     $("#subject-error").removeAttr('hidden');
    //     $("#subject-error").text('*this field is required');
    //   } else {
    //     $("#subject-error").attr('hidden', 'hidden');
    //   }

    //   if($("#message").val() == ''){
    //     arr.push("Message");
    //     $("#message-error").removeAttr('hidden');
    //     $("#message-error").text('*this field is required');
    //   } else {
    //     $("#message-error").attr('hidden', 'hidden');
    //   }

    //   console.log($("#online-system").val());

    //   if(arr.length == 0) {

    //     $.ajax({
    //       url: "{{route('/send-message')}}",
    //       type: 'POST',
    //       data: {
    //         'company-name': $("#company-name").val(),
    //         'client-name': $("#client-name").val(),
    //         'e-mail': $("#e-mail").val(),
    //         'online-system': $("#online-system").val(),
    //         'subject': $("#subject").val(),
    //         'message': $("#message").val(),
    //         _token: '{{csrf_token()}}',
    //       },
    //       beforeSend: function () {

    //         // $('.loading-overlay').show();
    //         // $('.loading-overlay-image-container').show();
    //       },
    //       complete: function () {

    //         // $('.loading-overlay').hide();
    //         // $('.loading-overlay-image-container').hide();

    //       },
    //       success: function (response) {

    //         Swal.fire({
    //             position: "center",
    //             icon: "success",
    //             title: "Sent! We've already sent you an email. You will find the ticket number inside the email. Thank you",
    //             showConfirmButton: false,
    //             timer: 5500,
    //             timerProgressBar: true,
    //             didOpen: (toast) => {
    //               toast.addEventListener('mouseenter', Swal.stopTimer)
    //               toast.addEventListener('mouseleave', Swal.resumeTimer)
    //             },
    //             didClose: (toast) => {
    //               location.reload();
    //             }
    //         });
    //       }

    //     });

    //   }

      
    // });

  });

  // DropzoneJS Demo Code Start
  Dropzone.autoDiscover = false

  // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
  var previewNode = document.querySelector("#template")
  previewNode.id = ""
  var previewTemplate = previewNode.parentNode.innerHTML
  previewNode.parentNode.removeChild(previewNode)

  var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
    url: "{{route('/upload-file')}}", // Set the url
    thumbnailWidth: 80,
    thumbnailHeight: 80,
    parallelUploads: 20,
    previewTemplate: previewTemplate,
    autoQueue: false, // Make sure the files aren't queued until manually added
    previewsContainer: "#previews", // Define the container to display the previews
    clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
  })

  myDropzone.on("addedfile", function(file) {
    // Hookup the start button
    file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
  })

  // Update the total progress bar
  myDropzone.on("totaluploadprogress", function(progress) {
    document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
  })

  myDropzone.on("sending", function(file, xhr, formData) {
    formData.append('company-name', $("#company-name").val());
    formData.append('client-name', $("#client-name").val());
    // Show the total progress bar when upload starts
    document.querySelector("#total-progress").style.opacity = "1"
    // And disable the start button
    file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
  })

  // Hide the total progress bar when nothing's uploading anymore
  myDropzone.on("queuecomplete", function(progress) {
    document.querySelector("#total-progress").style.opacity = "0"
  })

  // Setup the buttons for all transfers
  // The "add files" button doesn't need to be setup because the config
  // `clickable` has already been specified.
  document.querySelector("#actions .start").onclick = function() {
    myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
  }
  document.querySelector("#actions .cancel").onclick = function() {
    myDropzone.removeAllFiles(true)
  }
  // DropzoneJS Demo Code End

  
</script>

</body>
</html>
