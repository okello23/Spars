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


    <title>Laboratory SPARS</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ URL::asset('css/app.css') }}" > 
    <link rel="stylesheet" href="{{ URL::asset('css/toastr.min.css') }}" > 
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">      
    <link rel="stylesheet" href="{{ URL::asset('css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/dataTables.bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-datepicker3.min.css') }}">  
    <link rel="stylesheet" href="{{ URL::asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/font-awesome.min.css') }}">   
    <link rel="stylesheet" href="{{ URL::asset('css/formValidation.min.css') }}">       

    <script type="text/javascript" src="{{ URL::asset('js/jquery.min.js') }}"></script>    
</head>
<body id="app-layout" class="side_nav_hover">
        @if (Auth::check())
        <!-- header -->
            <header class="navbar navbar-fixed-top" role="banner">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <h4 class="logo">SPARS</h4>
                    </div>
                <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                  <a href="#" class="" data-toggle="" role="button" aria-haspopup="true" aria-expanded="false"><strong>{{ ucwords(Auth::user()->name)}} </strong></a>
                            </li>
                </ul>
                </div>
            </header>
        <!-- end header -->
        @endif

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


        @if (Auth::check() && Auth::user()->role_id == 1) <!-- DATA ENTRY ROLE-->
            <nav id="side_nav">
            <ul>

                <li>
                    <a href="{{ url('home') }}"><span class="ion-speedometer"></span> <span class="nav_title">Dashboard</span></a>
                </li>

                <li>
                    <a href="{{ url('survey') }}"><span class="ion-plus-circled"></span> <span class="nav_title">Capture</span></a>
                </li>

                

                <li>
                    <a href="{{ url('/reports/visit/individual/summary') }}">
                        <span class="ion-ios-list-outline"></span>
                        <span class="nav_title">Submitted<br>forms</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('user.password', Auth::user()->id) }}">
                        <span class="ion-key"></span> 
                        <span class="nav_title">Change password</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/logout') }}">
                        <span class="ion-log-out"></span>
                        <span class="nav_title">Logout</span>
                    </a>
                </li>
                


            </ul>
            </nav>
        @endif


        @if (Auth::check() && Auth::user()->role_id == 2) <!-- REPORTS ONLY ROLE-->
            <nav id="side_nav">
            <ul>
                <li>
                    <a href="{{ url('home') }}"><span class="ion-speedometer"></span> <span class="nav_title">Dashboard</span></a>
                </li>
                
                <li class="nav_trigger">
                    <a href="#">
                        <span class="ion-stats-bars"></span>
                        <span class="nav_title">Reports</span>
                    </a>
                    <div class="sub_panel" style="left: -220px;">
                        <div class="side_inner">
                            <ul>
                                <li><a href="#"><span class="side_icon ion-ios7-star-outline"></span> Item Availability </a></li>
                            </ul>
                            <ul>
                                <li><a href="#"><span class="side_icon ion-ios7-star-outline"></span> Order refill rate </a></li>
                            </ul>
                            <ul>
                                <li><a href="#"><span class="side_icon ion-ios7-star-outline"></span> Adherence to Ordering </a></li>
                            </ul>
                            <ul>
                                <li><a href="#"><span class="side_icon ion-ios7-star-outline"></span> Equipment functionality </a></li>
                            </ul>
                            <ul>
                                <li><a href="#"><span class="side_icon ion-ios7-star-outline"></span> Accuracy of Reporting </a></li>
                            </ul>
                        </div>
                    </div>
                </li>                

                <li>
                    <a href="{{ route('user.password', Auth::user()->id) }}">
                        <span class="ion-key"></span> 
                        <span class="nav_title">Change password</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/logout') }}">
                        <span class="ion-log-out"></span>
                        <span class="nav_title">Logout</span>
                    </a>
                </li>

            </ul>
            </nav>
        @endif


        @if (Auth::check() && Auth::user()->role_id == 3) <!-- DATA MANAGER -->
            <nav id="side_nav">
            <ul>

                <li>
                    <a href="{{ url('home') }}"><span class="ion-speedometer"></span> <span class="nav_title">Dashboard</span></a>
                </li>
                

                <li>
                    <a href="{{ url('survey') }}"><span class="ion-plus-circled"></span> <span class="nav_title">Capture</span></a>
                </li>

                

                <li>
                    <a href="{{ url('/reports/visit/individual/summary') }}">
                        <span class="ion-ios-list-outline"></span>
                        <span class="nav_title">Submitted<br>forms</span>
                    </a>
                </li>


                <li class="nav_trigger">
                    <a href="#">
                        <span class="ion-stats-bars"></span>
                        <span class="nav_title">Extracts</span>
                    </a>
                    <div class="sub_panel" style="left: -220px;">
                        <div class="side_inner">
                            <ul>
                                <li><a href="{{ url('/reports/visit/summary') }}"><span class="side_icon ion-ios7-star-outline"></span> Survey Summary </a></li>
                            </ul>
                            <ul>
                                <li><a href="{{ url('/reports/visit/scores') }}"><span class="side_icon ion-ios7-star-outline"></span> Scores Summary </a></li>
                            </ul>
                            <ul>
                                <li><a href="{{ url('/reports/extract/indicator') }}"><span class="side_icon ion-ios7-star-outline"></span> Extract by Indicator </a></li>
                            </ul>
                            <ul>
                                <li><a href="{{ url('/reports/extract/audit') }}"><span class="side_icon ion-ios7-star-outline"></span> Audit trail </a></li>
                            </ul>
                        </div>
                    </div>
                </li>


                <li class="nav_trigger">
                    <a href="#">
                        <span class="ion-stats-bars"></span>
                        <span class="nav_title">Reports</span>
                    </a>
                    <div class="sub_panel" style="left: -220px;">
                        <div class="side_inner">
                            <ul>
                                <li><a href="#"><span class="side_icon ion-ios7-star-outline"></span> Item Availability </a></li>
                            </ul>
                            <ul>
                                <li><a href="#"><span class="side_icon ion-ios7-star-outline"></span> Order refill rate </a></li>
                            </ul>
                            <ul>
                                <li><a href="#"><span class="side_icon ion-ios7-star-outline"></span> Adherence to Ordering </a></li>
                            </ul>
                            <ul>
                                <li><a href="#"><span class="side_icon ion-ios7-star-outline"></span> Equipment functionality </a></li>
                            </ul>
                            <ul>
                                <li><a href="#"><span class="side_icon ion-ios7-star-outline"></span> Accuracy of Reporting </a></li>
                            </ul>
                        </div>
                    </div>
                </li>       

                <li>
                    <a href="{{ route('user.password', Auth::user()->id) }}">
                        <span class="ion-key"></span> 
                        <span class="nav_title">Change password</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/logout') }}">
                        <span class="ion-log-out"></span>
                        <span class="nav_title">Logout</span>
                    </a>
                </li>
                
                <li class="nav_trigger hidden">
                    <a href="#">
                        <span class="ion-wrench"></span>
                        <span class="nav_title">Settings</span>
                    </a>
                    <div class="sub_panel" style="left: -220px;">
                        <div class="side_inner">
                            <ul>
                                <li class="hidden"><a href="{{ url('/district') }}"><span class="side_icon ion-ios7-star-outline"></span> District</a></li>
                                <li class="hidden"><a href="{{ url('/subdistrict') }}"><span class="side_icon ion-ios7-star-outline"></span> Sub district</a></li>                                
                                <li><a href="{{ url('/facility') }}"><span class="side_icon ion-ios7-calendar-outline"></span> Facility</a></li>
                                <li><a href="{{ url('/cadre') }}"><span class="side_icon ion-ios7-calendar-outline"></span> Cadre</a></li>                                                                
                                <li class="hidden"><a href="{{ url('/personnel') }}"><span class="side_icon ion-ios7-calendar-outline"></span> Personnel</a></li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li class="hidden">
                    <a href="#">
                        <span class="ion-key"></span>
                        <span class="nav_title">Access Control</span>
                    </a>
                    <div class="sub_panel" style="left: -220px;">
                        <div class="side_inner">
                            <ul>
                                <li><a href="#"><span class="side_icon ion-ios7-star-outline"></span> Roles</a></li>
                                <li><a href="#"><span class="side_icon ion-ios7-calendar-outline"></span> Users</a></li>
                            </ul>
                        </div>
                    </div>
                </li>

            </ul>
            </nav>
        @endif


        @if (Auth::check() && Auth::user()->role_id == 4) <!-- ADMIN -->
            <nav id="side_nav">
            <ul>

                <li>
                    <a href="{{ url('home') }}"><span class="ion-speedometer"></span> <span class="nav_title">Dashboard</span></a>
                </li>
                

                <li>
                    <a href="{{ url('survey') }}"><span class="ion-plus-circled"></span> <span class="nav_title">Capture</span></a>
                </li>

                

                <li>
                    <a href="{{ url('/reports/visit/individual/summary') }}">
                        <span class="ion-ios-list-outline"></span>
                        <span class="nav_title">Submitted<br>forms</span>
                    </a>
                </li>


                <li class="nav_trigger">
                    <a href="#">
                        <span class="ion-stats-bars"></span>
                        <span class="nav_title">Extracts</span>
                    </a>
                    <div class="sub_panel" style="left: -220px;">
                        <div class="side_inner">
                            <ul>
                                <li><a href="{{ url('/reports/visit/summary') }}"><span class="side_icon ion-ios7-star-outline"></span> Survey Summary </a></li>
                            </ul>
                            <ul>
                                <li><a href="{{ url('/reports/visit/scores') }}"><span class="side_icon ion-ios7-star-outline"></span> Scores Summary </a></li>
                            </ul>
                            <ul>
                                <li><a href="{{ url('/reports/extract/indicator') }}"><span class="side_icon ion-ios7-star-outline"></span> Extract by Indicator </a></li>
                            </ul>
                            <ul>
                                <li><a href="{{ url('/reports/extract/audit') }}"><span class="side_icon ion-ios7-star-outline"></span> Audit trail </a></li>
                            </ul>
                        </div>
                    </div>
                </li>


                <li class="nav_trigger">
                    <a href="#">
                        <span class="ion-stats-bars"></span>
                        <span class="nav_title">Reports</span>
                    </a>
                    <div class="sub_panel" style="left: -220px;">
                        <div class="side_inner">
                            <ul>
                                <li><a href="#"><span class="side_icon ion-ios7-star-outline"></span> Item Availability </a></li>
                            </ul>
                            <ul>
                                <li><a href="#"><span class="side_icon ion-ios7-star-outline"></span> Order refill rate </a></li>
                            </ul>
                            <ul>
                                <li><a href="#"><span class="side_icon ion-ios7-star-outline"></span> Adherence to Ordering </a></li>
                            </ul>
                            <ul>
                                <li><a href="#"><span class="side_icon ion-ios7-star-outline"></span> Equipment functionality </a></li>
                            </ul>
                            <ul>
                                <li><a href="#"><span class="side_icon ion-ios7-star-outline"></span> Accuracy of Reporting </a></li>
                            </ul>
                        </div>
                    </div>
                </li>       

                <li class="nav_trigger">
                    <a href="#">
                        <span class="ion-wrench"></span>
                        <span class="nav_title">Settings</span>
                    </a>
                    <div class="sub_panel" style="left: -220px;">
                        <div class="side_inner">
                            <ul>
                                <li class="hidden"><a href="{{ url('/district') }}"><span class="side_icon ion-ios7-star-outline"></span> District</a></li>
                                <li class="hidden"><a href="{{ url('/subdistrict') }}"><span class="side_icon ion-ios7-star-outline"></span> Sub district</a></li>                                
                                <li><a href="{{ url('/facility') }}"><span class="side_icon ion-ios7-calendar-outline"></span> Facility</a></li>
                                <li><a href="{{ url('/cadre') }}"><span class="side_icon ion-ios7-calendar-outline"></span> Cadre</a></li>                                                                
                                <li class="hidden"><a href="{{ url('/personnel') }}"><span class="side_icon ion-ios7-calendar-outline"></span> Personnel</a></li>
                            </ul>
                        </div>
                    </div>
                </li>

                <li>
                    <a href="#">
                        <span class="ion-key"></span>
                        <span class="nav_title">Access Control</span>
                    </a>
                    <div class="sub_panel" style="left: -220px;">
                        <div class="side_inner">
                            <ul>
                                <li><a href="#"><span class="side_icon ion-ios7-star-outline"></span> Roles</a></li>
                                <li><a href="#"><span class="side_icon ion-ios7-calendar-outline"></span> Users</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                
                <li>
                    <a href="{{ route('user.password', Auth::user()->id) }}">
                        <span class="ion-key"></span> 
                        <span class="nav_title">Change password</span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/logout') }}">
                        <span class="ion-log-out"></span>
                        <span class="nav_title">Logout</span>
                    </a>
                </li>
                
            </ul>
            </nav>
        @endif

    <!-- JavaScripts -->

    <script type="text/javascript" src="{{ URL::asset('js/highcharts.js') }}"></script>
    <script type="text/javascript"  src="{{ URL::asset('js/highcharts-more.js') }}"></script>
    <script type="text/javascript"  src="{{ URL::asset('js/exporting.js') }}"></script>

    <script type="text/javascript" src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/validator.min.js') }} "></script>
    <script src="{{ URL::asset('js/moment.js') }}"></script>
    <script src="{{ URL::asset('js/datatables.min.js') }}" ></script>
    <script src="{{ URL::asset('js/datetime.js') }}"></script>                           
 
    <script type="text/javascript" src="{{ URL::asset('js/jquery.easing.1.3.min.js') }} "></script>
    <script type="text/javascript" src="{{ URL::asset('js/tinynav.js') }} "></script>
    <script type="text/javascript" src="{{ URL::asset('js/perfect-scrollbar-0.4.8.with-mousewheel.min.js') }} "></script>        
    <script type="text/javascript" src="{{ URL::asset('js/common.js') }} "></script>
    <script src="{{ URL::asset('js/jquery.easypiechart.min.js') }}"></script>
    <script src="{{ URL::asset('js/dashboard.js') }}"></script>    
    <script src="{{ URL::asset('js/toastr.min.js') }}"></script>
    <script src="{{ URL::asset('js/select2.min.js') }}"></script>
    <script src="{{ URL::asset('js/numeral.min.js') }}"></script>
    <script src="{{ URL::asset('js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ URL::asset('js/loadingoverlay.min.js') }}"></script>
    <script src="{{ URL::asset('js/loadingoverlay_progress.min.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.steps.js') }}"></script>
    <script src="{{ URL::asset('js/jquery.steps.min.js') }}"></script>
    <script src="{{ URL::asset('js/formValidation.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.steps.min.js') }}"></script>
    <script src="{{ URL::asset('js/custom.js') }}"></script>

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
