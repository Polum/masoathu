@extends('admin.app')

<!-- Bootstrap Colorpicker CSS -->
<link href="vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css"
      rel="stylesheet" type="text/css"/>

<!-- select2 CSS -->
<link href="vendors/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>

<!-- Morris Charts CSS -->
<link href="vendors/bower_components/morris.js/morris.css" rel="stylesheet" type="text/css"/>

<!-- switchery CSS -->
<link href="vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css"/>

<!-- bootstrap-select CSS -->
<link href="vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet"
      type="text/css"/>

<!-- bootstrap-tagsinput CSS -->
<link href="vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet"
      type="text/css"/>

<!-- bootstrap-touchspin CSS -->
<link href="vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet"
      type="text/css"/>

<!-- multi-select CSS -->
<link href="vendors/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css"/>

<!-- Bootstrap Switches CSS -->
<link href="vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet"
      type="text/css"/>

<!-- Bootstrap Datetimepicker CSS -->
<link href="vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css"
      rel="stylesheet" type="text/css"/>


<!-- Custom CSS -->
<link href="dist/css/style.css" rel="stylesheet" type="text/css">

@section('content')


    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg  bg-yellow">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-light">Incidents</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/dashboard') }}">Dashboard</a></li>
                    <li><a href="#"><span>Reports</span></a></li>
                    <li class="active"><span>Incidents</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->
        <!-- Row -->
        <div class="row">
            {{--            <div class="col-lg-3 col-md-4 col-sm-12">
                            <div class="panel panel-default card-view">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h6 class="panel-title txt-dark">Region</h6>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">
                                        <div class="sm-graph-box">
                                            <div class="row districts-incident">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default card-view">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h6 class="panel-title txt-dark">Districts</h6>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">
                                        <div class="sm-graph-box">
                                            <div class="row constituency-incident">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default card-view">
                                <div class="panel-heading">
                                    <div class="pull-left">
                                        <h6 class="panel-title txt-dark">Constituency</h6>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-wrapper collapse in">
                                    <div class="panel-body">
                                        <div class="sm-graph-box">
                                            <div class="row ward-incident">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>--}}
           {{-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark"><i class="icon-share mr-10"></i>Incident Reports
                                    </h6>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <form>
                                    <div class="form-group">
                                        <label class="control-label mb-10"> View By</label>
                                        <select class="form-control select2 incident-filter">
                                            <option>Select</option>
                                            <option value="1">Category</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div id="incident_line_chart" class="morris-chart" style="height:442px;"></div>
                    </div>
                </div>
            </div>--}}
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark"><i class="icon-pie-chart mr-10"></i>Incidents Per Day</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div id="incidentsPerDay" style="height: 380px;"></div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /Row -->
        <!-- Row -->
        <div class="row">
            <!-- Bordered Table -->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Incidents Reported</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered mb-0">
                                        <thead>
                                        <tr>
                                            <th>Via Channel</th>
                                            <th>Report Sender</th>
                                            <th>Body</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th>Center</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody class="incidents-list">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Bordered Table -->
        </div>

    </div>
@stop


@section('scripts')
    <script type="text/javascript">
        var flaggedIncidentsUrl = "{{ url('flagged-resources') }}";
        var adminDivisionsUrl = "{{ url('') }}";
        var regCenterUrl = "{{ url('polling-station-resources') }}";
        var regCenterData;
        var observerUrl = "{{ url('observer-resources') }}";
        var incidentCategoryUrl = "{{ url('incident-type-resources') }}";
        var observerIncidentCount = new Array();
        var observerData;
        var incidentColoursBackground =   ['#C1232B66', '#bfc3166c', '#27727B66', '#60C0DD66', '#fcb50066', '#e800a666', '#5d85fe66', '#0eca2166', '#b0a3fa66', '#F3A43B66', '#D7504B66', '#C6E579cc', '#F4E00166', '#F0805A66', '#26C0C066'];
    </script>

    <script src="vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="vendors/bower_components/datatables.net-buttons/js/buttons.flash.min.js"></script>

    <!-- Select2 JavaScript -->
    <script src="vendors/bower_components/select2/dist/js/select2.full.min.js"></script>

    <!-- Bootstrap Select JavaScript -->
    <script src="vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>

    <!-- Multiselect JavaScript -->
    <script src="vendors/bower_components/multiselect/js/jquery.multi-select.js"></script>

    <script src="vendors/custom_js/visuals/echarts/echarts_new.js"></script>

    <script src="vendors/custom_js/incident.js"></script>


@stop