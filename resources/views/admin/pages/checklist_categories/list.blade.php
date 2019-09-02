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

        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Observer List</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-3">
                                <button class="btn btn-success btn-rounded btn-icon left-icon"><i
                                            class="fa fa-plus"></i>
                                    <span>Add Observer</span></button>
                            </div>

                            <div class="col-md-6">
                                <form class="form-inline" action=" {{ url('import-all-observers') }}" method="post"
                                      enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <label class="control-label mb-10 text-left">File upload</label>
                                    <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                        <div class="form-control" data-trigger="fileinput"><i
                                                    class="glyphicon glyphicon-file fileinput-exists"></i> <span
                                                    class="fileinput-filename"></span></div>
                                        <span class="input-group-addon fileupload btn btn-info btn-anim btn-file"><i
                                                    class="fa fa-upload"></i> <span
                                                    class="fileinput-new btn-text">Select file</span> <span
                                                    class="fileinput-exists btn-text">Change</span>
														<input type="file" name="import_file" id="import_file" required>
														</span> <a href="#"
                                                                   class="input-group-addon btn btn-danger btn-anim fileinput-exists"
                                                                   data-dismiss="fileinput"><i
                                                    class="fa fa-trash"></i><span
                                                    class="btn-text"> Remove</span></a>
                                    </div>
                                    <button type="submit"
                                            class="btn btn-warning btn-rounded btn-icon left-icon upload-button"><i
                                                class="fa fa-upload"></i>
                                        <span>Upload Observer List</span></button>

                                </form>
                            </div>


                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-hover display  pb-30">
                                            <thead>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Gender</th>
                                                <th>Phone Number</th>
                                                <th>Centers</th>
                                                <th>Has N.I.C.E Device</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Gender</th>
                                                <th>Phone Number</th>
                                                <th>Centers</th>
                                                <th>Has N.I.C.E Device</th>
                                                <th>Actions</th>
                                            </tr>
                                            </tfoot>
                                            <tbody class="observer-list">

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

        @stop


        @section('scripts')
            <script type="application/javascript">
                var observerListUrl = "{{ url('observer-resources') }}";
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
            </script>


            <script src="vendors/custom_js/observer_list.js"></script>

@stop