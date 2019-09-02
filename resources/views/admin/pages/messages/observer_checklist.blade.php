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
						<li><a href="index-2.html">Dashboard</a></li>
						<li><a href="#"><span>Messages</span></a></li>
						<li class="active"><span>Open Messages</span></li>
					  </ol>
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->
				
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">SMS - 626</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="sm-graph-box">
										<div class="row">
											<div class="col-xs-6">
												<img src="dist/img/magento-sms.png" alt="sms icon" class="img-responsive" />
											</div>
											<div class="col-xs-6">
												<div class="counter-wrap text-right">
													<span class="counter count-block mt-75">125</span>
												</div>	
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark">USSD - *6446#</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="sm-graph-box">
										<div class="row">
											<div class="col-xs-6">
												<img src="dist/img/ussd.png" alt="sms icon" class="img-responsive" />
											</div>
											<div class="col-xs-6">
												<div class="counter-wrap text-right">
													<span class="counter count-block mt-75">10</span>
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
									<h6 class="panel-title txt-dark">Observer Messages</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="table-responsive">
											<table id="example" class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th>Via Channel</th>
														<th>Sender</th>
														<th>Body</th>
														<th>Time</th>
														<th>Latitude</th>
														<th>Longitude</th>
														<th>Status</th>
														<th>Actions</th>
														<th></th>
													</tr>
												</thead>
												<tfoot>
													<tr>
														<th>Via Channel</th>
														<th>Sender</th>
														<th>Body</th>
														<th>Time</th>
														<th>Latitude</th>
														<th>Longitude</th>
														<th>Status</th>
														<th>Actions</th>
														<th></th>
													</tr>
												</tfoot>
												<tbody>

												@for($x = 0; $x <= 10; $x++)
													<tr>
														<td>SMS - 6446</td>
														<td>Alick Chitsulo</td>
														<td>1A2B3CE</td>
														<td>07:30 on Oct 27</td>
														<td>13.90008</td>
														<td>-33.75689</td>
														<td>
															<span class="label label-primary">Informative</span>
														</td>
														<td><a href="javascript:void(0)" class="" data-toggle="tooltip" title="Edit" ><i class="fa fa-check"></i></a><a href="javascript:void(0)" class="text-inverse" title="Delete" data-toggle="tooltip"><i class="fa fa-trash"></i></a></td>

														<td><button class="btn btn-default">Generate Report</button></td>
													</tr>
												@endfor


													
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


	<script src="vendors/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="vendors/bower_components/datatables.net-buttons/js/buttons.flash.min.js"></script>
	<script src="vendors/bower_components/jszip/dist/jszip.min.js"></script>
	<script src="vendors/bower_components/pdfmake/build/pdfmake.min.js"></script>
	<script src="vendors/bower_components/pdfmake/build/vfs_fonts.js"></script>
	
	<script src="vendors/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
	<script src="vendors/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
	<script src="dist/js/export-table-data.js"></script>

@stop