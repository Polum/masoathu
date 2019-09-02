@extends('admin.app')

@section('content')

    <div class="container-fluid" id="theCanvas">

        <!-- Title -->
        <div class="row heading-bg  bg-blue">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-light">System Dashboard</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="active"><span>Control Room</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->
        <!-- Row -->
        <div class="row loader-overlay-parent">
            <div class="loader-overlay" style="position: absolute; height: 500px; width:500px; background: rgb(238,238,238); z-index:1;">
                <div class="loader" style="margin-left: auto;margin-right: auto;"></div>
                <div class="progress" style="margin-left: auto;margin-right: auto; padding:40px; text-align: center; height: 100px; width: 500px; background: inherit;">
                    <h4>Loading Registration Centers</h4>

                </div>
            </div>

            <!-- Row -->
            <div class="row">

                <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box bg-green">
                                    <div class="row ma-0">
                                        <div class="col-xs-5 text-center pa-0 icon-wrap-left">
                                            <i class="icon-speech txt-light"></i>
                                        </div>
                                        <div class="col-xs-7 text-center data-wrap-right">
                                            <h6 class="txt-light">Incoming Messages</h6>
                                            <span class="txt-light counter counter-anim messages-total">{{ $totalSMSCount }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box bg-blue">
                                    <div class="row ma-0">
                                        <div class="col-xs-5 text-center pa-0 icon-wrap-left">
                                            <i class="icon-pencil txt-light"></i>
                                        </div>
                                        <div class="col-xs-7 text-center data-wrap-right">
                                            <h6 class="txt-light">Reports Generated</h6>
                                            <span class="txt-light counter messages-correct">{{ $totalCorrectSMS }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box bg-red">
                                    <div class="row ma-0">
                                        <div class="col-xs-5 text-center pa-0 icon-wrap-left">
                                            <i class="icon-flag txt-light"></i>
                                        </div>
                                        <div class="col-xs-7 text-center data-wrap-right">
                                            <h6 class="txt-light">Incidence <br/>Alerts</h6>
                                            <span class="txt-light counter messages-incident">{!! $flaggedIncidentsCount !!}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-5 col-xs-12">
                    <div class="panel panel-default card-view pa-0">
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body pa-0">
                                <div class="sm-data-box bg-green">
                                    <div class="row ma-0">
                                        <div class="col-xs-5 text-center pa-0 icon-wrap-left">
                                            <i class="icon-flag txt-light"></i>
                                        </div>
                                        <div class="col-xs-7 text-center data-wrap-right">
                                            <h6 class="txt-light">Incidents <br/>REsolved</h6>
                                            <span class="txt-light counter messages-incident-resolved">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bordered Table -->
            {{--<div class="col-lg-9 col-md-8 col-sm-7 col-xs-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Recently Generated Reports</h6>
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
                                        </tr>
                                        </thead>
                                        <tbody class="message-recent">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
            <!-- /Bordered Table -->
            </div>
            <!-- End Row -->
            <!-- Row -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>Percentage of
                                    Registrants
                                    (Overall)</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="male_female_bar_chart_overall" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-pie-chart mr-10"></i>Number of
                                    Registrants
                                    (Overall)</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="male_female_chart_overall" style="height: 190px;"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-pie-chart mr-10"></i>Organisation
                                    Mobilisation (Overall)</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="Q47_chart_overall" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
            <!-- Row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>Percentage of
                                    organisations
                                    Doing Mobilisation (Overall)</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="Q47_bar_overall" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>Percentage of
                                    organisations
                                    Mobilisation Strategies (Overall)</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="Q50_bar_overall" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->

            <!-- Row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>Incidents (Overall)</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="incident_bar_overall" style="height: 580px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->
            <!-- Row -->
            {{--<div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>Number of Messages Per
                                    Region (Overall)</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="region_bar_overall" style="height: 380px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>Number of Messages Per
                                    District (Overall)</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="district_bar_overall" style="height: 380px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
            <!-- End Row -->
            <!-- Row -->
            {{--<div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>Number of Messages Per
                                    Constituency (Overall)</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="constituency_bar_overall" style="height: 380px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>Number of Messages Per
                                    Ward (Overall)</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="ward_bar_overall" style="height: 380px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>Number of Messages Per
                                    Registration Center (Overall)</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="reg_center_bar_overall" style="height: 450px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>--}}
            <!-- End Row -->
            <!-- Row -->
        {{--<div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>Number of Monitors Sending
                                SMS Registration Center (Overall)</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div id="monitors_bar_chart_overall" style="height: 450px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>--}}
        <!-- End Row -->

            <!-- Row -->
           {{-- <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="panel panel-success card-view">
                        <div class="panel-heading mb-20">
                            <div class="pull-left">
                                <h6 class="panel-title txt-light pull-left">Active Observers</h6>
                            </div>
                            <div class="pull-right">
                                <a class="txt-light" href="javascript:void(0);"><i class="ti-plus"></i></a>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <ul class="chat-list-wrap">
                                    <li class="chat-list">
                                        <div class="chat-body observers-list">

                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-support mr-10"></i>Observer Statistics
                                </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">

                            <div class="panel-body">
                                <div id="observerStats" style="height: 750px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /Row -->--}}
        </div>
        <!-- End Row -->
        <div id="img-out"></div>


    </div>

@stop

@section('scripts')
    <script type="application/javascript">

        var pageName = "dashboard";
        var smsUrl = {!! json_encode($registeredVoters->toArray(), JSON_HEX_TAG) !!};
        var incidentUrl = "{{ url('sms-by-incident') }}"
        var genderUrl = "{{ url('sms-by-question-number/68') }}";
        var questionUrl = "{{ url('sms-by-question-number') }}";
        var regCenterUrl = "{{ url('polling-station-resources') }}";
        var observerUrl = "{{ url('observer-resources') }}";
        var incidentCategoryUrl = "{{ url('incident-type-resources') }}";
        var questionSetUrl = "{{ url('question-resources') }}";
        var regCenterData;
        var currentCenterName;
        var observerData;
        var questionSetData = {!! json_encode($questionData->toArray(), JSON_HEX_TAG) !!};
        var incidentData = {!! json_encode($incidentData->toArray(), JSON_HEX_TAG) !!};
        var smsData;
        var incidentCount = 0;
        var correctMessaegsCount = 0;
        var totalMessagesCount = 0;
        var maleCount = 0;
        var femaleCount = 0;
        var yesResponsesq47 = 0;
        var noResponsesq47 = 0;
        var predefinedResponses47 = new Array();
        var predefinedResponses50 = new Array();
        var observerMessageCount = new Array();
        var observerIncidentCount = new Array();
        var regCenterCount = new Array();
        var wardCount = new Array();
        var districtCount = new Array();
        var constituencyCount = new Array();
        var regionCount = new Array();
        var numberPerDistrictCount = new Array();
        var incidentColours =   ['#C1232B', '#bfc31c', '#27727B', '#60C0DD', '#fcb500', '#e800a6', '#5d85fe', '#0eca21', '#b0a3fa', '#F3A43B', '#D7504B', '#C6E579', '#F4E001', '#F0805A', '#26C0C0'];
        var incidentColoursBackground =   ['#C1232B1a', '#bfc31c1a', '#27727B1a', '#60C0DD1a', '#fcb5001a', '#e800a61a', '#5d85fe1a', '#0eca211a', '#b0a3fa1a', '#F3A43B1a', '#D7504B1a', '#C6E5791a', '#F4E0011a', '#F0805A1a', '#26C0C01a'];

    </script>

    <script src="vendors/custom_js/visuals/echarts/echarts_new.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
    <script src="vendors/custom_js/html2canvas.min.js"></script>
    <script src="vendors/custom_js/html2canvas.js"></script>--}}


    <script src="vendors/custom_js/dashboard.js"></script>

@stop