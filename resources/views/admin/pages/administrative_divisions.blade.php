@extends('admin.app')

@section('content')

    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg bg-yellow">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-light level-title">Administrative Divisions</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="index-2.html">Dashboard</a></li>
                    <li class="active"><span>Administrative Divisions</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->
        <!-- Row -->
        <div class="row top-admin-section">
            <div class="col-sm-12">
                <div class="panel panel-default card-view pb-0">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark ">Administrative Divisions </h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pb-0">

                            <div class="row admin-divisions-row">
                               @foreach($adminDivLevels as $adminLevel)
                                <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-30">
                                    <div class="panel panel-pricing mb-0">
                                        <div class="panel-heading">
                                            <i class=" ti-shield"></i>
                                            <span class="panel-price" style="font-size: 30px;">{!! $adminLevel->name !!}</span>
                                        </div>
                                        <div class="panel-body text-center pl-0 pr-0">
                                            <hr class="mb-30"/>
                                            <ul class="list-group mb-0 text-center">
                                                <li class="list-group-item"><i class="fa fa-check"></i> 4 Regions</li>
                                            </ul>
                                        </div>
                                        <div class="panel-footer pb-35">
                                            @php
                                                $pageUrl =  url('/administrative-divisions-levels-data')
                                            @endphp
                                            <button class="btn btn-success btn-rounded btn-lg admin-req-button"
                                                    onClick="switchAdminDivisions('@php echo $pageUrl @endphp', {!! $adminLevel->id !!})">View
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /item -->
                                @endforeach

                                <!-- item -->
                                <a href="{{ url('/admin-levels') }}">
                                    <div class="col-lg-3 col-md-6 col-sm-12 text-center mb-30">
                                        <div class="panel panel-pricing mb-0">
                                            <div class="panel-heading">
                                                <i class=" ti-plus"></i>
                                                <span class="panel-price" style="font-size: 30px;">Add Division</span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <!-- /item -->
                            </div>
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
        var url = "{{ url('/administrative-divisions-levels-data/1') }}"
        var dataTableScriptVendor = "{{ asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"
        var dataTableScript = "{{ asset('dist/js/dataTables-data.js') }}"
        var fancyDropDownScript = "{{ asset('dist/js/dropdown-bootstrap-extended.js') }}"
    </script>
    <!-- page js -->
    <script src="vendors/custom_js/admin_divisions.js"></script>
@stop