@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">
                                    
                    <div class="row">
                    	<div class="col-lg-8 col-lg-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">Reset password</div>
                <div class="panel-body">

                                    {!! Form::open(array('url' => '/updatePassword','autocomplete' => 'off', 'class' => 'form-horizontal', 'data-toggle' => 'validator','id'=>'password_change_form')) !!}


                        {{ csrf_field() }}

                            <fieldset> 


                                    <div class="form-group{{ $errors->has('old_password') ? ' has-error' : '' }}">
                                        <label for="old_password" class="col-lg-3 control-label">Old password</label>

                                        <div class="col-lg-6">
                                            <input id="old_password" type="password" class="form-control" name="old_password">

                                            @if ($errors->has('old_password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('old_password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>


                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-3 control-label">Password</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control" name="password">

                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                        <label for="password-confirm" class="col-md-3 control-label">Confirm Password</label>

                                        <div class="col-md-6">
                                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                            @if ($errors->has('password_confirmation'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
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