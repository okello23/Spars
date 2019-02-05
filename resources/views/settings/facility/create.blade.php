@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">
                                    
                    <div class="row">
                    	<div class="col-md-10 col-md-offset-1">

                            <div class="panel panel-default">
                                <div class="panel-heading">Add facility</div>
                                <div class="panel-body">
                                
                                    {!! Form::open(array('url' => 'facility','autocomplete' => 'off', 'class' => 'form-horizontal', 'data-toggle' => 'validator')) !!}

                                        {{ csrf_field() }}

                                            <fieldset> 


                                                <div class="form-group">
                                                {{ Form::label('district', 'District', ['class' => 'col-md-2 control-label']) }}
                                                  <div class="col-md-5">
                                                        {{ Form::select('district', $district_list, null, ['data-placeholder' => 'Select a district','class'=>'form-control', 'required' => 'required'  ]) }}

                                                        @if ($errors->has('district'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('district') }}</strong>
                                                            </span>
                                                        @endif

                                                  </div>
                                                </div>

                                                <div class="form-group">
                                                {{ Form::label('sub_district', 'Sub-district', ['class' => 'col-md-2 control-label']) }}
                                                  <div class="col-md-5">
                                                        {{ Form::select('sub_district', $sub_district_list, null, ['data-placeholder' => 'Select a sub district','class'=>'form-control' ,'required' => 'required'  ]) }}

                                                        @if ($errors->has('sub_district'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('sub_district') }}</strong>
                                                            </span>
                                                        @endif

                                                  </div>
                                                </div>

                                                <div class="form-group">
                                                {{ Form::label('level', 'Level', ['class' => 'col-md-2 control-label']) }}
                                                  <div class="col-md-5">
                                                        {{ Form::select('level', $level_list, null, ['data-placeholder' => 'Select facility level','class'=>'form-control', 'required' => 'required' ]) }}

                                                        @if ($errors->has('level'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('level') }}</strong>
                                                            </span>
                                                        @endif

                                                  </div>
                                                </div>      

                                                <div class="form-group">
                                                {{ Form::label('ownership', 'Ownership', ['class' => 'col-md-2 control-label']) }}
                                                  <div class="col-md-5">
                                                        {{ Form::select('ownership', $ownership_list, null, ['data-placeholder' => 'Select ownership','class'=>'form-control', 'required' => 'required' ]) }}

                                                        @if ($errors->has('ownership'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('ownership') }}</strong>
                                                            </span>
                                                        @endif

                                                  </div>
                                                </div>      

                                                <div class="form-group">
                                                {{ Form::label('facility_name', 'Facility', ['class' => 'col-md-2 control-label']) }}
                                                  <div class="col-md-5">
                                                        {{ Form::text('facility_name',null,['class' => 'form-control','placeholder' => 'Facility', 'required' => 'true']) }}

                                                        @if ($errors->has('facility_name'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('facility_name') }}</strong>
                                                            </span>
                                                        @endif

                                                  </div>
                                                </div>


                                                <div class="form-group">
                                                {{ Form::label('incharge_fname', 'In-charge', ['class' => 'col-md-2 control-label']) }}
                                                  <div class="col-md-3">
                                                        {{ Form::text('incharge_fname',null,['class' => 'form-control','placeholder' => 'First Name', 'required' => 'true']) }}

                                                        @if ($errors->has('incharge_fname'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('incharge_fname') }}</strong>
                                                            </span>
                                                        @endif

                                                  </div>

                                                  <div class="col-md-3">
                                                        {{ Form::label('incharge_lname', 'In-charge', ['class' => 'col-md-2 control-label hidden']) }}                                  
                                                        {{ Form::text('incharge_lname',null,['class' => 'form-control','placeholder' => 'Last Name', 'required' => 'true']) }}

                                                        @if ($errors->has('incharge_lname'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('incharge_lname') }}</strong>
                                                            </span>
                                                        @endif

                                                  </div>

                                                  <div class="col-md-3">
                                                        {{ Form::label('incharge_contact', 'In-charge', ['class' => 'col-md-2 hidden control-label']) }}
                                                        {{ Form::text('incharge_contact',null,['class' => 'form-control','placeholder' => 'Phone number', 'required' => 'true']) }}

                                                        @if ($errors->has('incharge_contact'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('incharge_contact') }}</strong>
                                                            </span>
                                                        @endif

                                                  </div>
                                                                                                                      
                                                </div>                            

                                                <div class="form-group">
                                                {{ Form::label('lss_fname', 'Responsible LSS', ['class' => 'col-md-2 control-label']) }}
                                                  <div class="col-md-3">
                                                        {{ Form::text('lss_fname',null,['class' => 'form-control','placeholder' => 'First Name', 'required' => 'true']) }}

                                                        @if ($errors->has('lss_fname'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('lss_fname') }}</strong>
                                                            </span>
                                                        @endif

                                                  </div>

                                                  <div class="col-md-3">
                                                        {{ Form::label('lss_lname', 'In-charge', ['class' => 'col-md-2 control-label hidden']) }}                                  
                                                        {{ Form::text('lss_lname',null,['class' => 'form-control','placeholder' => 'Last Name', 'required' => 'true']) }}

                                                        @if ($errors->has('lss_lname'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('lss_lname') }}</strong>
                                                            </span>
                                                        @endif

                                                  </div>

                                                  <div class="col-md-3">
                                                        {{ Form::label('lss_contact', 'In-charge', ['class' => 'col-md-2 hidden control-label']) }}
                                                        {{ Form::text('lss_contact',null,['class' => 'form-control','placeholder' => 'Phone number', 'required' => 'true']) }}

                                                        @if ($errors->has('lss_contact'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('lss_contact') }}</strong>
                                                            </span>
                                                        @endif

                                                  </div>
                                                                                                                      
                                                </div> 

                                                <div class="form-group">
                                                    <div class="col-md-10 col-md-offset-2">
                                                        <a href="{{url('/facility')}}" class="btn btn-default">Cancel</a>
                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                    </div>
                                                </div>
                                            </div>                                

                                        </fieldset>

                                {!! Form::close() !!}

                                </div>
                            </div>

                    	</div>
                    </div>
                </div>
</div>
@endsection