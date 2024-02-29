
@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
  <!-- /.col -->
  <div class="col-md-10">
    <div class="card">
      <div class="card-header p-2">
        <ul class="nav nav-pills">
          <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Settings</a></li>
          <li class="nav-item"><a class="nav-link" href="#change-password" data-toggle="tab">Password</a></li>
          <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li>
        </ul>
      </div><!-- /.card-header -->
      <div class="card-body">
        <div class="tab-content">
          <!-- /.tab-pane -->
          <div class="tab-pane" id="timeline">
            <!-- The timeline -->
            <div class="timeline" id="timeline-data">
            </div>
          </div>
          <!-- /.tab-pane -->

          <div class="tab-pane" id="change-password">
            <form class="form-horizontal">
              <div class="form-group row">
                <label for="inputName" class="col-sm-2 col-form-label">Old Password</label>
                <div class="col-sm-10">
                          <input type="password" class="form-control" id="old_password" />
                        <span class="text-danger" id="old-password-error" hidden></span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">New Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="new_password" />
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Confirm New Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" id="confirm_new_password" />
                          <span class="text-danger" id="new-password-error" hidden></span>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="button" class="btn btn-success" id="change-password-btn">Save</button>
                        </div>
                      </div>
                    </form>
                  </div>



                  <div class="active tab-pane" id="settings">
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="first_name" placeholder="First Name" value="{{ Auth::user()->first_name }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Middle Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="middle_name" placeholder="Middle Name" value="{{ Auth::user()->middle_name }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="last_name" placeholder="Last Name" value="{{ Auth::user()->last_name }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="email" placeholder="Email" value="{{ Auth::user()->email }}">
                        </div>
                      </div><div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">EMB ID</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="emb-id" placeholder="EMB ID" value="{{ Auth::user()->id_number }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="button" class="btn btn-success" id="btn-save">Save</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>

@endsection
<script src="../../AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>

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
<script src="https://momentjs.com/downloads/moment.js"></script>


<script>
    $(function () {

      $("#change-password-btn").on('click', function() {

        var old_password = $("#old_password").val();
        var new_password = $("#new_password").val();
        var confirm_password = $("#confirm_new_password").val();

        if(new_password.length > 7) {

          if(new_password != confirm_password) {
            $("#new-password-error").html("password doesn't match");
            $("#new-password-error").removeAttr('hidden');
          } else {
            $("#new-password-error").attr('hidden', 'hidden');

            $.ajax({
              url: "{{route('/change-password')}}",
              type: 'POST',
              data: {
                old_password : old_password,
                new_password : new_password,
                confirm_password : confirm_password,
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

                if(result == "old password doesn't match") {

                  

                  $("#old-password-error").html("old password doesn't match");
                  $("#old-password-error").removeAttr('hidden');

                } else {

                  $("#old-password-error").attr('hidden', 'hidden');

                  Swal.fire({
                      position: "center",
                      icon: "success",
                      title: "successfully changed your password",
                      showConfirmButton: false,
                      timer: 1500,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      },
                      didClose: (toast) => {
                        location.reload();
                      }
                  });
                }

                

              }

          });

          }

        } else {
          $("#new-password-error").html("password must at least 8 characters");
          $("#new-password-error").removeAttr('hidden');
        }

      })

      $("#btn-save").on('click', function() {
        var first_name = $("#first_name").val();
        var middle_name = $("#middle_name").val();
        var last_name = $("#last_name").val();
        var email = $("#email").val();
        var user_id = '{{ Auth::user()->id }}';
        var emb_id = $("#emb-id").val();

        if('{{ Auth::user()->type }}' == 'admin'){
          user_type = 1;
        } else {
          user_type = 2;
        }

        Swal.fire({
          title: "Do you want to save the changes?",
          showDenyButton: true,
          showCancelButton: false,
          confirmButtonText: "Yes",
          denyButtonText: `No`
        }).then((result) => {
          /* Read more about isConfirmed, isDenied below */
          if (result.isConfirmed) {
            $.ajax({
              url: "{{route('/add-user')}}",
              type: 'POST',
              data: {
                first_name : first_name,
                middle_name : middle_name,
                last_name : last_name,
                email : email,
                user_id : user_id,
                user_type : user_type,
                emb_id : emb_id,
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

                if(result == 'Existing Email') {

                  Swal.fire({
                      position: "center",
                      icon: "error",
                      title: "Existing Email",
                      showConfirmButton: false,
                      timer: 1500,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      },
                      didClose: (toast) => {
                        // location.reload();
                      }
                  });

                } else {

                  Swal.fire({
                      position: "center",
                      icon: "success",
                      title: "success",
                      showConfirmButton: false,
                      timer: 1500,
                      timerProgressBar: true,
                      didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                      },
                      didClose: (toast) => {
                        location.reload();
                      }
                  });
                }

                

              }

          });
          } else if (result.isDenied) {
            Swal.fire("Changes are not saved", "", "info");
          }
        });

      
      });


      $.ajax({
            url: "{{route('/get-timeline')}}",
            type: 'POST',
            data: {
              user_id : "{{Auth::user()->id}}",
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
                $.each(result, function (index, value) {

                  $("#timeline-data").append(
                    `<!-- timeline time label -->
                    <div class="time-label">
                      <span class="bg-yellow">`+value['date']+`</span>
                    </div>
                    <!-- /.timeline-label -->`
                    );

                  $.each(value['data'], function (index, value1) {

                  console.log(value1['time']);

                    if(value1['user_type'] == 0 ) {
                      var timeline = `<!-- timeline item -->
                          <div>
                            <i class="fas fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                              <span class="time"><i class="fas fa-clock"></i> `+value1['time']+`</span>
                              <h3 class="timeline-header"><a href="#">`+value1['name']+`</a> sent you a message</h3>

                              <div class="timeline-body">Here is the ticket number: <b>`+value1['ticket_number']+`</b></div>
                              <div class="timeline-footer">
                                <a class="btn btn-primary btn-sm">Read more</a>
                              </div>
                            </div>
                          </div>
                          <!-- END timeline item -->`;
                    } else if(value1['user_type'] == 1 ) {
                      var timeline = `<!-- timeline item -->
                          <div>
                            <i class="fas fa-envelope bg-green"></i>
                            <div class="timeline-item">
                              <span class="time"><i class="fas fa-clock"></i> `+value1['time']+`</span>
                              <h3 class="timeline-header"><a href="#">`+value1['name']+`</a> `+value1['function']+`</h3>

                              <div class="timeline-body">
                                `+value1['action']+` concern with a ticket number: <b>`+ value1['ticket_number'] +`</b>
                              </div>
                            </div>
                          </div>
                          <!-- END timeline item -->`;
                    }  else {
                      var timeline = `<!-- timeline item -->
                          <div>
                            <i class="fas fa-user bg-green"></i>
                            <div class="timeline-item">
                              <span class="time"><i class="fas fa-clock"></i> `+value1['time']+`</span>
                              <h3 class="timeline-header"><a href="#">`+value1['name']+`</a> `+value1['function']+`</h3>

                              <div class="timeline-body">
                                `+value1['action']+`
                              </div>
                            </div>
                          </div>
                          <!-- END timeline item -->`;
                    }

                    $("#timeline-data").append(timeline);

                  });

                  

                    
                });

                $("#timeline-data").append(`<div>
                            <i class="fas fa-clock bg-gray"></i>
                          </div>`);

                // timeline-data

            }

        });
    })

</script>