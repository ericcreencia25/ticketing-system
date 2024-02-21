
@extends('layouts.app')
<style>
    .span #span {
      overflow: hidden;
      text-overflow: ellipsis;
      white-space: nowrap;
    }
</style>
<link rel="stylesheet" href="../../AdminLTE-3.2.0/dist/css/bootstrap-side-modals.css">
@section('content')
<!-- <div class="container"> -->
    <div class="row">
        <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
                <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">PENDING</span>
                    <span class="info-box-number text-center text-muted mb-0" id="pending-span">999</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
                <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">PROCESSING</span>
                    <span class="info-box-number text-center text-muted mb-0" id="processing-span">999</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
                <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">RESOLVED</span>
                    <span class="info-box-number text-center text-muted mb-0" id="resolved-span">999</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
                <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">TOTAL</span>
                    <span class="info-box-number text-center text-muted mb-0" id="tot-span">999</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Ticket Management') }}</div>
    
                <div class="card-body">
                    <table class="table" id="concern-list">
                        <thead>
                            <th>Ticket No.</th>
                            <th>Company Name</th>
                            <th>Client Name</th>
                            <th>Email</th>
                            <th>System</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action taken</th>
                            <th>Resolved Date</th>
                            <th>Action</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->

<!-- <div class="modal fade" id="modal-view-ticket">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <i>
            <h4 class="modal-title" id="ticket-number">
            </h4>
        </i>
        
        <span class="time"><i class="fas fa-clock"></i> <small id="date-submitted"></small></span>
      </div>
      <div class="modal-body">

        <div class="card-body">
                    <input id="ticket-id" hidden />
                  <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <small>
                                    <label for="company-name">Company Name</label>
                                    <input type="text" id="company-name" class="form-control" style="background: white;" readonly />
                                </small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <small>
                                    <label for="client-name">Client Name</label>
                                    <input type="text" id="client-name" class="form-control" style="background: white;" readonly/>
                                </small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <small>
                                    <label for="e-mail">E-Mail</label>
                                    <input type="email" id="e-mail" class="form-control" style="background: white;" readonly />
                                </small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <small>
                                    <label for="online-system">Online System</label>
                                    <input type="email" id="online-system" class="form-control" style="background: white;" readonly />
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <small>
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" class="form-control" style="background: white;" readonly />
                        </small>
                    </div>
                    <div class="form-group">
                        <small>
                            <label for="message">Message</label>
                            <textarea id="message" class="form-control" rows="4" style="height: 300px; background: white;" readonly></textarea>
                        </small>
                    </div>
                    <div class="form-group">
                        <small>
                            <label for="message">Action taken</label>
                            <textarea id="action-taken" class="form-control" rows="4" style="height: 300px; background: white;"></textarea>
                        </small>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-warning" id="btn-resolve">Submit <i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                  </div>

        </div>
      </div>
    </div>
  </div>
</div> -->

<div class="modal modal-right fade" id="right_modal_lg" tabindex="-1" role="dialog" aria-labelledby="right_modal_lg">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <i>
                    <h5 class="modal-title" id="ticket-number">
                    </h5>
                    <span id="badge-status-ticket"></span>
                </i>
                <span class="time"><i class="fas fa-clock"></i> <small id="date-submitted"></small></span>
            </div>
            <div class="modal-body">
                <input id="ticket-id" hidden />
                <div class="card-header p-2">
                    <ul class="nav nav-pills">
                        <li class="nav-item"><a class="nav-link active" href="#action" data-toggle="tab">Action</a></li>
                        <li class="nav-item"><a class="nav-link" href="#history" data-toggle="tab">History</a></li>
                    </ul>
                </div><!-- /.card-header -->

                <div class="card-body">
                    <div class="tab-content">
                        <!-- /.tab-pane -->
                        <div class="tab-pane" id="history">
                            <table class="table table-bordered" id="history-list">
                                <thead>
                                    <th>Ticket Number</th>
                                    <th>Status</th>
                                    <th>Remarks</th>
                                    <th>Date</th>
                                </thead>
                                <tbody id="history-list-body">
                                </tbody>
                            </table>
                        </div>
                        <!-- /.tab-pane -->

                        <!-- ACTION -->
                        <div class="active tab-pane" id="action">

                            <div class="col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <small>
                                                <label for="company-name">Company Name</label>
                                                <input type="text" id="company-name" class="form-control" style="background: white;" readonly />
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <small>
                                                <label for="client-name">Client Name</label>
                                                <input type="text" id="client-name" class="form-control" style="background: white;" readonly/>
                                            </small>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <small>
                                                <label for="e-mail">E-Mail</label>
                                                <input type="email" id="e-mail" class="form-control" style="background: white;" readonly />
                                            </small>
                                        </div>
                                        </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <small>
                                                <label for="online-system">Online System</label>
                                                <input type="email" id="online-system" class="form-control" style="background: white;" readonly />
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <small>
                                        <label for="subject">Subject</label>
                                        <input type="text" id="subject" class="form-control" style="background: white;" readonly />
                                    </small>
                                </div>
                                <div class="form-group">
                                    <small>
                                        <label for="message">Message</label>
                                        <textarea id="message" class="form-control" rows="4" style="height: 300px; background: white;" readonly></textarea>
                                    </small>
                                </div>
                                <div class="form-group">
                                    <small>
                                        <label for="message">Status</label>
                                        <select id="status" name="status"  class="form-control custom-select" required>
                                          <option selected="" value="" disabled>Select one</option>
                                          <option value="0">Pending</option>
                                          <option value="1">Processing</option>
                                          <option value="2">Resolved</option>
                                        </select>
                                    </small>
                                    
                                </div>
                                <div class="form-group" id="remarks-div" hidden>
                                    <small>
                                        <label for="message">Remarks/Action Taken</label>
                                        <textarea id="action-taken" class="form-control" rows="4" style="height: 300px; background: white;"></textarea>
                                    </small>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-warning" id="btn-resolve" disabled="disabled">Submit <i class="fa-solid fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.card-body -->
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
<script src="https://momentjs.com/downloads/moment.js"></script>


<script>
    $(function () {

        $.ajax({
                url: "{{route('/get-status-count')}}",
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
                    $("#pending-span").text(result['pending']);
                    $("#processing-span").text(result['processing']);
                    $("#resolved-span").text(result['resolved']);
                    $("#tot-span").text(result['tot']);
                }
            });

        $("#status").on('change', function() {
            var value = $(this).val();
            
            $("#btn-resolve").removeAttr('disabled');

            $("#btn-resolve").removeClass();
            $("#btn-resolve").html('Submit <i class="fa-solid fa-paper-plane"></i>');
            $("#btn-resolve").addClass('btn btn-primary');

            $("#action-taken").val('');

            if(value == 1) {
                $("#remarks-div").removeAttr('hidden');
                $("#action-taken").removeAttr('readonly');
            } else if(value == 2) {
                $("#remarks-div").removeAttr('hidden');
                $("#action-taken").removeAttr('readonly');
            } else if(value == 0) {
                $("#remarks-div").removeAttr('hidden');
                $("#action-taken").removeAttr('readonly');
            } else {
                $("#remarks-div").attr('hidden', 'hidden');
                $("#btn-resolve").attr('disabled', 'disabled');
            }

        });
        
        var table = $('#concern-list').DataTable({
            destroy: true,
            processing: true,
            info: true,
            ordering: false,
            deferRender: false,
            scroller: false,
            searching: true,
            bLengthChange: true,
            paging: true,
            serverSide: true,
            ajax: {
                "url": "{{route('/get-concern-list')}}",
                "type": "POST",
                "data": {
                    _token: '{{csrf_token()}}',
                },
            },
            columns: [
            {
                data: 'ticket_num',
                name: 'ticket_num',
            },
            {
                data: 'company_name',
                name: 'company_name',
            },
            {
                data: 'client_company',
                name: 'client_company',
            },
            {
                data: 'email',
                name: 'email',
            },
            {
                data: 'online_system',
                name: 'online_system',
            },
            {
                data: 'subject',
                name: 'subject',
            },
            {
                data: 'message',
                name: 'message',
            },
            {
                data: 'status',
                name: 'status',
            },
            {
                data: 'created_date',
                name: 'created_date',
            },
            {
                data: 'resolved_action',
                name: 'resolved_action',
            },
            {
                data: 'resolved_date',
                name: 'resolved_date',
            },
            {
                data: 'action',
                name: 'action',
            },
            ],
            'columnDefs' : [
                //hide the second & fourth column
                { 'visible': false, 'targets': [3, 6, 9, 10] }
            ],
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
        });

        

        $("#btn-resolve").on('click', function() {
            var ticket = $("#ticket-number").text();
            var action = $("#action-taken").val();
            var id = $("#ticket-id").val();
            var status = $("#status").val();

            $.ajax({
                url: "{{route('/resolve-ticket')}}",
                type: 'POST',
                data: {
                    id : id,
                    ticket : ticket,
                    action : action,
                    status : status,
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
                      title: "Sent",
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
            });
        });
    })

    function view(id, seen) {

        $.ajax({
            url: "{{route('/get-ticket-data')}}",
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
                $("#ticket-id").val(result['id']);
                $("#ticket-number").html(result['ticket_number']);
                $("#client-name").val(result['client_name']);
                $("#company-name").val(result['company_name']);
                $("#e-mail").val(result['email']);
                $("#online-system").val(result['online_system']);
                $("#subject").val(result['subject']);
                $("#message").val(result['message']);
                $("#action-taken").val(result['action']);
                $("#date-submitted").html('Date: ' + result['created_date']);
                $("#status").val(result['status']);

                if(result['status'] == 1) {
                    $("#btn-resolve").attr('disabled', 'disabled');
                    $("#action-taken").attr('readonly', 'readonly');
                    $("#btn-resolve").removeClass();
                    $("#btn-resolve").html('Resolved <i class="fa-solid fa-check"></i>');
                    $("#btn-resolve").addClass('btn btn-success');

                    $("#badge-status-ticket").removeClass();
                    $("#badge-status-ticket").html('Processing');
                    $("#badge-status-ticket").addClass('badge badge-info');
                } else if(result['status'] == 2) {
                    $("#btn-resolve").attr('disabled', 'disabled');
                    $("#action-taken").attr('readonly', 'readonly');
                    $("#btn-resolve").removeClass();
                    $("#btn-resolve").html('Resolved <i class="fa-solid fa-check"></i>');
                    $("#btn-resolve").addClass('btn btn-success');

                    $("#badge-status-ticket").removeClass();
                    $("#badge-status-ticket").html('Resolved');
                    $("#badge-status-ticket").addClass('badge badge-success');
                } else {
                    // $("#btn-resolve").removeAttr('disabled');
                    $("#action-taken").removeAttr('readonly');
                    $("#btn-resolve").removeClass();
                    $("#btn-resolve").html('Submit <i class="fa-solid fa-paper-plane"></i>');
                    $("#btn-resolve").addClass('btn btn-primary');

                    $("#badge-status-ticket").removeClass();
                    $("#badge-status-ticket").html('Pending');
                    $("#badge-status-ticket").addClass('badge badge-warning');
                }


                $.ajax({
                    url: "{{route('/get-ticket-history')}}",
                    type: 'POST',
                    data: {
                        ticket_number: result['ticket_number'],
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
                        $("#history-list-body").html('');
                        $.each(result, function (index, value) {
                            if( value['status'] == 1 ) {
                                var status = '<span class="badge badge-info">Processing</span>';
                            } else if( value['status'] == 2 ) {
                                var status = '<span class="badge badge-success">Resolved</span>';
                            } else {
                                var status = '<span class="badge badge-warning">Pending</span>';
                            }   
                            var date = value['date'] + ' ' + value['time'];

                            details = `<tr>
                                            <td><small>`+value['ticket_number']+`</small></td>
                                            <td><small>`+status+`</small></td>
                                            <td><small>`+value['remarks']+`</small></td>
                                            <td><small>`+moment(date).format('LLL')+`</small></td>
                                        <tr>`;
                            $("#history-list-body").append(details);
                        });

                    }

                });

            }

        });

        if(seen == 0) {

            $.ajax({
                url: "{{route('/update-seen')}}",
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

                    $("#view-concern-"+id).removeClass();
                    $("#view-concern-"+id).addClass('btn btn-light border rounded-pill shadow-sm mb-1');

                }

            });

        }

        var ticket_number = $("#ticket-number").text();


        

        
        $("#right_modal_lg").modal();
        // $("#modal-view-ticket").modal();
    }
</script>