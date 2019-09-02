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

            <div class="row">
                <div class="col-md-12 mb-15">
                    <div class="btn-group btn-group-justified">
                        <a class="btn btn-default btn-outline" role="button" href="{{ url('/observer_response') }}">Morning Timeline (6:00am - 10:00am)</a>
                        <a class="btn btn-warning" role="button" href="{{ url('/afternoon') }}">Afternoon Timeline (10:01am - 2:00pm)</a>
                        <a class="btn btn-default btn-outline" role="button" href="{{ url('/evening') }}">Evening Timeline (2:01pm - 6:00pm)</a>
                    </div>
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
                                            <span class="txt-light counter counter-anim incoming_messages"></span>
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
                                            <span class="txt-light counter reports_generated"></span>
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
                                            <h6 class="txt-light">Incidence Alerts</h6>
                                            <span class="txt-light counter incidence_alert"></span>
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
                                            <h6 class="txt-light">Critical incidences <br/></h6>
                                            <span class="txt-light counter critical_incidences"></span>
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
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                Polling Station was in a safe and convenient location for women </h6>
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
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-pie-chart mr-10"></i>Security Personnel have been able to maintain order at the Polling Station
                                    </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="order_maintained_overall" style="height: 190px;"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-pie-chart mr-10"></i>
                                    Party representatives were soliciting to buy votes at Polling Station location </h6>
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
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                Polling Station still open </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="polling_station_opened_on_time" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-pie-chart mr-10"></i>voting queues Present
                                    </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="long_queues" style="height: 190px;"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-pie-chart mr-10"></i>Electoral Commission Officials present </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="electral_commision_officials_present" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->

            <!-- Row -->
            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                Security personnel present </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="security_personel_present" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                    Ballot papers were sealed and opened in the presence of officials. </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="sealed_ballot_papers_overall" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                    Voters from other stations were allowed to vote. </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="other_station_voters_allowed" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->

            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-pie-chart mr-10"></i>
                                    Voters names ticked off the voter register after they were identified</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="ticked_voter_after_identification" style="height: 190px;"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                    Party representatives were campaigning at or near Polling Station. </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="Q47_bar_overall" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                    Voters asked to show voter registration certificate. </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="show_voter_registration_certificate_overall" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-pie-chart mr-10"></i>Registration certificates embossed after voting
                                    </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="registration_certificate_embossed" style="height: 190px;"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                    Voter procedure explained by MEC. </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="voter_procedure_explained" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                    Voters given privacy to cast votes. </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="voters_given_privacy" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-pie-chart mr-10"></i>Some voters were not given 3 different ballot papers to vote
                                    </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="voters_not_given_three_different_ballot_papers" style="height: 190px;"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                    Some voters were given new ballot papers after making mistakes. </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="voters_given_ballot_papers_after_mistake" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                    Some voters kept spoiled ballot papers after requesting new ones. </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="voters_kept_spoiled_ballot_papers" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-pie-chart mr-10"></i>Voter index fingers wiped before inking
                                    </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="voters_fingers_wiped_before" style="height: 190px;"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                    Voter fingers inked after casting votes. </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="voters_fingers_inked_after" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>Observers fully able to observe the voting process</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="observers" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-pie-chart mr-10"></i>Voting queue was moving along
                                    </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="voting_que_moving_along" style="height: 190px;"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                    Polling station was spacious and adequate for movement. </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="station_spacious_adequate" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                    Polling station was shaded and protected from the sun. </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="station_shaded_protected" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-pie-chart mr-10"></i>Disabled people given priority and easy access to vote
                                    </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="disabled_given_priority" style="height: 190px;"></div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                    Pregnant women given priority and easy access to vote. </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="pregnant_women_priotized" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                    Elderly given priority and easy access to vote. </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="elderly_given_priority" style="height: 190px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Row -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                                    Number of Party Representatives present </h6>
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
                <div class="col-lg-6">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>Addition of Voting resources</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="voting_resources_overall" style="height: 300px;"></div>
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
                                    Incidences occured </h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="incidents_occured" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="panel panel-default card-view">
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>Critical Incidences</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div id="injuries_occured" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Row -->

        <div id="img-out"></div>


    </div>

@stop

@section('scripts')
    <script type="application/javascript">

        var pageName = "dashboard";
        var dashboardData = {!! json_encode($data, JSON_HEX_TAG) !!};
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

        console.log(dashboardData);
    </script>

    <script src="vendors/custom_js/visuals/echarts/echarts_new.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/0.9.0rc1/jspdf.min.js"></script>
    <script src="vendors/custom_js/html2canvas.min.js"></script>
    <script src="vendors/custom_js/html2canvas.js"></script>--}}


    <script src="vendors/custom_js/electionday/afternoon.js"></script>
    <script src="vendors/custom_js/electionday/trait.js"></script>

@stop