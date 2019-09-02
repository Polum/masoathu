@extends('admin.app')


@section('extra_css')
    <!-- select2 CSS -->
    <link href="vendors/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>

    <!-- bootstrap-select CSS -->
    <link href="vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet"
          type="text/css"/>
    <!-- noUiSlider Css -->
    <link href="dist/css/components.css" rel="stylesheet" type="text/css"/>
    <!-- Ion.RangeSlider -->
    <link href="vendors/bower_components/ion.rangeSlider/css/ion.rangeSlider.css" rel="stylesheet" type="text/css">
    <link href="vendors/bower_components/ion.rangeSlider/css/ion.rangeSlider.skinModern.css" rel="stylesheet"
          type="text/css">
@stop

@section('content')

    <div class="container-fluid">


        <!-- Title -->
        <div class="row heading-bg bg-green">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-light">Observer Checklist Reports</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Dashboard</a></li>
                    <li><a href="#"><span>Reports</span></a></li>
                    <li class="active"><span>Observer Cheklist</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->
        <!-- Row -->
        <!-- Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">SELECT A LOCATION</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <p class="text-muted">Pick a location to view results for, you can view results by district
                                by selecting all in the constituency dropdown</p>
                            <div class="form-wrap mt-40">
                                <form>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group regions">

                                                {{-- <select class="selectpicker " data-style="form-control">
                                                     <option>Nothing Selected</option>
                                                 </select>--}}
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group districts">

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group constituencies">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group wards">

                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-body border-top-primary">
                    <div class="text-center">
                        <h6 class="no-margin text-semibold">Get results from: </h6>
                        <p class="content-group-sm text-muted" id="selected_admin_filter"></p>
                    </div>
                    <div class="noui-slider-info has-pips" id="noui-slider-pips-filter"></div>
                </div>
            </div>
        </div>
        <!-- /Row -->


        <!-- Row -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="row">
                            {{--<div class="col-md-4">
                                <div class="pull-left">
                                    <h6 class="panel-title txt-dark"><i class="icon-support mr-10"></i></h6>
                                </div>
                            </div>--}}
                            <div class="col-md-12">

                                <div class="form-group">
                                    <label class="control-label mb-10 poll-select">SELECT A REGISTRATION STATION
                                        CATEGORY</label>

                                    </select>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <!-- <canvas id="chart_candidates" height="447"></canvas> -->
                            <!-- <div id="poll_bar_stacked" class="morris-chart" style="height:0px;"></div> -->
                        </div>
                        <div class="panel-body">
                            <div id="chart" style="height: 450px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->
    </div>

@stop


@section('scripts')

    <script type="text/javascript">
        var morrisBar;
        var morrisLine;
        var ctx2;
        var hBar;
        var smsUrl = "{{ url('sms-resources') }}";
        var questionsUrl = "{{ url('question-resources') }}";
        var regCenterUrl = "{{ url('polling-station-resources') }}";
        var adminDivisionsUrl = "{{ url('admin-division-resources') }}";
        var adminDivisions;
        var RegistrationCenterData;
        var questionData;
        var smsData;
    </script>
    <script src="vendors/custom_js/visuals/echarts/echarts_new.js"></script>
    <!-- Moment JavaScript -->
    <script type="text/javascript"
            src="vendors/bower_components/moment/min/moment-with-locales.min.js"></script>
    <!-- Select2 JavaScript -->
    <script src="vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
    {{--  <script src="vendors/bower_components/ion.rangeSlider/js/ion.rangeSlider.min.js"></script>--}}


    <!-- Theme JS files -->
    <script type="text/javascript" src="vendors/bower_components/nouislider/slider_pips.min.js"></script>

    <!-- Bootstrap Select JavaScript -->
    <script src="vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <!-- Bootstrap Select JavaScript -->

    <script type="text/javascript">
        var dropDownScript = "{{  asset('vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js') }}";
    </script>

    <!-- Bootstrap Tagsinput JavaScript -->
    <script src="vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>


    <script src="vendors/custom_js/polling_stations_reports.js"></script>

@stop