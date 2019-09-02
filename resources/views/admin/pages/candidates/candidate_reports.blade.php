@extends('admin.app')


@section('extra_css')

<!-- bootstrap-select CSS -->
		<link href="vendors/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>

@stop

@section('content')

<div class="container-fluid">


				<!-- Title -->
				<div class="row heading-bg bg-green">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-light">Candidate Reports</h5>
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
				<!-- Row -->
				<!-- Row -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">SELECT A LOCATION</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<p class="text-muted">Pick a location to view results for, you can view results by district by selecting all in the constituency dropdown</code></p>
										<div class="form-wrap mt-40">
											<form>
												<div class="row">
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label mb-10">Region</label>
															<select class="selectpicker" data-style="form-control">
																<option>North</option>
																<option>Central</option>
																<option>South</option>
															</select>
														</div>	
													</div>
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label mb-10">Districts</label>
															<select class="selectpicker" data-style="form-control">
																<optgroup label="Picnic">
																	<option>Blantyre</option>
																	<option>Chikwawa</option>
																	<option>Mulanje</option>
																	<option>Machinga</option>
																</optgroup>
															</select>
														</div>
													</div>	
													<div class="col-md-4">
														<div class="form-group">
															<label class="control-label mb-10">Constituency</label>
															<select class="selectpicker" multiple data-style="form-control">

																<option>Blantyre North West</option>
																<option>Blantyre South West</option>
																<option>Blantyre North East</option>
																<option>Blantyre South East</option>

																
															</select>
														</div>	
													</div>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
						
		
					</div>
					<!-- /Row -->
		

				
				<!-- Row -->
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12">
                       <div class="panel panel-default card-view">
							<div class="panel-heading">
								<div class="pull-left">
									<h6 class="panel-title txt-dark"><i class="icon-support mr-10"></i>Candidates - Blantyre North West</h6>
								</div>
								<div class="clearfix"></div>
							</div>
							<div class="panel-wrapper collapse in">
								
								<div class="panel-body">
									<canvas id="chart_candidates" height="447"></canvas>	
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- /Row -->


				
				
			

</div>

@stop


@section('scripts')


	<!-- Moment JavaScript -->
		<script type="text/javascript" src="vendors/bower_components/moment/min/moment-with-locales.min.js"></script>
<!-- Bootstrap Select JavaScript -->
		<script src="vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
<!-- Bootstrap Tagsinput JavaScript -->
		<script src="vendors/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

@stop