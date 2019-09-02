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
                            <span class="pg_title"></span> VOTE COUNT</h6>
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
                            <span class="pg_title"></span> Constituencies</h6>
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
                                        <th scope="col">NO. CONSTITUENCIES</th>
                                        <th scope="col">NO. WARDS</th>
                                        <th scope="col">NO. CENTRES</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    
                                    @foreach($district["constituencies"] as $constituency)
                                        <tr>
                                            <td>{{ $constituency["constituency_id"] }}</td>
                                            <td>{{ $constituency["district_name"] }}</td>
                                            <td>{{ $constituency["constituency_name"] }}</td>
                                            <td>{{ $constituency["wards"] }}</td>
                                            <td>{{ $constituency["centres"] }}</td>
                                            <td><a class="btn btn-primary" role="button" href="{{ url('/constituency/'.$constituency["constituency_id"]) }}">View Constituency</a></td>
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
        var link = "{{ url('/api/district/'.$district['id']) }}";
        var page = "district";
    </script>
    <script src="vendors/custom_js/electionday/results.js"></script>
@endsection