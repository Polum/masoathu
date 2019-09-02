@extends('admin.app')
@section('content')
    <div class="container-fluid">


        <!-- Title -->
        <div class="row heading-bg bg-yellow">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-light">Users</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="{{ url('/') }}">Dashboard</a></li>
                    <li><a href="active"><span>Users</span></a></li>
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
                            <h6 class="panel-title txt-dark">User List</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-3">
                               <a href="{{ route('register') }}" ><button class="btn btn-success btn-rounded btn-icon left-icon"><i
                                            class="fa fa-plus"></i>
                                       <span>Add user</span></button></a>
                            </div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="table-wrap">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-hover display  pb-30">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>User Type</th>
                                                <th>Actions</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>User Type</th>
                                                <th>Actions</th>
                                            </tr>
                                            </tfoot>
                                            <tbody class="user-list">

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
@endsection
@section('scripts')
    <script type="application/javascript">
        var userListUrl = "{{ url('user-resources') }}";
        var editUserUrl = "{{ url('edit-user/') }}";
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


    <script src="vendors/custom_js/user_list.js"></script>
@endsection

