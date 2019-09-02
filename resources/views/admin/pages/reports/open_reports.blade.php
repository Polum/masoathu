@extends('admin.app')

@section('content')

    <div class="container-fluid">


        <!-- Title -->
        <div class="row heading-bg bg-yellow">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-light">Observer Checklist</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Dashboard</a></li>
                    <li><a href="#"><span>Messages</span></a></li>
                    <li class="active"><span>Open Messages</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->
        <div class="row loader-overlay-parent">
            <div class="loader-overlay" style="position: absolute; height: 500px; width:500px; background: rgb(238,238,238); z-index:1;">
                <div class="loader" style="margin-left: auto;margin-right: auto;"></div>
                <div class="progress" style="margin-left: auto;margin-right: auto; padding:40px; text-align: center; height: 100px; width: 500px; background: inherit;">
                    <h4>Loading Registration Centers</h4>

                </div>
            </div>

        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">SMS - 6466</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="sm-graph-box">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <img src="dist/img/magento-sms.png" alt="sms icon" class="img-responsive"/>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="counter-wrap text-right">
                                            <span class="counter count-block mt-75 mobile-sms">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">USSD - *646*3#</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="sm-graph-box">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <img src="dist/img/ussd.png" alt="sms icon" class="img-responsive"/>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="counter-wrap text-right">
                                            <span class="counter count-block mt-75 mobile-ussd">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Mobile Application</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="sm-graph-box">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <img src="dist/img/smartphone-call.png" alt="sms icon" class="img-responsive"/>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="counter-wrap text-right">
                                            <span class="counter count-block mt-75 mobile-app">0</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Open Reports</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table id="example" class="table table-hover display  pb-30">
                                        <thead>
                                        <tr>
                                            <th>Via Channel</th>
                                            <th>Sender</th>
                                            <th>Body</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Via Channel</th>
                                            <th>Sender</th>
                                            <th>Body</th>
                                            <th>Time</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </tfoot>
                                        <tbody class="sms-text-list">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->

        </div>
    </div>

<?php  $userId = Auth::user()->id ?>
@stop


@section('scripts')



    <script type="application/javascript">
        var questionSetData;
        var token = " <?php echo csrf_token() ?> ";
        var userId = "<?php echo $userId ?>";
        var store_flagged_resources_url = "{{ url('flagged-resources') }}";
        var smsUrl = "{{ url('sms-resources') }}";
        var observerUrl = "{{ url('observer-resources') }}";
        var regCenterUrl = "{{ url('polling-station-resources') }}";
        var questionSetUrl = "{{ url('question-resources') }}";
        var dataTableScriptVendor = "{{ asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}";
        var dataTableScript = "{{ asset('dist/js/dataTables-data.js') }}";
        var fancyDropDownScript = "{{ asset('dist/js/dropdown-bootstrap-extended.js') }}";
        var dtscript1 = "{{ asset('vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js') }}";
        var dtscript2 = "{{ asset('vendors/bower_components/datatables.net-buttons/js/buttons.flash.min.js') }}";
        var dtscript3 = "{{ asset('vendors/bower_components/jszip/dist/jszip.min.js') }}";
        var dtscript4 = "{{ asset('vendors/bower_components/pdfmake/build/pdfmake.min.js') }}";
        var dtscript5 = "{{ asset('vendors/bower_components/pdfmake/build/vfs_fonts.js') }}";

        var dtscript6 = "{{ asset('vendors/bower_components/datatables.net-buttons/js/buttons.html5.min.js') }}";
        var dtscript7 = "{{ asset('vendors/bower_components/datatables.net-buttons/js/buttons.print.min.js') }}";
        var dtscript8 = "{{ asset('dist/js/export-table-data.js') }}";
        var dtscript9 = "{{ asset('vendors/bower_components/sweetalert/dist/sweetalert.min.js') }}";
    </script>



    <script src="vendors/custom_js/open_reports.js"></script>


@stop