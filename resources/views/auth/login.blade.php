@extends('layouts.login')

    <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}" >

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-offset-5 col-md-3">

            <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
            <div class="form-login">
            <h4>Welcome back</h4>

                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                    <div>
                        <input id="username" type="text" placeholder="Username" class="form-control" name="username" value="{{ old('username') }}">

                            @if ($errors->has('username'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('username') }}</strong>
                                </span>
                            @endif
                    </div>
                </div>

                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">                          
                    <div>
                        <input id="password" type="password" class="form-control" name="password" placeholder="Password">

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                        
                <div class="form-group">
                    <div class="">
                        <button type="submit" class="btn btn-primary">
                             Login <i class="icon ion-log-in"></i>
                        </button>

                        <a class="btn btn-link" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                    </div>
                </div>

            </div>
        </form>

        </div>
    </div>


</div>
@endsection
