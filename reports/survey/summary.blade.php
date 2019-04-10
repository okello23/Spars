@include('modals.delete_modal')

@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">

                   
                   <div class="row">
                    <div class="col-lg-12">
                      <h3 class="pull-left">VISITS SUMMARY</h3>                         
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
                                              {{ Form::text('end_date',null,['data-provide'=>'datepicker','data-date-format'=>'dd MM yyyy','class' => 'form_datetime form-control input-sm','placeholder' => 'From', 'required' => 'true']) }}

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
                    <table class="table table-condensed table-striped dataTable custom-data-table no-footer display nowrap"  id="report_table">
                    
                                <caption> 
                                  <a href="#" id="export_excel" class="btn btn-sm btn-success btn-sm-custom pull-left"><span class="fa fa-file-excel-o"></span> Excel</a>
                                </caption>

                      <thead>
                        <tr>
                          <th  class="col-md-1">#</th>
                          <th class="col-md-1 text-center" >Region</th>
                          <th class="col-md-1 text-center" >District</th>
                          <th class="col-md-1 text-center">Sub-district</th>
                          <th class="col-md-1 text-center">Facility</th>
                          <th class="col-md-1 text-center">Level</th>
                          <th class="col-md-1 text-center">Ownership</th>
                          <th class="col-md-1">Visit number</th>
                          <th class="col-md-1">Visit date</th>
                          <th class="col-md-1">Next visit date</th>
                          <th class="col-md-1">Submission date</th>
                          <th class="col-md-2">Submitted by</th>
                          <th class="col-md-2">Supervisor(s)</th>
                          <th class="col-md-2">Persons supervised</th>
                          <th class="col-md-1"></th>
                          <th class="col-md-1"></th>
                          <th class="col-md-1"></th>

                        </tr>
                      </thead>
                      <tbody>

                      </tbody>
                    </table>
                  </div>

                      </div>
                    </div>
                </div>
</div>
@endsection


@section('page-js-script')
<script type="text/javascript">


//export to excel
   $('#export_excel').click(function(e){


            $('#report-section').removeClass('hidden');
            $("#report-section").LoadingOverlay("show",
                    {
                        image       : "",
                        fontawesome : "fa fa-spinner fa-spin"
                    });


            var data = {
                start_date:$('#start_date').val(),
                end_date:$('#end_date').val()
            };

        $.ajax({
            type: 'GET',
            url: '/reports/visit/summaryToExcel',
            data: data
        }).done(function(response) {

        var a = document.createElement("a");
        a.href = response.file; 
        a.download = response.name;
        document.body.appendChild(a);
        a.click();
        a.remove();
        
        $("#report-section").LoadingOverlay("hide", true);

        }).fail(function (jqXHR, textStatus, errorThrown) {
            //TODO handle fails on note post backs.
            console.log(textStatus + ' : ' + errorThrown);
        });

  });


//get loan officer
   $('#run_report').click(function(e){


            $('#report-section').removeClass('hidden');
            $("#report-section").LoadingOverlay("show",
                    {
                        image       : "",
                        fontawesome : "fa fa-spinner fa-spin"
                    });


            var data = {
                start_date:$('#start_date').val(),
                end_date:$('#end_date').val()
            };

        $.ajax({
            type: 'GET',
            url: '/reports/visit/summaryToScreen',
            data: data
        }).done(function(response) {

           var table = $('#report_table').DataTable();
             table.rows().remove().draw();


            if(response.length!=0)
            {

            $('#report_table tbody > tr').remove();
             
             $.each(response,function( index, value ) {

                table.row.add( {
                      0:  (index+1)+'.',
                      1:  value[1].region,
                      2:  value[1].district,
                      3:  value[1].hsd,
                      4:  value[1].facility,
                      5:  value[1].level,
                      6:  value[1].ownership,
                      7:  value[0].visit_number,
                      8:  (value[0].visit_date!=null?moment(value[0].visit_date).format('LL'):''),
                      9:  (value[0].next_visit_date!=null?moment(value[0].next_visit_date).format('LL'):''),
                      10:  (value[0].created_at!=null?moment(value[0].created_at).format('LL'):''),
                      11:  value[4],
                      12:  value[2],
                      13:  value[3],
                      14:  '<a href="/survey/transfer/' + value[0].id+ '">'+ '<i class="ion-arrow-swap"></i>' + '</a>' ,
                      15:  (value[0].form_version == 2 ? '<a href="/survey/partial/' + value[0].id+ '">'+ '<i class="ion-edit"></i>' + '</a>' :  '<a href="/survey/' + value[0].id+ '/edit/">'+ '<i class="ion-edit"></i>' + '</a>' ),
                      16:   '<a href="#" data-id="'+value[0].id+'"'+'" class="del-modal'+'"'+'" data-toggle="modal'+'"'+'" data-target="#delete_modal'+'">'+ '<i class="ion-trash-a"></i>' + '</a>'

                  } ).draw();   
              
            });

    
          }

            $("#report-section").LoadingOverlay("hide", true);

        }).fail(function (jqXHR, textStatus, errorThrown) {
            //TODO handle fails on note post backs.
            console.log(textStatus + ' : ' + errorThrown);
        });

  });

$('#delete_modal').on('show.bs.modal', function(e) {
  $('#id').val( e.relatedTarget.dataset.id );

});


</script>
@stop