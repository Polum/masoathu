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
                                            <span class="txt-light counter counter-anim messages-total"></span>
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
                                            <span class="txt-light counter messages-correct"></span>
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
                                            <span class="txt-light counter messages-incident">50</span>
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
                                            <h6 class="txt-light">Incident injuries <br/></h6>
                                            <span class="txt-light counter messages-incident-resolved">100</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End Row -->
            <!-- Row -->
            <div class="row">
                <div class="col-lg-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                The location of the Polling Station was in a safe and convenient location for the women (Overall)</h6>
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
                                <h6 class="panel-title txt-dark"><i class="icon-pie-chart mr-10"></i>Security Personnel have been able to maintain order at the Polling Station
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
                                <h6 class="panel-title txt-dark"><i class="icon-pie-chart mr-10"></i>
                                    Party representatives were soliciting to buy votes at Polling Station location (Overall)</h6>
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
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                    Party representatives were campaigning at or near Polling Station. (Overall)</h6>
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
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                    Number of Party Representatives present (Overall)</h6>
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
            {{-- <div class="row">
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
            </div> --}}

        <div id="img-out"></div>


    </div>

@stop

@section('scripts')
    <script type="application/javascript">

        var pageName = "dashboard";
        var regCenterData;
        var currentCenterName;
        var observerData;
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


    <script src="vendors/custom_js/dashboard2.js"></script>

@stop