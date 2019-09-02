@extends('admin.app')

@section('content')

    <div class="container-fluid">


        <!-- Title -->
        <div class="row heading-bg bg-yellow">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-light">Observer Response</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Dashboard</a></li>
                    <li class="active"><span>Reports</span></li>
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

        <!-- Row -->
        <div class="row">
            <div class="col-sm-4">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Flagged Reports</h6>
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
                                            <th>Report</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Report</th>
                                        </tr>
                                        </tfoot>
                                        <tbody class="flagged">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Reports resolving in progress</h6>
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
                                            <th>Report</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Report</th>
                                        </tr>
                                        </tfoot>
                                        <tbody class="resolving">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-4">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Resolved Reports</h6>
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
                                            <th>Report</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Report</th>
                                        </tr>
                                        </tfoot>
                                        <tbody class="completed">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="messageInfoModel" tabindex="-1" role="dialog" aria-labelledby="messageInfoModel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content rco-modal">
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
        var page = "rco";
        var allData = [];
        var questions = [];
        var reported_incidents = [];
        var resolving_reports = [];
        var resolved = [];
        var centres = [];
        var questionSetData;
        var token = " <?php echo csrf_token() ?> ";
        var userId = "<?php echo $userId ?>";
        var baseUrl = "{{ url('/') }}";
        var observer_responses = "{{ url('flagged-responses') }}";
        var observerUrl = "{{ url('observer-resources') }}";
        var regCenterUrl = "{{ url('polling-station-resources') }}";
        var questionSetUrl = "{{ url('/api/observer-questions') }}";
        // var moment = "{{ asset('vendors/moment/moment.js') }}";
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



    <script src="vendors/moment/moment.js"></script>
    <script src="vendors/custom_js/reports.js"></script>


@stop