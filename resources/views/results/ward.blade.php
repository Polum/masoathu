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
                    <li> <a href="{{ url('/presidential-results') }}">Presidential Results</a></li>
                    <li class="active"><span>Ward</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->

        <h3 class="text-center"><span class="pg_title"></span> PRESIDENTIAL RESULTS</h3>
        <div class="row">
            <div class="col-md-12 mb-15">
                <div class="btn-group btn-group-justified">
                    <a class="btn btn-default btn-outline" role="button" href="{{ url('/presidential-results') }}">Presidential results</a>
                    <a class="btn btn-default btn-outline" role="button" href="{{ url('/districts') }}">Districts</a>
                    <a class="btn btn-default btn-outline" role="button" href="{{ url('/constituencies') }}">Constituencies</a>
                    <a class="btn btn-default btn-outline" role="button" href="{{ url('/wards') }}">Wards</a>
                    <a class="btn btn-default btn-outline" role="button" href="{{ url('/centres') }}">Centres</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                            <span class="pg_title"></span> vote count</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body padding">
                            <div id="cc" style="height: 400px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Candidates table --}}
            <div class="col-md-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                            <span class="pg_title"></span> Centres </h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body padding">
                            <table id="constituency_table" class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">NO.</th>
                                        <th scope="col">NAME</th>
                                        <th scope="col">CONSTITUENCY</th>
                                        <th scope="col">WARD</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    
                                    @foreach($ward["centres"] as $centre)
                                        <tr>
                                            <td>{{ $centre["centre_id"] }}</td>
                                            <td>{{ $centre["centre_name"] }}</td>
                                            <td>{{ $centre["ward_name"] }}</td>
                                            <td>{{ $centre["constituency_name"] }}</td>
                                            <td>{{ $centre["district_name"] }}</td>
                                            <td><a class="btn btn-primary" role="button" href="{{ url('/centre/'.$centre["centre_id"]) }}">View Centre</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>       
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@stop


@section('scripts')
    <script src="vendors/custom_js/visuals/echarts/echarts_new.js"></script>
    <script src="vendors/custom_js/electionday/trait.js"></script>
    <script>
        var link = "{{ url('/api/ward/'.$ward['id']) }}";
        var page = "ward";
    </script>
    <script src="vendors/custom_js/electionday/results.js"></script>
@endsection