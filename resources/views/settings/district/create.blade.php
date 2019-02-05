@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">
                                    
                    <div class="row">
                    	<div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">Add district</div>
                <div class="panel-body">
                
                    {!! Form::open(array('url' => 'district','autocomplete' => 'off', 'class' => 'form-horizontal', 'data-toggle' => 'validator')) !!}

                        {{ csrf_field() }}

                            <fieldset> 


                                <div class="form-group">
                                {{ Form::label('district_name', 'District', ['class' => 'col-lg-2 control-label']) }}
                                  <div class="col-lg-7">
                                        {{ Form::text('district_name',null,['class' => 'form-control','placeholder' => 'District', 'required' => 'true']) }}

                                        @if ($errors->has('district_name'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('district_name') }}</strong>
                                            </span>
                                        @endif

                                  </div>
                                </div>

                                    <div class="form-group">
                                      <div class="col-lg-10 col-lg-offset-2">
                                        <a href="{{url('/district')}}" class="btn btn-default">Cancel</a>
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