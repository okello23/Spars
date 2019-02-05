@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid" id="report_section">

                   
                   <div class="row">
                    <div class="col-lg-12">
                      <h3 class="pull-left">EXTRACT BY INDICATOR</h3>                         
                      </div>
                   </div>

                   <div class="row">
                                                  
                                <div class="col-lg-3">

                                  <div class="form-group">
                                      {{ Form::label('start_date', 'Start visit date', ['class' => 'col-lg-5 control-label']) }}
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

                              <div class="col-lg-3">

                                  <div class="form-group">
                                      {{ Form::label('end_date', 'End visit date', ['class' => 'col-lg-5 control-label']) }}
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

                              <div class="col-lg-3">

                                  <div class="form-group">
                                      {{ Form::label('indicator_id', 'Indicator', ['class' => 'col-lg-5 control-label form-control-static']) }}
                                        <div class="col-lg-7">
                                            {{ Form::select('indicator_id', [""=>"",28=>"General information",1=>"Stock management",10=>"Indicator 10",11=>"Indicator 11",12=>"Indicator 12",13=>"Indicator 13",14=>"Indicator 14",15=>"Indicator 15",16=>"Indicator 16",17=>"Indicator 17",18=>"Indicator 18",19=>"Indicator 19",20=>"Indicator 20",21=>"Indicator 21",22=>"Indicator 22",23=>"Indicator 23",24=>"Indicator 24",25=>"Indicator 25",26=>"Indicator 26",27=>"Indicator 27"], null, ['data-placeholder' => 'Select an indicator','class'=>'form-control js-example-basic-single', 'required'=>'required' ]) }}

                                               @if ($errors->has('indicator_id'))
                                                  <span class="text-danger">
                                                      <strong>{{ $errors->first('indicator_id') }}</strong>
                                                  </span>
                                                @endif
                                        </div>
                                    </div>
                              </div>


                    	 <div class="col-lg-1">
							             <a href="#" class="btn btn-link form-control-static pull-right" id="run_report"><span class="ion-loop"></span> Generate</a>
                    	 </div>

                   </div>

                </div>
</div>
@endsection


@section('page-js-script')
<script type="text/javascript">


//export to excel
   $('#run_report').click(function(e){

    if($('#indicator_id').val())
    {


                $('#report_section').removeClass('hidden');
                $("#report_section").LoadingOverlay("show",
                        {
                            image       : "",
                            fontawesome : "fa fa-spinner fa-spin"
                        });


                var data = {
                    _token: "{{ csrf_token() }}",                
                    start_date:$('#start_date').val(),
                    end_date:$('#end_date').val(),
                    indicator_id:$('#indicator_id').val()

                };

            $.ajax({
                type: 'POST',
                url: '/reports/extract/indicatorToExcel',
                data: data
            }).done(function(response) {

            var a = document.createElement("a");
            a.href = response.file; 
            a.download = response.name;
            document.body.appendChild(a);
            a.click();
            a.remove();
            
            $("#report_section").LoadingOverlay("hide", true);

            }).fail(function (jqXHR, textStatus, errorThrown) {
                //TODO handle fails on note post backs.
                console.log(textStatus + ' : ' + errorThrown);
            });
    }
    else
    {
        toastr.error("You must select an indicatort before generating a file");
    }

  });


</script>
@stop