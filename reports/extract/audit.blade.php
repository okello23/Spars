@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">
                                    
                   <div class="row">
                    <div class="col-lg-12">
                      <h3 class="pull-left">AUDIT TRAIL</h3>                         
                      </div>
                   </div>

                   <div class="row">
                              <div class="col-lg-4">

                                  <div class="form-group">
                                      {{ Form::label('start_date', 'Start submission date', ['class' => 'col-lg-5 control-label']) }}
                                        <div class="col-lg-7">
                                              {{ Form::text('start_date',null,['data-provide'=>'datepicker','data-date-format'=>'dd MM yyyy','class' => 'form_datetime form-control input-sm','placeholder' => 'From', 'required' => 'true']) }}

                                               @if ($errors->has('start_date'))
                                                  <span class="text-danger">
                                                      <strong>{{ $errors->first('start_date') }}</strong>
                                                  </span>
                                                @endif
                                        </div>
                                    </div>
                              </div>

                              <div class="col-lg-4">

                                  <div class="form-group">
                                      {{ Form::label('end_date', 'End submission date', ['class' => 'col-lg-5 control-label']) }}
                                        <div class="col-lg-7">
                                              {{ Form::text('end_date',null,['data-provide'=>'datepicker','data-date-format'=>'dd MM yyyy','class' => 'form_datetime form-control input-sm','placeholder' => 'To', 'required' => 'true']) }}

                                               @if ($errors->has('end_date'))
                                                  <span class="text-danger">
                                                      <strong>{{ $errors->first('end_date') }}</strong>
                                                  </span>
                                                @endif
                                        </div>
                                    </div>
                              </div>


                       <div class="col-lg-1">
                           <a href="#" class="btn btn-link form-control-static pull-right" id="run_report"><span class="ion-loop"></span> Run report</a>
                       </div>

                   </div>
<hr>

                    <div class="row hidden" id="report-section">
                      <div class="col-md-12">

                <div class="panel panel-default">
                    <table class="table table-condensed table-striped dataTable no-footer display nowrap"  id="audit_report_table">

                      <thead>
                        <tr>
                          <th class="col-md-1">#</th>
                          <th class="col-md-1">Date</th>
                          <th class="col-md-2">User</th>
                          <th class="col-md-2">Auditable Type</th>
                          <th class="col-md-1">Event</th>
                          <th class="col-md-2">Old values</th>
                          <th class="col-md-2">New values</th>
                          <th class="col-md-1">IP Address</th>
                          <th class="col-md-2">User Agent</th>

                        </tr>
                      </thead>
                      
                    </table>
                  </div>

                      </div>
                    </div>
                </div>
</div>
@endsection


@section('page-js-script')
<script type="text/javascript">



//get loan officer
   $('#run_report').click(function(e){

            $('#report-section').removeClass('hidden');
            $("#report-section").LoadingOverlay("show",
                    {
                        image       : "",
                        fontawesome : "fa fa-spinner fa-spin"
                    });


            if ( $.fn.dataTable.isDataTable( '#audit_report_table' ) ) {
           
                          table = $('#audit_report_table').DataTable();
                          table.rows().remove().draw();

            }
            else {

                          var oTable = $('#audit_report_table').DataTable({

                              paging:     true,
                              scrollX:     true,
                              processing: true,
                              serverSide: true,
                              ajax: {
                                  url: '{!! url('auditDTable') !!}',
                                  data: function(d) {
                                          d.start_date = $('input[name=start_date]').val();
                                          d.end_date = $('input[name=end_date]').val();
                                      }
                                  },
                                                                                                                             
                              columns: [
                                          { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                                          { data: 'created_at_formatted', name: 'created_at_formatted' },
                                          { data: 'user', name: 'user' },
                                          { data: 'auditable_type', name: 'auditable_type' },
                                          { data: 'event', name: 'event' },
                                          { data: 'old_values', name: 'old_values' },
                                          { data: 'new_values', name: 'new_values' },
                                          { data: 'ip_address', name: 'ip_address' },
                                          { data: 'user_agent', name: 'user_agent' },
                              ]
                          });

            }


            $("#report-section").LoadingOverlay("hide", true);

  });


</script>
@stop