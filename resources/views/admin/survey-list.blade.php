
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
                    <span class="info-box-text text-center text-muted">RESPONSIVENESS</span>
                    <span class="info-box-number text-center text-muted mb-0" id="responsiveness">999</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
                <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">RELIABILITY</span>
                    <span class="info-box-number text-center text-muted mb-0" id="reliability">999</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
                <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">ACCESS & FACILITIES</span>
                    <span class="info-box-number text-center text-muted mb-0" id="access_facilities">999</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
                <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">COMMUNICATION</span>
                    <span class="info-box-number text-center text-muted mb-0" id="communication">999</span>
                </div>
            </div>
        </div>

        <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
                <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">COSTS</span>
                    <span class="info-box-number text-center text-muted mb-0" id="costs">999</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
                <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">INTEGRITY</span>
                    <span class="info-box-number text-center text-muted mb-0" id="integrity">999</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
                <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">ASSURANCE</span>
                    <span class="info-box-number text-center text-muted mb-0" id="assurance">2000</span>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-3">
            <div class="info-box bg-light">
                <div class="info-box-content">
                    <span class="info-box-text text-center text-muted">OUTCOME</span>
                    <span class="info-box-number text-center text-muted mb-0" id="outcome">2000</span>
                </div>
            </div>
        </div>

    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Survey') }}</div>
    
                <div class="card-body">
                    <table class="table" id="survey-list">
                        <thead>
                            <th class="text-sm">Name</th>
                            <th class="text-sm">Position/Designation</th>
                            <th class="text-sm">Educational Attainment</th>
                            <th class="text-sm">Company Name</th>
                            <th class="text-sm">Industry</th>
                            <th class="text-sm">Location</th>
                            <th class="text-sm">Gender</th>
                            <th class="text-sm">Permit</th>
                            <th class="text-sm">Responsiveness</th>
                            <th class="text-sm">Reliability</th>
                            <th class="text-sm">Access & Facilities</th>
                            <th class="text-sm">Communication</th>
                            <th class="text-sm">Costs</th>
                            <th class="text-sm">Integrity</th>
                            <th class="text-sm">Assurance</th>
                            <th class="text-sm">Outcome</th>
                            <th class="text-sm">Suggestion</th>
                            <th class="text-sm">Date Submitted</th>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- </div> -->

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
                url: "{{route('/get-survey-rate')}}",
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
                    $("#responsiveness").text(result['responsiveness'] + '/5');
                    $("#reliability").text(result['reliability'] + '/5');
                    $("#access_facilities").text(result['access_facilities'] + '/5');
                    $("#communication").text(result['communication'] + '/5');
                    $("#costs").text(result['costs'] + '/5');
                    $("#integrity").text(result['integrity'] + '/5');
                    $("#assurance").text(result['assurance'] + '/5');
                    $("#outcome").text(result['outcome'] + '/5');
                }
            });
        
        var table = $('#survey-list').DataTable({
            destroy: true,
            processing: true,
            info: true,
            ordering: false,
            deferRender: false,
            scroller: false,
            searching: true,
            // bLengthChange: true,
            paging: true,
            serverSide: true,
            scrollX: true,
            ajax: {
                "url": "{{route('/get-survey-list')}}",
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
                data: 'position_designation',
                name: 'position_designation',
            },
            {
                data: 'educational_attainment',
                name: 'educational_attainment',
            },
            {
                data: 'company_name',
                name: 'company_name',
            },
            {
                data: 'industry_type',
                name: 'industry_type',
            },
            {
                data: 'location',
                name: 'location',
            },
            {
                data: 'gender',
                name: 'gender',
            },
            {
                data: 'permit_type',
                name: 'permit_type',
            },
            {
                data: 'responsiveness',
                name: 'responsiveness',
            },
            {
                data: 'reliability',
                name: 'reliability',
            },
            {
                data: 'access_facilities',
                name: 'access_facilities',
            },
            {
                data: 'communication',
                name: 'communication',
            },
            {
                data: 'costs',
                name: 'costs',
            },
            {
                data: 'integrity',
                name: 'integrity',
            },
            {
                data: 'assurance',
                name: 'assurance',
            },
            {
                data: 'outcome',
                name: 'outcome',
            },
            {
                data: 'suggestions',
                name: 'suggestions',
            },
            {
                data: 'created_date',
                name: 'created_date',
            },
            ],
            'columnDefs' : [
                //hide the second & fourth column
                { 'visible': false, 'targets': [0, 1, 2, 3, 16] }
            ],
            dom: 'Bfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
        });

        document.querySelectorAll('a.toggle-vis').forEach((el) => {
            el.addEventListener('click', function (e) {
                e.preventDefault();
         
                let columnIdx = e.target.getAttribute('data-column');
                let column = table.column(columnIdx);
         
                // Toggle the visibility
                column.visible(!column.visible());
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

                if(result['resolved'] == 1) {
                    $("#btn-resolve").attr('disabled', 'disabled');
                    $("#action-taken").attr('readonly', 'readonly');
                    $("#btn-resolve").removeClass();
                    $("#btn-resolve").html('Resolved <i class="fa-solid fa-check"></i>');
                    $("#btn-resolve").addClass('btn btn-success');

                    $("#badge-status-ticket").removeClass();
                    $("#badge-status-ticket").html('Resolved');
                    $("#badge-status-ticket").addClass('badge badge-success');
                } else {
                    $("#btn-resolve").removeAttr('disabled');
                    $("#action-taken").removeAttr('readonly');
                    $("#btn-resolve").removeClass();
                    $("#btn-resolve").html('Submit <i class="fa-solid fa-paper-plane"></i>');
                    $("#btn-resolve").addClass('btn btn-primary');

                    $("#badge-status-ticket").removeClass();
                    $("#badge-status-ticket").html('Pending');
                    $("#badge-status-ticket").addClass('badge badge-warning');
                }
                
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

        
        $("#right_modal_lg").modal();
        // $("#modal-view-ticket").modal();
    }
</script>