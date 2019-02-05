@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">
                                    
                    <div class="row">
                    	<div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">Add cadre</div>
                <div class="panel-body">
                
                    {!! Form::open(array('url' => 'cadre','autocomplete' => 'off', 'class' => 'form-horizontal', 'data-toggle' => 'validator')) !!}

                        {{ csrf_field() }}

                            <fieldset> 


                                <div class="form-group">
                                {{ Form::label('cadre_name', 'Cadre', ['class' => 'col-lg-2 control-label']) }}
                                  <div class="col-lg-7">
                                        {{ Form::text('cadre_name',null,['class' => 'form-control','placeholder' => 'Cadre', 'required' => 'true']) }}

                                        @if ($errors->has('cadre_name'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('cadre_name') }}</strong>
                                            </span>
                                        @endif

                                  </div>
                                </div>

                                    <div class="form-group">
                                      <div class="col-lg-10 col-lg-offset-2">
                                        <a href="{{url('/cadre')}}" class="btn btn-default">Cancel</a>
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