@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">
                                    
                    <div class="row">
                    	<div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">Add person</div>
                <div class="panel-body">
                
                    {!! Form::open(array('url' => 'personnel','autocomplete' => 'off', 'class' => 'form-horizontal', 'data-toggle' => 'validator')) !!}

                        {{ csrf_field() }}

                            <fieldset> 

                                <div class="form-group">
                                {{ Form::label('first_name', 'First Name', ['class' => 'col-lg-2 control-label']) }}
                                  <div class="col-lg-7">
                                        {{ Form::text('first_name',null,['class' => 'form-control','placeholder' => 'First Name', 'required' => 'true']) }}

                                        @if ($errors->has('first_name'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif

                                  </div>
                                </div>

                                <div class="form-group">
                                {{ Form::label('last_name', 'Last Name', ['class' => 'col-lg-2 control-label']) }}
                                  <div class="col-lg-7">
                                        {{ Form::text('last_name',null,['class' => 'form-control','placeholder' => 'Last Name', 'required' => 'true']) }}

                                        @if ($errors->has('last_name'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif

                                  </div>
                                </div>

                                <div class="form-group">
                                {{ Form::label('email', 'Email', ['class' => 'col-lg-2 control-label']) }}
                                  <div class="col-lg-7">
                                        {{ Form::email('email',null,['class' => 'form-control','placeholder' => 'Email', 'required' => 'true']) }}

                                        @if ($errors->has('email'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif

                                  </div>
                                </div>                                                                

                                <div class="form-group">
                                {{ Form::label('phone_number', 'Phone number', ['class' => 'col-lg-2 control-label']) }}
                                  <div class="col-lg-7">
                                        {{ Form::number('phone_number',null,['class' => 'form-control','placeholder' => 'Phone number','required' => 'true']) }}

                                        @if ($errors->has('phone_number'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif

                                  </div>
                                </div>



                                <div class="form-group">
                                {{ Form::label('cadre_type', 'Cadre', ['class' => 'col-lg-2 control-label']) }}
                                  <div class="col-lg-7">
                                        {{ Form::select('cadre_id', $cadre_list, null, ['data-placeholder' => 'Select a cadre','class'=>'form-control' ]) }}

                                        @if ($errors->has('cadre_type'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('cadre_type') }}</strong>
                                            </span>
                                        @endif

                                  </div>
                                </div>

                                    <div class="form-group">
                                      <div class="col-lg-10 col-lg-offset-2">
                                        <a href="{{url('/personnel')}}" class="btn btn-default">Cancel</a>
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