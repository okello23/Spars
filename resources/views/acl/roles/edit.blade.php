@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">
                                    
                    <div class="row">
                    	<div class="col-md-8 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">Edit role</div>
                <div class="panel-body">
                    {!! Form::model($role, array('route' => array('role.update', $role->id),'autocomplete' => 'off', 'class' => 'form-horizontal', 'data-toggle' => 'validator', 'method' => 'PUT')) !!}


                        {{ csrf_field() }}

                            <fieldset> 


                                <div class="form-group">
                                {{ Form::label('role_name', 'Role', ['class' => 'col-lg-2 control-label']) }}
                                  <div class="col-lg-7">
                                        {{ Form::text('role_name',$role->name,['class' => 'form-control','placeholder' => 'Role', 'required' => 'true']) }}

                                        @if ($errors->has('role_name'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('role_name') }}</strong>
                                            </span>
                                        @endif

                                  </div>
                                </div>

                                    <div class="form-group">
                                      <div class="col-lg-10 col-lg-offset-2">
                                        <a href="{{url('/role')}}" class="btn btn-default">Cancel</a>
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