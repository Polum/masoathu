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

        <h3 class="text-center">CENTRES</h3>
        <div class="row">
            <div class="col-md-12 mb-15">
                <div class="btn-group btn-group-justified">
                    <a class="btn btn-default btn-outline" role="button" href="{{ url('/presidential-results') }}">Presidential results</a>
                    <a class="btn btn-default btn-outline" role="button" href="{{ url('/districts') }}">Districts</a>
                    <a class="btn btn-default btn-outline" role="button" href="{{ url('/constituencies') }}">Constituencies</a>
                    <a class="btn btn-default btn-outline" role="button" href="{{ url('/wards') }}">Wards</a>
                    <a class="btn btn-warning" role="button" href="{{ url('/centres') }}">Centres</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark"><i class="icon-plus mr-10"></i>
                            Centres</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body padding">
                            <table id="centre_table" class="table table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col">NO.</th>
                                        <th scope="col">NAME</th>
                                        <th scope="col">DISTRICT</th>
                                        <th scope="col">CONSTITUENCY</th>
                                        <th scope="col">WARD</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    
                                    {{--  @foreach($data as $district)
                                        <tr>
                                            <td>{{ $district["id"] }}</td>
                                            <td>{{ $district["district_name"] }}</td>
                                            <td>{{ $district["constituencies"] }}</td>
                                            <td>{{ $district["wards"] }}</td>
                                            <td>{{ $district["centres"] }}</td>
                                            <td><a class="btn btn-primary" role="button" href="{{ url('/district/'.$district["id"]) }}">View District</a></td>
                                        </tr>
                                    @endforeach  --}}
                                </tbody>       
                            </table>
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
            </div>
        </div>
@stop


@section('scripts')
    <script src="vendors/custom_js/visuals/echarts/echarts_new.js"></script>
    <script src="vendors/custom_js/electionday/trait.js"></script>
    <script> 
        //var
        //var link = "{{ url('/api/constituencies') }}";
        var page = "constituencies";
        let total = $('#total')
        let prev = $('#prev');
        let next = $('#next');
        let show = $('#show');
        var links;
        var meta;

        $(function() { 
           ds();
        }); 
        //set click
        next.click(()=>{
            ds(links.next);  
        })

        prev.click(()=>{
            ds(links.prev);  
        })
        function ds(link){
            link = link || "{{ url('/api/centres') }}";
            
             $.get(link,(data, status)=>{
                links = data.links;
                meta = data.meta;
                total.empty();
                show.empty();
                show.append(meta.current_page+'/'+meta.last_page)
                total.append('TOTAL CENTRES = '+data.meta.total);
                //get
                $('#centre_table tbody').html('');
                $.each(data.data, function(index, value){
                    $('#centre_table tbody').append(`
                    <tr>
                        <th scope="row">`+(index+1)+`</th>
                        <td>`+value.name+`</td>
                        <td>`+value.district_name+`</td>
                        <td>`+value.constituency_name+`</td>
                        <td>`+value.ward_name+`</td> 
                        
                    </tr> 
                    `);
                });
            });
        };
        //<td> <a href='{{ url("centre/`+value.id+`") }}' type="button" class="btn btn-primary btn-sm">View Centre</a></td>

    </script>
@endsection