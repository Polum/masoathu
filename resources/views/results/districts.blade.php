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

        <h3 class="text-center"> <span class="pg_title">DISTRICTS</span> PRESIDENTIAL RESULTS</h3>
        <div class="row">
            <div class="col-md-12 mb-15">
                <div class="btn-group btn-group-justified">
                    <a class="btn btn-default btn-outline" role="button" href="{{ url('/presidential-results') }}">Presidential results</a>
                    <a class="btn btn-warning" role="button" href="{{ url('/districts') }}">Districts</a>
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
                            Overall vote results </h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body padding">
                            <div id="candidate_chart" style="height: 400px;"></div>
                        </div>
                    </div>
                    <div class="mt-3 mb-5 pt-2 pb-2 pl-2 card">
                        <h5 id="total"></h5>
                        <nav class="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item"><button id="prev" type="button" class="btn btn-primary btn-sm">Prev</button></li>
                                <li class="page-item disabled"><a id="show" href="#" class="page-link text-dark"></a></li>
                                <li  class="page-item"><button id="next" type="button" class="btn btn-primary btn-sm">Next</button></li>
                            </ul>
                        </nav> 
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                            DISTRICTS VOTE COUNT </h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body padding">
                            <table id="district_table" class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">NO.</th>
                                        <th scope="col">NAME</th>
                                        <th scope="col">NO. CONSTITUENCIES</th>
                                        <th scope="col">NO. WARDS</th>
                                        <th scope="col">NO. CENTRES</th>
                                        <th scope="col">TOTAL VOTES CAST</th>
                                    </tr>
                                </thead>
                                <tbody>
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
       //var  ;
        var chartData = [];
        var districtsNames=[];
        let total = $('#total');
        let prev = $('#prev');
        let next = $('#next');
        let show = $('#show');
        var links;
        var meta;

        //method
        $(document).ready(function() { 
           getCandidate();
           getDistricts();
        }); 
        //set click
        next.click(()=>{
            getDistricts(links.next);  
        });

        prev.click(()=>{
            getDistricts(links.prev);  
        });

        //GET CANDIDATES
        function getCandidate(link){
            link = link || '{{ url("/api/candidates") }}'; 
            $.get(link, (data, status)=>{
                $.each(data.data, function(key, value){
                    chartData[value.name] = chartData[value.name]? chartData[value.name]+value.results: value.results;
                });
                createChart(chartData);
            });
        };

        //GET DISTRICTS
        function getDistricts(link){
            link = link || '{{ url("/api/districts/") }}'; 
            $.get(link, (data, status)=>{
                links = data.links;
                meta = data.meta;
                total.empty();
                show.empty();
                show.append(meta.current_page+'/'+meta.last_page)
                total.append('TOTAL DISTRICTS = '+data.meta.total);

                $('#district_table tbody').html('');

                $.each(data.data, function(index, value){
                    $('#district_table tbody').append(`
                            <tr>
                                <th scope="row">`+value.id+`</th>
                                <td>`+value.name+`</td>
                                <td>`+value.constituencies+`</td>
                                <td>`+value.wards+`</td>
                                <td>`+value.centres+`</td>
                                <td>`+value.results+`</td> 
                                <td> <a href="{{ url('/district/`+value.id+`') }}" type="button" class="btn btn-primary btn-sm">View District</a></td>
                            </tr>`
                        );
                });
            }); 
            console.log(link);
        };

        // create Chart
        function createChart(chartData){
            $('#candidate_chart').empty;
            let candidate = echarts.init(document.getElementById('candidate_chart'));
            candidate_options = barTemplate(chartData, {x: 40,x2: 40,y: 5,y2: 120}, '#006180');
            candidate.setOption(candidate_options);
        }
        

    </script>
@endsection