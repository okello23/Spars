@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">
                                    
                    <div class="row">
                    	<div class="col-lg-8 col-lg-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">Edit visit</div>
                <div class="panel-body">

                                    {!! Form::open(array('url' => '/reports/visit/update','autocomplete' => 'off', 'class' => 'form-horizontal', 'data-toggle' => 'validator','id'=>'password_change_form')) !!}


                        {{ csrf_field() }}

                            <fieldset> 

                                    <p><u><span> {{$facility->district}} >{{$facility->hsd}} >{{$facility->facility}} {{$facility->level}} </span></u></p>
                                    <div class="form-group{{ $errors->has('visit_id') ? ' has-error' : '' }}">
                                        <label for="visit_id" class="col-md-3 control-label hidden">Visit Id</label>

                                        <div class="col-md-6">
                                            <input id="visit_id" type="text" class="form-control hidden" name="visit_id" value="{{$record->id}}">

                                            @if ($errors->has('visit_id'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('visit_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('visit_number') ? ' has-error' : '' }}">
                                        <label for="visit_number" class="col-md-3 control-label">Visit number</label>

                                        <div class="col-md-6">
                                            <input id="visit_number" type="text" class="form-control" name="visit_number" value="{{$record->visit_number}}">

                                            @if ($errors->has('visit_number'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('visit_number') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('visit_date') ? ' has-error' : '' }}">
                                        <label for="visit_date" class="col-md-3 control-label">Visit date</label>

                                        <div class="col-md-6">
                                            {{ Form::text('visit_date',date_format(date_create($record->visit_date),'d F Y'),['data-provide'=>'datepicker','data-date-format'=>'dd MM yyyy','class' => 'form_datetime form-control input-sm','placeholder' => 'Visit date', 'required' => 'true']) }}

                                            @if ($errors->has('visit_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('visit_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('next_visit_date') ? ' has-error' : '' }}">
                                        <label for="next_visit_date" class="col-md-3 control-label">Next visit date</label>

                                        <div class="col-md-6">                                            
                                            {{ Form::text('next_visit_date',date_format(date_create($record->next_visit_date),'d F Y'),['data-provide'=>'datepicker','data-date-format'=>'dd MM yyyy','class' => 'form_datetime form-control input-sm','placeholder' => 'Visit date', 'required' => 'true']) }}

                                            @if ($errors->has('next_visit_date'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('next_visit_date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group">
                                      <div class="col-lg-9 col-lg-offset-3">
                                        <a href="{{url('/home')}}" class="btn btn-default">Cancel</a>
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