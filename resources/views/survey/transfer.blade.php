@extends('layouts.app')

@section('content')

<div class="container">



                                {!! Form::open(array('route' => 'survey.saveTransfer','autocomplete' => 'off', 'class' => 'form-horizontal', 'data-toggle' => 'validator')) !!}

                                {{ csrf_field() }}

   
                                {{ Form::label('form_id', '', ['class' => 'col-md-3 control-label hidden']) }}                                                                        
                                {{ Form::text('form_id',$record->form_id,['class' => ' hidden form-control input-md']) }}

                                            <div class="row">
                                                <div class="col-md-12">

                                                    <h3> TRANSFER DATA FROM {{ $facility->facility }} {{ $facility->level }}</h3>

                                                </div>                                              
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                
                                                    <div class="form-group form-template col-lg-9 has-feedback">
                                                        {{ Form::label('district_id', 'District') }}
                                                        {{ Form::select('district_id', $district_list ,$facility->district, array('class' => 'form-control has-feedback input-md', 'disabled' => 'disabled')) }}

                                                        <div class="help-block with-errors text-danger">
                                                            @if ($errors->has('district_id'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('district_id') }}</strong>
                                                                </span>
                                                            @endif                                
                                                        </div>                            

                                                    </div>   


                                                    <div class="form-group form-template col-lg-9 has-feedback">
                                                        {{ Form::label('sub_district_id', 'Sub district') }}
                                                        {{ Form::select('sub_district_id', $sub_district_list ,$facility->hsd, array('class' => 'form-control has-feedback input-md', 'disabled' => 'disabled')) }}

                                                        <div class="help-block with-errors text-danger">
                                                            @if ($errors->has('sub_district_id'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('sub_district_id') }}</strong>
                                                                </span>
                                                            @endif                                
                                                        </div>                            

                                                    </div>     


                                                    <div class="form-group form-template col-lg-9 has-feedback">
                                                        {{ Form::label('facility_id', 'Facility') }}
                                                        {{ Form::select('facility_id', $facility_list ,$facility->id, array('class' => 'form-control has-feedback input-md', 'disabled' => 'disabled')) }}

                                                        <div class="help-block with-errors text-danger">
                                                            @if ($errors->has('facility_id'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('facility_id') }}</strong>
                                                                </span>
                                                            @endif                                
                                                        </div>                            

                                                    </div>     


                                                    <div class="form-group form-template col-lg-9 has-feedback">
                                                        {{ Form::label('visit_number', 'Visit number') }}                                                            
                                                        {{ Form::text('visit_number',$record->visit_number,['class' => 'form-control','placeholder' => 'Supervision visit number', 'readonly' => 'true']) }}

                                                        <div class="help-block with-errors text-danger">
                                                            @if ($errors->has('visit_number'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('visit_number') }}</strong>
                                                                </span>
                                                            @endif                                
                                                        </div>                            

                                                    </div>     
                                     
                                                </div>


                                                <div class="col-md-6">

                                                    <div class="form-group form-template col-lg-9 has-feedback">
                                                        {{ Form::label('district_id_to', 'District') }}
                                                        {{ Form::select('district_id_to', $district_list ,$facility->district, array('class' => 'form-control has-feedback input-md', 'required' => 'required')) }}

                                                        <div class="help-block with-errors text-danger">
                                                            @if ($errors->has('district_id_to'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('district_id_to') }}</strong>
                                                                </span>
                                                            @endif                                
                                                        </div>                            

                                                    </div>   


                                                    <div class="form-group form-template col-lg-9 has-feedback">
                                                        {{ Form::label('sub_district_id_to', 'Sub district') }}
                                                        {{ Form::select('sub_district_id_to', $sub_district_list ,$facility->hsd, array('class' => 'form-control has-feedback input-md', 'required' => 'required')) }}

                                                        <div class="help-block with-errors text-danger">
                                                            @if ($errors->has('sub_district_id_to'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('sub_district_id_to') }}</strong>
                                                                </span>
                                                            @endif                                
                                                        </div>                            

                                                    </div>     


                                                    <div class="form-group form-template col-lg-9 has-feedback">
                                                        {{ Form::label('facility_id_to', 'Facility') }}
                                                        {{ Form::select('facility_id_to', $facility_list ,$facility->id, array('class' => 'form-control has-feedback input-md', 'required' => 'required')) }}

                                                        <div class="help-block with-errors text-danger">
                                                            @if ($errors->has('facility_id_to'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('facility_id_to') }}</strong>
                                                                </span>
                                                            @endif                                
                                                        </div>                            

                                                    </div>     


                                                    <div class="form-group form-template col-lg-9 has-feedback">
                                                        {{ Form::label('visit_number_to', 'Visit number') }}                                                            
                                                        {{ Form::text('visit_number_to',$record->visit_number,['class' => 'form-control','placeholder' => 'Supervision visit number', 'required' => 'required']) }}

                                                        <div class="help-block with-errors text-danger">
                                                            @if ($errors->has('visit_number_to'))
                                                                <span class="text-danger">
                                                                    <strong>{{ $errors->first('visit_number_to') }}</strong>
                                                                </span>
                                                            @endif                                
                                                        </div>                            

                                                    </div> 



                                                    <div class="form-group form-template col-lg-9 has-feedback">
                                                        {{ Form::hidden('id', 'Visit number') }}                                                            
                                                        {{ Form::hidden('id',$record->id,['class' => 'form-control']) }}                            

                                                    </div> 


                                                </div>                                                
                                            </div>

                                            <div class="form-group ">
                                            <div class="col-md-12">
                                                    <a href="{{url('/reports/visit/summary')}}" class="btn btn-default">Cancel</a>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                            </div>
                          

                        {{ Form::close() }}


</div>


@endsection

@section('page-js-script')

<script>
$(function() {

    $('#district_id_to').select2({
      placeholder: 'Select district',
      width: '100%' 
    });


    $('#sub_district_id_to').select2({
      placeholder: 'Select sub district',
      width: '100%' 
    });


    $('#facility_id_to').select2({
      placeholder: 'Select facility',
      width: '100%' 
    });


    $('select').select2({
      placeholder: 'Select',
      width: '100%' 
    });



    $('#district_id_to').on('change',function(){

            var data = {
                district: $('#district_id_to').val(),
                "_token": "{{ csrf_token() }}"  
            };

        $.ajax({
            type: 'POST',
            url: '/get_sub_districts',
            data: data
        }).done(function(response) {
            $('#sub_district_id_to').empty();
            $('#facility_id_to').empty();

                $('#sub_district_id_to').append("<option/>");

            $.each(response, function(key, value) {
                $('#sub_district_id_to').append($("<option/>", {
                    value: key,
                    text: value
                }));
            });

        }).fail(function (jqXHR, textStatus, errorThrown) {
            //TODO handle fails on note post backs.
            console.log(textStatus + ' : ' + errorThrown);
        });

    });



//get facilities
   $('#sub_district_id_to').change(function(e){

            var data = {
                sub_district: e.target.value,
                district: $("#district_id_to").val(),
                "_token": "{{ csrf_token() }}"
            };

        $.ajax({
            type: 'POST',
            url: '/get_facility_list',
            data: data
        }).done(function(response) {
            $('#facility_id_to').empty();

                $('#facility_id_to').append("<option/>");

            $.each(response, function(key, value) {
                $('#facility_id_to').append($("<option/>", {
                    value: key,
                    text: value
                }));
            });

        }).fail(function (jqXHR, textStatus, errorThrown) {
            //TODO handle fails on note post backs.
            console.log(textStatus + ' : ' + errorThrown);
        });

  }); 




});
</script>
@stop