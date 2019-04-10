@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">

                   
                   <div class="row">
                    <div class="col-sm-12">
                      <h3 class="pull-left">SCORES SUMMARY</h3>                         
                      </div>
                   </div>

                   <div class="row">
                              <div class="col-sm-4">

                                  <div class="form-group">
                                      {{ Form::label('start_date', 'Start Visit Date', ['class' => 'col-sm-4 control-label text-right']) }}
                                        <div class="col-sm-7">
                                              {{ Form::text('start_date',null,['data-provide'=>'datepicker','data-date-format'=>'dd MM yyyy','class' => 'form_datetime form-control input-sm','placeholder' => 'Start date', 'required' => 'true']) }}

                                               @if ($errors->has('start_date'))
                                                  <span class="text-danger">
                                                      <strong>{{ $errors->first('start_date') }}</strong>
                                                  </span>
                                                @endif
                                        </div>
                                    </div>
                              </div>

                              <div class="col-sm-4">

                                  <div class="form-group">
                                      {{ Form::label('end_date', 'End Visit Date', ['class' => 'col-sm-4 control-label text-right']) }}
                                        <div class="col-sm-7">
                                              {{ Form::text('end_date',null,['data-provide'=>'datepicker','data-date-format'=>'dd MM yyyy','class' => 'form_datetime form-control input-sm','placeholder' => 'End date', 'required' => 'true']) }}

                                               @if ($errors->has('end_date'))
                                                  <span class="text-danger">
                                                      <strong>{{ $errors->first('end_date') }}</strong>
                                                  </span>
                                                @endif
                                        </div>
                                    </div>
                              </div>


                    	 <div class="col-sm-1">
							             <a href="#" class="btn btn-link form-control-static pull-right" id="run_report"><span class="ion-loop"></span> Run report</a>
                    	 </div>

                   </div>
<hr>

                    <div class="row hidden" id="report-section">
                    	<div class="col-md-12">

                <div class="panel panel-default">
										<table class="table table-condensed table-striped"  id="score_report">
										
                        				<caption> 
                        					<a href="#" id="export_excel" class="btn btn-sm btn-success btn-sm-custom pull-left"><span class="fa fa-file-excel-o"></span> Excel</a>
                        				</caption>

										  <thead>
										    <tr>
										      <th  class="col-md-1">#</th>
										      <th class="col-md-1 text-center">Facility ID</th>
										      <th class="col-md-1 text-center">District</th>
										      <th class="col-md-2 text-center">Facility</th>
										      <th class="col-md-1 text-right">Visit date</th>
										      <th class="col-md-1 text-right">Visit number</th>
										      <th class="col-md-1 text-right">Indicator 1</th>
										      <th class="col-md-1 text-right">Indicator 2</th>
										      <th class="col-md-1 text-right">Indicator 3</th>
										      <th class="col-md-1 text-right">Indicator 4</th>
										      <th class="col-md-1 text-right">Indicator 5</th>
										      <th class="col-md-1 text-right">Indicator 6</th>
										      <th class="col-md-1 text-right">Indicator 7</th>
										      <th class="col-md-1 text-right">Indicator 8</th>
										      <th class="col-md-1 text-right">Indicator 9</th>
										      <th class="col-md-1 text-right">Indicator 10</th>
										      <th class="col-md-1 text-right">Indicator 11</th>
										      <th class="col-md-1 text-right">Indicator 12</th>
										      <th class="col-md-1 text-right">Indicator 13</th>
										      <th class="col-md-1 text-right">Indicator 14</th>
										      <th class="col-md-1 text-right">Indicator 15</th>
										      <th class="col-md-1 text-right">Indicator 16</th>
										      <th class="col-md-1 text-right">Indicator 17</th>
										      <th class="col-md-1 text-right">Indicator 18</th>
										      <th class="col-md-1 text-right">Indicator 19</th>
										      <th class="col-md-1 text-right">Indicator 20</th>
										      <th class="col-md-1 text-right">Indicator 21</th>
										      <th class="col-md-1 text-right">Indicator 22</th>
										      <th class="col-md-1 text-right">Indicator 23</th>
										      <th class="col-md-1 text-right">Indicator 24</th>
										      <th class="col-md-1 text-right">Indicator 25</th>
										      <th class="col-md-1 text-right">Indicator 26</th>
										      <th class="col-md-1 text-right">Indicator 27</th>

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
            url: '/reports/visit/scoresToExcel',
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



            if ( $.fn.dataTable.isDataTable( '#score_report' ) ) {
               
                table = $('#score_report').DataTable();
                table.rows().remove().draw();

            }
            else {

                          var oTable = $('#score_report').DataTable({

                              paging:     true,
                              scrollX:     true,
                              processing: true,
                              serverSide: true,
                              ajax: {
                                  url: '{!! url('scoresDTable') !!}',
                                  data: function(d) {
                                          d.start_date = $('input[name=start_date]').val();
                                          d.end_date = $('input[name=end_date]').val();
                                      }
                                  },
                              columnDefs: [
                                {
                                    targets: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32],
                                    className: 'text-center'
                                }
                              ],                                  
                              columns: [
                                  { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                                  { data: 'health_facility_id', name: 'health_facility_id' },
                                  { data: 'district', name: 'district' },
                                  { data: 'facility', name: 'facility' },
                                  { data: 'visit_date', name: 'visit_date' },
                                  { data: 'visit_number', name: 'visit_number'},
                                  { data: 'indicator1_score', name: 'indicator1_score' },
                                  { data: 'indicator2_score', name: 'indicator2_score' },
                                  { data: 'indicator3_score', name: 'indicator3_score' },
                                  { data: 'indicator4_score', name: 'indicator4_score'},
                                  { data: 'indicator5_score', name: 'indicator5_score'},
                                  { data: 'indicator6_score', name: 'indicator6_score'},
                                  { data: 'indicator7_score', name: 'indicator7_score'},
                                  { data: 'indicator8_score', name: 'indicator8_score'},
                                  { data: 'indicator9_score', name: 'indicator9_score'},
                                  { data: 'indicator10_score', name: 'indicator10_score'},
                                  { data: 'indicator11_score', name: 'indicator11_score'},
                                  { data: 'indicator12_score', name: 'indicator12_score'},
                                  { data: 'indicator13_score', name: 'indicator13_score'},
                                  { data: 'indicator14_score', name: 'indicator14_score'},
                                  { data: 'indicator15_score', name: 'indicator15_score'},
                                  { data: 'indicator16_score', name: 'indicator16_score'},
                                  { data: 'indicator17_score', name: 'indicator17_score'},
                                  { data: 'indicator18_score', name: 'indicator18_score'},
                                  { data: 'indicator19_score', name: 'indicator19_score'},
                                  { data: 'indicator20_score', name: 'indicator20_score'},
                                  { data: 'indicator21_score', name: 'indicator21_score'},
                                  { data: 'indicator22_score', name: 'indicator22_score'},
                                  { data: 'indicator23_score', name: 'indicator23_score'},
                                  { data: 'indicator24_score', name: 'indicator24_score'},
                                  { data: 'indicator25_score', name: 'indicator25_score'},
                                  { data: 'indicator26_score', name: 'indicator26_score'},
                                  { data: 'indicator27_score', name: 'indicator27_score'},
                              ]
                          });

            }



            $("#report-section").LoadingOverlay("hide", true);

  });


</script>
@stop