
@extends('layouts.app')
    
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Timeline') }}</div>
    
                <div class="card-body">
                    <!-- Timelime example  -->
                    <div class="row">
                      <div class="col-md-12">
                        <!-- The time line -->
                        <div class="timeline timeline-inverse" id="timeline-data">

                        </div>
                      </div>
                      <!-- /.col -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-view-ticket">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">
          
        </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <input class="form-control" id="report-id-modal" hidden>
      </div>
      <div class="modal-body">

        <div class="card-body">

            <!-- <div class="card"> -->
                <div class="card-body row">
                  <div class="col-12">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                              <small class="float-right" id="date-submitted">Date: 2/10/2014</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                              <label for="company-name">Company Name</label>
                              <input type="text" id="company-name" class="form-control" readonly />
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <small>
                                    <label for="client-name">Client Name</label>
                                    <input type="text" id="client-name" class="form-control" readonly/>
                                </small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <small>
                                    <label for="e-mail">E-Mail</label>
                                    <input type="email" id="e-mail" class="form-control" readonly />
                                </small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <small>
                                    <label for="online-system">Online System</label>
                                    <input type="email" id="online-system" class="form-control" readonly />
                                </small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <small>
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" class="form-control" readonly />
                        </small>
                    </div>
                    <div class="form-group">
                        <small>
                            <label for="message">Message</label>
                            <textarea id="message" class="form-control" rows="4" readonly></textarea>
                        </small>
                    </div>
                    <div class="form-group">
                        <small>
                            <label for="message">Action taken</label>
                            <textarea id="message" class="form-control" rows="4"></textarea>
                        </small>
                    </div>
                    <div class="form-group">
                      <input type="submit" class="btn btn-warning" id="btn-send" value="resolve">
                    </div>
                  </div>
                </div>
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
<script src="https://momentjs.com/downloads/moment.js"></script>


<script>
    $(function () {

      $.ajax({
            url: "{{route('/get-timeline')}}",
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
                $.each(result, function (index, value) {

                  $("#timeline-data").append(
                    `<!-- timeline time label -->
                    <div class="time-label">
                      <span class="bg-yellow">`+value['date']+`</span>
                    </div>
                    <!-- /.timeline-label -->`
                    );

                  $.each(value['data'], function (index, value1) {

                    console.log(value1);

                    if(value1['user_type'] == 0 ) {
                      var timeline = `<!-- timeline item -->
                          <div>
                            <i class="fas fa-envelope bg-blue"></i>
                            <div class="timeline-item">
                              <span class="time"><i class="fas fa-clock"></i> `+ moment(value1['date'] + ' ' +value1['time']).fromNow() +`</span>
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
                              <span class="time"><i class="fas fa-clock"></i> `+ moment(value1['date'] + ' ' +value1['time']).fromNow() +`</span>
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
                              <span class="time"><i class="fas fa-clock"></i> `+ moment(value1['date'] + ' ' +value1['time']).fromNow() +`</span>
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