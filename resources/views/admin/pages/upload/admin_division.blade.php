@extends('admin.app')

@section('content')

    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg bg-yellow">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-light">Administrative Divisions</h5>
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
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view pb-0">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Upload Administrative Divisions</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <form action="{{ url('/import-all-admin-divisions') }}" method="POST" name="admin-import-form" id="admin_import_form" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <div class="form-group mb-30">
                            <label class="control-label mb-10 text-left">File upload</label>
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                <div class="form-control" data-trigger="fileinput"><i
                                            class="glyphicon glyphicon-file fileinput-exists"></i> <span
                                            class="fileinput-filename"></span></div>
                                <span class="input-group-addon fileupload btn btn-info btn-anim btn-file"><i
                                            class="fa fa-upload"></i> <span
                                            class="fileinput-new btn-text">Select file</span> <span
                                            class="fileinput-exists btn-text">Change</span>
														<input type="file" name="import_file" id="import_file">
														</span> <a href="#"
                                                                   class="input-group-addon btn btn-danger btn-anim fileinput-exists"
                                                                   data-dismiss="fileinput"><i
                                            class="fa fa-trash"></i><span class="btn-text"> Remove</span></a>
                            </div>
                        </div>
                        <span class="input-group-btn">
                            <button type="submit" class="btn btn-success btn-anim "><i
                                    class="icon-rocket"></i><span class="btn-text">submit</span></button>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Row -->
    </div>
@stop
@section('scripts')
    <script src="vendors/bower_components/jasny-bootstrap/dist/js/jasny-bootstrap.min.js"></script>

    <!-- Slimscroll JavaScript -->
    <script src="dist/js/jquery.slimscroll.js"></script>

    <!-- Fancy Dropdown JS -->
    <script src="dist/js/dropdown-bootstrap-extended.js"></script>

    <!--page js -->
    <script scr="vendors/custom_js/import_admin_div.js"></script>
@stop