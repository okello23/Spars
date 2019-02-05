<!DOCTYPE html>
<html lang="en">
@section('head')
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="pragma" content="no-cache" />    


    <title>Lab SPARS</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" > 
    <link rel="stylesheet" href="{{ URL::asset('css/toastr.min.css') }}" > 
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">      
    <link rel="stylesheet" href="{{ URL::asset('css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-datepicker3.min.css') }}">  
    <link rel="stylesheet" href="{{ URL::asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">   
    <link rel="stylesheet" href="{{ URL::asset('css/formValidation.min.css') }}">   

    <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>    
</head>
<body id="app-layout" class="side_nav_hover">
        
        
        

        <!-- main content -->
            <div id="main_wrapper">
            <div class="page_content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            @yield("content")                
                        </div>
                    </div>
                </div>            
            </div>
            </div>



    <!-- JavaScripts -->

    <script type="text/javascript" src="{{ URL::asset('js/highcharts.js') }}"></script>
    <script type="text/javascript"  src="{{ URL::asset('js/highcharts-more.js') }}"></script>
    <script type="text/javascript"  src="{{ URL::asset('js/exporting.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('js/validator.min.js') }} "></script>
    <script src="{{ URL::asset('js/datatables.min.js') }}" ></script>                           

    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script> 
    <script type="text/javascript" src="{{ URL::asset('js/jquery.easing.1.3.min.js') }} "></script>
    <script type="text/javascript" src="{{ URL::asset('js/tinynav.js') }} "></script>
    <script type="text/javascript" src="{{ URL::asset('js/perfect-scrollbar-0.4.8.with-mousewheel.min.js') }} "></script>        
    <script type="text/javascript" src="{{ URL::asset('js/common.js') }} "></script>
    <script src="{{ URL::asset('js/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ URL::asset('js/dashboard.js') }}"></script>    
    <script src="{{ URL::asset('js/custom.js') }}"></script>
    <script src="{{ URL::asset('js/toastr.min.js') }}"></script>
    <script src="{{ URL::asset('js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('js/moment.js') }}"></script>
    <script src="{{ URL::asset('js/numeral.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('js/loadingoverlay.min.js') }}"></script>
    <script src="{{ URL::asset('js/loadingoverlay_progress.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.steps.min.js') }}"></script>
    <script src="{{ URL::asset('js/formValidation.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.steps.min.js') }}"></script>


<script>
  @if(Session::has('message'))
    var type = "{{ Session::get('alert-type', 'info') }}";
    switch(type){
        case 'info':
            toastr.info("{{ Session::get('message') }}");
            break;
        
        case 'warning':
            toastr.warning("{{ Session::get('message') }}");
            break;

        case 'success':
            toastr.success("{{ Session::get('message') }}");
            break;

        case 'error':
            toastr.error("{{ Session::get('message') }}");
            break;
    }
  @endif

</script>


@yield('page-js-script')
</body>
</html>
