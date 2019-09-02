@extends('admin.app')

@section('extra_css')
<!-- Bootstrap Colorpicker CSS -->
<link href="vendors/bower_components/mjolnic-bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css" rel="stylesheet" type="text/css"/>

<!-- select2 CSS -->
<link href="vendors/bower_components/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css"/>

<!-- switchery CSS -->
<link href="vendors/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" type="text/css"/>

<!-- bootstrap-select CSS -->
<link href="vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>

<!-- bootstrap-tagsinput CSS -->
<link href="vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" type="text/css"/>

<!-- bootstrap-touchspin CSS -->
<link href="vendors/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" type="text/css"/>

<!-- multi-select CSS -->
<link href="vendors/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css"/>

<!-- Bootstrap Switches CSS -->
<link href="vendors/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>

<!-- Bootstrap Datetimepicker CSS -->
<link href="vendors/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css"/>
		 
		
		
<!-- Custom CSS -->
<link href="dist/css/style.css" rel="stylesheet" type="text/css">
@stop


@section('content')
				<div class="container-fluid">
				
				<!-- Title -->
				<div class="row heading-bg  bg-yellow">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						<h5 class="txt-light">Incidents</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						<ol class="breadcrumb">
							<li><a href="index-2.html">Dashboard</a></li>
							<li><a href="#"><span>Reports</span></a></li>
							<li class="active"><span>Incidents</span></li>
						</ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->
				<!-- Row -->
				<div class="row">
					<div class="col-lg-3 col-md-4 col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">Districts</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="sm-graph-box">
										<div class="row districts-incident">
											
										</div>
									</div>
								</div>
							</div>
						</div>
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Constituency</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="sm-graph-box">
											<div class="row constituency-incident">
												
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Ward</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="sm-graph-box">
											<div class="row ward-incident">
												<div class="form-wrap mt-40"><form><div class="form-group mb-0"><label class="control-label mb-10">Multiple select boxes</label><select class="select2 select2-multiple" multiple="multiple" data-placeholder="Choose" id="sam-try"><optgroup label="Alaskan/Hawaiian Time Zone"><option value="AK">Alaska</option><option value="HI">Hawaii</option></optgroup><optgroup label="Pacific Time Zone"><option value="CA">California</option><option value="NV">Nevada</option><option value="OR">Oregon</option><option value="WA">Washington</option></optgroup><optgroup label="Mountain Time Zone"><option value="AZ">Arizona</option><option value="CO">Colorado</option><option value="ID">Idaho</option><option value="MT">Montana</option><option value="NE">Nebraska</option><option value="NM">New Mexico</option><option value="ND">North Dakota</option><option value="UT">Utah</option><option value="WY">Wyoming</option></optgroup></select></div></form></div>
											</div>
										</div>
									</div>
								</div>
							</div>
					</div>
					<div class="col-lg-9 col-md-8 col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark"><i class="icon-share mr-10"></i>Inicdent Reports</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
                                <div id="morris_extra_line_chart" class="morris-chart" style="height:442px;"></div>
                            </div>
                        </div>
					</div>
				</div>
				<!-- /Row -->
				
				
			</div>
				
@stop
@section('scripts')
<script type="text/javascript">
		$(".districts-incident").html('<div class="form-wrap mt-40"><form><div class="form-group"><label class="control-label mb-10">District Selection</label><select class="form-control select2"><option>Select</option><optgroup label="Alaskan/Hawaiian Time Zone"><option value="AK">Alaska</option><option value="HI">Hawaii</option></optgroup><optgroup label="Pacific Time Zone"><option value="CA">California</option><option value="NV">Nevada</option><option value="OR">Oregon</option><option value="WA">Washington</option></optgroup></select></div></form></div>');

	$(".constituency-incident").html('<div class="form-wrap mt-40"><form><div class="form-group"><label class="control-label mb-10">Constituency Selection</label><select class="form-control select2"><option>Select</option><optgroup label="Alaskan/Hawaiian Time Zone"><option value="AK">Alaska</option><option value="HI">Hawaii</option></optgroup><optgroup label="Pacific Time Zone"><option value="CA">California</option><option value="NV">Nevada</option><option value="OR">Oregon</option><option value="WA">Washington</option></optgroup></select></div></form></div>');

</script>


	<script src="vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="vendors/bower_components/datatables.net-buttons/js/buttons.flash.min.js"></script>
	
	<!-- Select2 JavaScript -->
	<script src="vendors/bower_components/select2/dist/js/select2.full.min.js"></script>
	
	<!-- Bootstrap Select JavaScript -->
	<script src="vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	
	<!-- Multiselect JavaScript -->
	<script src="vendors/bower_components/multiselect/js/jquery.multi-select.js"></script>
	
	

	<script src="vendors/custom_js/incident.js"></script>
	<!-- Form Advance Init JavaScript -->
		<script src="dist/js/form-advance-data.js"></script>
	
	
@stop
