@extends('layouts.dashboard')

@section('content')

<div>
	<ol class="breadcrumb">
	  <li><a href="{{{URL::route('home')}}}">{{trans('Home')}}</a></li>
	  <li class="active">Successful Upload</li>
	</ol>
</div>
<div class="page_content">
                <div class="container-fluid">




                    <div class="row">
                        <div class="col-md-12">



                                <img src = "{{ asset('img/thnk.jpeg') }}" alt="thnk.jpeg" height=auto width=auto><br><span class="nav_title">
                                  <h1  style="color:#337ab7">Your local Data has successfully been uploaded <br> To the Central Lab Spars Database...!!</h1>
                                </span>

                        </div>
                    </div>
                </div>
</div>


	<!-- <a type="button" href="{{ url('remoteupload') }}" class="btn btn-sm btn-primary pull-right"><span class="ion-plus">Remote Upload</span></a> -->

@endsection


@section('page-js-script')
<script type="text/javascript">


</script>
@stop
