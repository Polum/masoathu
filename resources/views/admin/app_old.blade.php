<!DOCTYPE html>
<html lang="en">

{{--  Mirrored from hencework.com/theme/kenny/index3.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 08 Apr 2018 10:19:58 GMT  --}}
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <title>Maso Athu</title>
    <meta name="description" content="Maso Athu"/>
    <meta name="keywords" content="Maso Athu"/>
    <meta name="author" content="mHub"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- vector map CSS -->
    <link href="vendors/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" type="text/css"/>

    <!-- Data table CSS -->
    <link href="vendors/bower_components/datatables/media/css/jquery.dataTables.min.css" rel="stylesheet"
          type="text/css"/>


    <link href="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css" rel="stylesheet"
          type="text/css">

    <!-- Jasny-bootstrap CSS -->
    <link href="vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css" rel="stylesheet"
          type="text/css"/>
    <!-- Custom CSS -->
    <link href="dist/css/style.css" rel="stylesheet" type="text/css">

    <link href="dist/css/custom.css" rel="stylesheet" type="text/css">



    @yield('extra_css')
</head>

<body>
<!--Preloader-->
<div class="preloader-it">
    <div class="la-anim-1"></div>
</div>
<!--/Preloader-->

<div class="wrapper">
@guest
@else
    <!-- Top Menu Items -->
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block mr-20 pull-left"
               href="javascript:void(0);"><i
                        class="fa fa-bars"></i></a>
            <a href="{{url('/')}}"><img class="brand-img pull-left" src="{{url('dist/img/logo.png')}}" alt="Maso Athu"/></a>
            <ul class="nav navbar-right top-nav pull-right">
                 <li>
                    <a href="{{ url("incident-reports") }}"><i class="icon-flag"></i><span class="top-nav-icon-badge">{!! print_r($flaggedIncidentsCount,  true) !!} </span>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><i class="fa fa-user"
                                                                                       style="font-size:25px"></i><span
                                class="user-online-status"></span></a>
                    <ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">

                        <li>
                            <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                        class="fa fa-fw fa-power-off"></i> Log Out</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /Top Menu Items -->

        <!-- Left Sidebar Menu -->
        <div class="fixed-sidebar-left">
            <ul class="nav navbar-nav side-nav nicescroll-bar">
                <li>
                    <a href="{{url('/')}}" data-toggle="collapse" data-target="#dashboard_dr"><i
                                class="icon-picture mr-10"></i>Dashboard Panel</a>
                </li>
               {{-- <li>
                    <a href="{{url('administrative-divisions')}}" data-toggle="collapse" data-target="#dashboard_dr"><i
                                class="icon-people mr-10"></i> Administrative Divisions</a>
                </li>--}}
                <li>
                    <a href="{{url('users')}}" data-toggle="collapse" data-target="#dashboard_dr"><i
                                class="icon-people mr-10"></i> Users</a>
                </li>
                
                <li>
                    <a href="{{url('map-overview')}}" data-toggle="collapse" data-target="#ecom_dr"><i
                                class="icon-map mr-10"></i>Map Reports</a>
                </li>

                <li>
                    <a href="{{url('observer-checklist-report')}}"><i
                                class="icon-note  mr-10"></i>Observer Check List Reports</a>
                </li>
                <li>
                    <a href="{{url('incident-reports')}}"><i
                                class="icon-note  mr-10"></i>Incident Reports</a>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#observer_dr"><i
                                class=" icon-list mr-10"></i>Observers & CheckList<span class="pull-right"><i
                                    class="fa fa-fw fa-angle-down"></i></span></a>

                    <ul id="observer_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="{{url('observers')}}" data-toggle="collapse" data-target="#dashboard_dr">List of
                                Observers </a>
                        </li>

                        <li>
                            <a href="{{url('questions')}}" data-toggle="collapse" data-target="#dashboard_dr">Check List
                                Categories</a>
                        </li>

                        <li>
                            <a href="{{url('questions')}}" data-toggle="collapse" data-target="#dashboard_dr">Check List
                                Questions</a>
                        </li>

                        <li>
                            <a href="{{url('map-overview')}}" data-toggle="collapse" data-target="#dashboard_dr">Check
                                List
                                Form</a>
                        </li>

                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#incident_dr"><i
                                class="icon-bell mr-10"></i>Incidents<span class="pull-right"><i
                                    class="fa fa-fw fa-angle-down"></i></span></a>

                    <ul id="incident_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="{{url('map-overview')}}" data-toggle="collapse" data-target="#dashboard_dr">Incident
                                Categories </a>
                        </li>

                        <li>
                            <a href="{{url('map-overview')}}" data-toggle="collapse" data-target="#dashboard_dr">Incident
                                Form</a>
                        </li>

                    </ul>
                </li>


                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#messages_dr"><i
                                class="icon-speech mr-10"></i>Messages<span class="pull-right"><i
                                    class="fa fa-fw fa-angle-down"></i></span></a>

                    <ul id="messages_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="{{url('open-reports')}}">Open Messages</a>
                        </li>
                        <li>
                            <a href="{{url('open-messages')}}">Processed Messages</a>
                        </li>


                    </ul>
                </li>

                <li>
                    <a href="javascript:void(0);" data-toggle="collapse" data-target="#reports_dr"><i
                                class="icon-note  mr-10"></i>Reports<span class="pull-right"><i
                                    class="fa fa-fw fa-angle-down"></i></span></a>

                    <ul id="reports_dr" class="collapse collapse-level-1">
                        <li>
                            <a href="{{url('observer-checklist-report')}}">Observer Check List Reports</a>
                        </li>
                        <li>
                            <a href="{{url('incident-reports')}}">Incident Reports</a>
                        </li>
                        <li>
                            <a href="{{url('checklist-reports')}}">Checklist Reports</a>
                        </li>
                        <li>
                            <a href="{{url('candidate-reports')}}">Candidate Reports</a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="{{url('candidate-reports')}}"><i class="icon-picture mr-10"></i>Candidate Reports</a>
                </li>
{{--
                <li>
                    <a href="{{url('/')}}" data-toggle="collapse" data-target="#dashboard_dr"><i
                                class="icon-picture mr-10"></i>Status Reports</a>
                </li>--}}


            </ul>
        </div>
        <!-- /Left Sidebar Menu -->
@endguest

<!-- Main Content -->
    <div class="page-wrapper">


    @yield('content')

    <!-- Footer -->
        <footer class="footer container-fluid pl-30 pr-30">
            <div class="row">
                <div class="col-sm-5">
                    <a href="{{('/')}}" class="brand mr-30"><img src="dist/img/logo-sm.png" height="40"
                                                                 alt="Maso Athu"/></a>
                    <ul class="footer-link nav navbar-nav">

                    </ul>
                </div>
                <div class="col-sm-7 text-right">
                    <p>2018 &copy; MASO ATHU. a product by mHub</p>
                </div>
            </div>
        </footer>
        <!-- /Footer -->

    </div>
    <!-- /Main Content -->

</div>
<!-- /#wrapper -->


<!-- jQuery -->
<script src="{{ asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- JavaScript -->
<script src="{{ asset('//code.jquery.com/ui/1.11.4/jquery-ui.js') }}"></script>
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<!-- Counter Animation JavaScript -->
<script src="{{ asset('vendors/bower_components/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/Counter-Up/jquery.counterup.min.js') }}"></script>

<!-- Data table JavaScript -->
<script src="{{ asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>
@yield('scripts')
<script src="{{ asset('dist/js/productorders-data.js') }}"></script>


<!-- Slimscroll JavaScript -->
<script src="{{ asset('dist/js/jquery.slimscroll.js') }}"></script>

<!-- Fancy Dropdown JS -->
<script src="{{ asset('dist/js/dropdown-bootstrap-extended.js') }}"></script>

<!-- Sparkline JavaScript -->
<script src="{{ asset('vendors/jquery.sparkline/dist/jquery.sparkline.min.js') }}"></script>

<script src="{{ asset('dist/js/skills-counter-data.js') }}"></script>

<!-- ChartJS JavaScript -->
<script src="{{ asset('vendors/chart.js/Chart.min.js') }}"></script>

<!-- Morris Charts JavaScript -->
<script src="{{ asset('vendors/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/morris.js/morris.min.js') }}"></script>

<script src="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>

<!-- Init JavaScript -->
<script src="{{ asset('dist/js/init.js') }}"></script>
<script src="{{ asset('dist/js/dashboard3-data.js') }}"></script>

</body>


</html>
