@extends('layouts.app')

@section('content')
<div class="page_content">
                <div class="container-fluid">

                   
                   <div class="row">
                    <div class="col-lg-12">
                      <h3 class="pull-left">Order refill rate</h3>                         
                      </div>
                   </div>


                    <div class="row">
                        <div class="col-md-12">

                                    <div class="panel panel-default">

                                        <div style="width:75%;">
    
                                            {!! $chartjs->render() !!}
                                        
                                        </div>

                                    </div>

                        </div>
                    </div>
                </div>
</div>
@endsection


@section('page-js-script')
<script type="text/javascript">


</script>
@stop


