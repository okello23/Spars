@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">
                                    
                    <div class="row">
                    	<div class="col-md-10 col-md-offset-1">

            <div class="panel panel-default">
                <div class="panel-heading">Edit Facility</div>
                <div class="panel-body">
                    {!! Form::model($facility, array('route' => array('facility.update', $facility->id),'autocomplete' => 'off', 'class' => 'form-horizontal', 'data-toggle' => 'validator', 'method' => 'PUT')) !!}


                        {{ csrf_field() }}

                                    <fieldset> 

                                                <div class="form-group">
                                                {{ Form::label('district', 'District', ['class' => 'col-md-2 control-label']) }}
                                                  <div class="col-md-5">
                                                        {{ Form::select('district', ["$facility->facility"=>"$facility->facility"], null, ['data-placeholder' => 'Select a district','class'=>'form-control', 'disabled' => 'disabled'  ]) }}

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
                                                        {{ Form::select('sub_district', ["$facility->hsd"=>"$facility->hsd"], null, ['data-placeholder' => 'Select a sub district','class'=>'form-control' ,'disabled' => 'disabled'  ]) }}

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
                                                        {{ Form::select('level', ["$facility->level"=>"$facility->level"], null, ['data-placeholder' => 'Select facility level','class'=>'form-control', 'disabled' => 'disabled' ]) }}

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
                                                        {{ Form::select('ownership', ["$facility->ownership"=>"$facility->ownership"], null, ['data-placeholder' => 'Select ownership','class'=>'form-control', 'disabled' => 'disabled' ]) }}

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
                                                        {{ Form::text('facility_name',$facility->facility,['class' => 'form-control','placeholder' => 'Facility', 'disabled' => 'disabled']) }}

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
                                                        {{ Form::text('incharge_fname',$facility->in_charge_fname,['class' => 'form-control','placeholder' => 'First Name', 'required' => 'true']) }}

                                                        @if ($errors->has('incharge_fname'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('incharge_fname') }}</strong>
                                                            </span>
                                                        @endif

                                                  </div>

                                                  <div class="col-md-3">
                                                        {{ Form::label('incharge_lname', 'In-charge', ['class' => 'col-md-2 control-label hidden']) }}                                  
                                                        {{ Form::text('incharge_lname',$facility->in_charge_lname,['class' => 'form-control','placeholder' => 'Last Name', 'required' => 'true']) }}

                                                        @if ($errors->has('incharge_lname'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('incharge_lname') }}</strong>
                                                            </span>
                                                        @endif

                                                  </div>

                                                  <div class="col-md-3">
                                                        {{ Form::label('incharge_contact', 'In-charge', ['class' => 'col-md-2 hidden control-label']) }}
                                                        {{ Form::text('incharge_contact',$facility->in_charge_contact,['class' => 'form-control','placeholder' => 'Phone number', 'required' => 'true']) }}

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
                                                        {{ Form::text('lss_fname',$facility->lss_fname,['class' => 'form-control','placeholder' => 'First Name', 'required' => 'true']) }}

                                                        @if ($errors->has('lss_fname'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('lss_fname') }}</strong>
                                                            </span>
                                                        @endif

                                                  </div>

                                                  <div class="col-md-3">
                                                        {{ Form::label('lss_lname', 'In-charge', ['class' => 'col-md-2 control-label hidden']) }}                                  
                                                        {{ Form::text('lss_lname',$facility->lss_lname,['class' => 'form-control','placeholder' => 'Last Name', 'required' => 'true']) }}

                                                        @if ($errors->has('lss_lname'))
                                                            <span class="text-danger">
                                                                <strong>{{ $errors->first('lss_lname') }}</strong>
                                                            </span>
                                                        @endif

                                                  </div>

                                                  <div class="col-md-3">
                                                        {{ Form::label('lss_contact', 'In-charge', ['class' => 'col-md-2 hidden control-label']) }}
                                                        {{ Form::text('lss_contact',$facility->lss_contact,['class' => 'form-control','placeholder' => 'Phone number', 'required' => 'true']) }}

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