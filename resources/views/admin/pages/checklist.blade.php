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
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Observer that are not sending data</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table class="table table-hover display  pb-30">
                                        <thead>
                                        <tr>
                                            <th>Text</th>
                                            <th>Number</th>
                                            <th>District</th>
                                            <th>Constituency</th>
                                            <th>Ward</th>
                                            <th>Centre</th>
                                        </tr>
                                        </thead>
                                        <tfoot>
                                        <tr>
                                            <th>Text</th>
                                            <th>Number</th>
                                            <th>District</th>
                                            <th>Constituency</th>
                                            <th>Ward</th>
                                            <th>Centre</th>
                                        </tr>
                                        </tfoot>
                                        <tbody class="sms-text-list" id="responses">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                <div class="modal-dialog" role="document">
                    <div class="modal-content clerk-modal">
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
        var page = "clerk";
        var token = " <?php echo csrf_token() ?> ";
        var userId = "<?php echo $userId ?>";
        var baseUrl = "{{ url('/') }}";
        var question_no = "{{ $question_no }}";
        var checklist = "{{ url('/checklist-response') }}/"+question_no;
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

    <script>
        $(function(){
            $(".loader-overlay").height($(".loader-overlay-parent").height());
            $(".loader-overlay").width($(".loader-overlay-parent").width());
            $(".loader-overlay").hide();
    
            $.get(checklist, function(data){
                $('#responses').html('');
                let tableRow = '';
                $.each(data, (key, value)=>{
                    tableRow += '<tr>'+
                                    '<td>'+value.text+'</td>'+
                                    '<td>'+value.number+'</td>'+
                                    '<td>'+value.district.name+'</td>'+
                                    '<td>'+value.constituency.name+'</td>'+
                                    '<td>'+value.ward.name+'</td>'+
                                    '<td>'+value.centre.name+'</td>'+
                                '</tr>';
                                
                });
                $('#responses').html(tableRow);
            }).done(()=>{
                $.getScript(dataTableScriptVendor, function () {});
                $.getScript(dataTableScript, function () {});
                $.getScript(fancyDropDownScript, function () {});
                $.getScript(dtscript1, function () {});
                $.getScript(dtscript2, function () {});
                $.getScript(dtscript3, function () {});
                $.getScript(dtscript4, function () {});
                $.getScript(dtscript5, function () {});
                $.getScript(dtscript6, function () {});
                $.getScript(dtscript7, function () {});
                $.getScript(dtscript8, function () {});
            });
            
            
        });
    </script>


@stop