
@extends('layouts.app')
<style>
    .span #span {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }
</style>
@section('content')
<!-- <div class="container"> -->
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Accounts') }}</div>
                
                <div class="card-body">
                  <a class="btn btn-app bg-success float-right" id="add-user">
                    <!-- <span class="badge bg-purple">891</span> -->
                    <i class="fas fa-users"></i> Add User
                  </a>
                    <table class="table" id="user-list">
                        <thead>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Email</th>
                            <th>Last Activity</th>
                            <th>Status</th>
                            <th>Action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->

<div class="modal fade" id="modal-add-account">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
            Add User
          </h4>
      </div>
      <div class="modal-body">
        <div class="card-body">
          <input id="user-id" value="0" hidden />

            <div class="row mb-3">
              <label for="first_name" class="col-md-4 col-form-label text-md-end">First Name</label>

              <div class="col-md-6">
                <input id="first_name" type="text" class="form-control" name="first_name" required autocomplete="first_name" autofocus>
                <p class="text-danger" id="error-first-name" hidden></p>
              </div>
            </div>

            <div class="row mb-3">
              <label for="middle_name" class="col-md-4 col-form-label text-md-end">Middle Name</label>

              <div class="col-md-6">
                <input id="middle_name" type="text" class="form-control" name="middle_name" required autocomplete="middle_name" autofocus>
                <p class="text-danger" id="error-middle-name" hidden></p>
              </div>
            </div>

            <div class="row mb-3">
              <label for="last_name" class="col-md-4 col-form-label text-md-end">Last Name</label>

              <div class="col-md-6">
                <input id="last_name" type="text" class="form-control" name="last_name" required autocomplete="last_name" autofocus>
                <p class="text-danger" id="error-last-name" hidden></p>
              </div>
            </div>

            <div class="row mb-3">
              <label for="email" class="col-md-4 col-form-label text-md-end">Email Address</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control" name="email" required autocomplete="email">
                <p class="text-danger" id="error-email" hidden></p>
              </div>
            </div>

            <div class="row mb-3">
              <label for="email" class="col-md-4 col-form-label text-md-end">User Type</label>

              <div class="col-md-6">
                <select id="user-type" class="form-control custom-select">
                  <option selected="" disabled="">Select one</option>
                  <option value="1">Support</option>
                  <option value="2">Admin</option>
                </select>
              </div>
            </div>

            <div class="row mb-3">
              <label for="email" class="col-md-4 col-form-label text-md-end">Status</label>

              <div class="col-md-6">
                <select id="user-status" class="form-control custom-select">
                  <option selected="" disabled="">Select one</option>
                  <option value="1">Active</option>
                  <option value="2">Deactivate</option>
                </select>
              </div>
            </div>

            <div class="row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="button" class="btn btn-primary" id="btn-add-user">Register</button>
                <!-- <button type="button" class="btn btn-primary" id="btn-edit-user" hidden>Edit</button> -->
              </div>
            </div>

        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal-account">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <i>
          <h2 class="modal-title">
            <label id="account-name"></label>
          </h2>
        </i>
      </div>
      <div class="modal-body">

        <div class="card-body">
            <!-- <div class="card"> -->
                <!-- <div class="card-body row"> -->
                  <div class="col-12">
                    <div class="row">

                      <table class="table" >
                          <thead>
                              <th>Name</th>
                              <th>Email</th>
                              <th>User Type</th>
                              <th>ECC</th>
                              <th>CNC</th>
                              <th>EIAIS</th>
                              <th>OPMS</th>
                              <th>CRS</th>
                              <th>SMR</th>
                              <th>CMR</th>
                              <th>IIS</th>
                              <th>HAZWASTE</th>
                          </thead>
                          <tbody id="account-body">
                          </tbody>
                      </table>

                    </div>

                  </div>
                <!-- </div> -->
              <!-- </div> -->

        </div>
      </div>
    </div>
  </div>
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


<script>
    $(function () {

      $("#btn-add-user").on('click', function() {
        var first_name = $("#first_name").val();
        var middle_name = $("#middle_name").val();
        var last_name = $("#last_name").val();
        var email = $("#email").val();
        var user_type = $("#user-type").val();
        var user_id = $("#user-id").val();
        var user_status = $("#user-status").val();

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
                user_type : user_type,
                user_id : user_id,
                user_status : user_status,
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
        
        var table = $('#user-list').DataTable({
          destroy: true,
          processing: true,
          info: true,
          ordering: false,
          // scrollY: 800,
          deferRender: false,
          scroller: false,
          searching: true,
          bLengthChange: true,
          paging: true,
          serverSide: true,
          ajax: {
            "url": "{{route('/get-user-list')}}",
            "type": "POST",
            "data": {
              _token: '{{csrf_token()}}',
            },
          },
          columns: [
          {
            data: 'name',
            name: 'name',
          },
          {
            data: 'user_type',
            name: 'user_type',
          },
          {
            data: 'email',
            name: 'email',
          },
          {
            data: 'last_activity',
            name: 'last_activity',
          },
          {
            data: 'status',
            name: 'status',
          },
          {
            data: 'action',
            name: 'action',
          },
          ]
        });

        $("#add-user").on('click', function() {

          $("#first_name").val('');
          $("#middle_name").val('');
          $("#last_name").val('');
          $("#email").val('');
          $("#user-type").val('');
          $("#user-staus").val('');
              
          $("#modal-add-account").modal();
          $("#btn-add-user").html('Register');
          $("#user-id").val(0);


          $("#modal-add-account").modal();
        });


    })

    function viewAccount(id) {

        $.ajax({
            url: "{{route('/get-acount')}}",
            type: 'POST',
            data: {
                id : id,
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

              if(result['type'] == 1) {
                var type = 'support';
              } else if(result['type'] == 2) {
                var type = 'admin';
              }

              if(result['ecc'] == 1) {var ecc = 'checked';} else {var ecc = '';}
              if(result['cnc'] == 1) {var cnc = 'checked';} else {var cnc = '';}
              if(result['eiais'] == 1) {var eiais = 'checked';} else {var eiais = '';}
              if(result['opms'] == 1) {var opms = 'checked';} else {var opms = '';}
              if(result['crs'] == 1) {var crs = 'checked';} else {var crs = '';}
              if(result['smr'] == 1) {var smr = 'checked';} else {var smr = '';}
              if(result['cmr'] == 1) {var cmr = 'checked';} else {var cmr = '';}
              if(result['iis'] == 1) {var iis = 'checked';} else {var iis = '';}
              if(result['hazwaste'] == 1) {var hazwaste = 'checked';} else {var hazwaste = '';}


              $("#account-body").html(`
                <td>`+result['name']+`</td>
                <td>`+result['email']+`</td>
                <td>`+type+`</td>
                <td>
                  <div class="icheck-primary d-inline">
                      <input type="checkbox" id="ecc" name="ecc" onclick="checkbox('ecc', '`+id+`')" `+ecc+`>
                      <label for="ecc">
                      </label>
                  </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                      <input type="checkbox" id="cnc" name="cnc" onclick="checkbox('cnc', '`+id+`')" `+cnc+`>
                      <label for="cnc">
                      </label>
                    </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                      <input type="checkbox" id="eiais" name="eiais" onclick="checkbox('eiais', '`+id+`')" `+eiais+`>
                      <label for="eiais">
                      </label>
                    </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                      <input type="checkbox" id="opms" name="opms" onclick="checkbox('opms', '`+id+`')" `+opms+`>
                      <label for="opms">
                      </label>
                    </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                      <input type="checkbox" id="crs" name="crs" onclick="checkbox('crs', '`+id+`')" `+crs+`>
                      <label for="crs">
                      </label>
                    </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                      <input type="checkbox" id="smr" name="smr" onclick="checkbox('smr', '`+id+`')" `+smr+`>
                      <label for="smr">
                      </label>
                    </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                      <input type="checkbox" id="cmr" name="cmr" onclick="checkbox('cmr', '`+id+`')" `+cmr+`>
                      <label for="cmr">
                      </label>
                    </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                      <input type="checkbox" id="iis" name="iis" onclick="checkbox('iis', '`+id+`')" `+iis+`>
                      <label for="iis">
                      </label>
                    </div>
                </td>
                <td>
                  <div class="icheck-primary d-inline">
                      <input type="checkbox" id="hazwaste" name="hazwaste" onclick="checkbox('hazwaste', '`+id+`')" `+hazwaste+`>
                      <label for="hazwaste">
                      </label>
                    </div>
                </td>
                
              `)

            }

        });

        $("#modal-account").modal();
    }


    function checkbox(type, id) {
      // alert(type + id); 

      var x = $("input[type='checkbox'][name='"+type+"'").is(':checked');
      if (x) {
          var value = 1;
          // alert("Is checked");
        } else {
          var value = 0;
          // alert("Is not checked");
        }

      $.ajax({
            url: "{{route('/update-system')}}",
            type: 'POST',
            data: {
              type : type,
              id : id,
              value : value,
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

              Swal.fire({
                position: "center",
                icon: "success",
                title: "success",
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
                didOpen: (toast) => {
                  toast.addEventListener('mouseenter', Swal.stopTimer)
                  toast.addEventListener('mouseleave', Swal.resumeTimer)
                },
                didClose: (toast) => {
                  // location.reload();
                }
            });

            }

        });
    }

    function editAccount(id) {
      $.ajax({
            url: "{{route('/get-acount')}}",
            type: 'POST',
            data: {
                id : id,
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

              $("#first_name").val(result['first_name']);
              $("#middle_name").val(result['middle_name']);
              $("#last_name").val(result['last_name']);
              $("#email").val(result['email']);
              $("#user-type").val(result['type']);

              $("#user-status").val(result['active']);
              
              $("#modal-add-account").modal();
              $("#btn-add-user").html('Save');
              $("#user-id").val(id);
            }

        });
    }

    function resetPassword(id) {

      Swal.fire({
        html: "Do you want to reset this password into default password: <b>0123456789*</b>?",
        showDenyButton: true,
        showCancelButton: false,
        confirmButtonText: "Yes",
        denyButtonText: `No`
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          $.ajax({
            url: "{{route('/reset-password')}}",
            type: 'POST',
            data: {
                id : id,
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
                Swal.fire("Successfully reset your password", "", "info");
            }

        });
        } else if (result.isDenied) {
          
      }
    });

      

    }
</script>