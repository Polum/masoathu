@extends('admin.app')

@section('content')

<!-- Main Content -->
<div class="page-wrapper pa-0 ma-0">
    <div class="container-fluid">
        <!-- Row -->
        <div class="table-struct full-width full-height">
            <div class="table-cell vertical-align-middle">
                {{--  <div class="auth-form  ml-auto mr-auto no-float">  --}}

                    <div class="panel panel-default card-view mb-0">
                        <div class="panel-heading">
                            <div class="pull-center">
                            </div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-wrap">
                                            <form class="form-horizontal" method="POST" action = "{{ url('/result-new') }}">
                                                {{ csrf_field() }}
                                                <div class="form-group col-sm-4">
                                                    <label class="control-label mb-10">Select Region</label>
                                                    <select name="region_id" id="region_id" class="form-control region" required>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <label class="control-label mb-10">Select District</label>
                                                    <select name="district_id" id="district_id" class="form-control district" required>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <label class="control-label mb-10">Select Constituency</label>
                                                    <select name="constituency_id" id="constituency_id" class="form-control constituency" required>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <label class="control-label mb-10">Select Ward</label>
                                                    <select name="ward_id" id="ward_id" class="form-control ward" required>
                                                    </select>
                                                </div>
                                                <div class="form-group col-sm-4">
                                                    <label class="control-label mb-10">Select Centre</label>
                                                    <select name="centre_id" id="centre_id" class="form-control centre" required>
                                                    </select>
                                                </div>
                        
                                                <div class="row">
                                                    @foreach($candidates as $candidate)
                                                        <div class="form-group col-sm-4">
                                                            <label for="value" class="control-label mb-10">{{ $candidate->name }}</label>
                                                            <input type="text" name="{{ $candidate->id }}" class="form-control value">
                                                        </div>
                                                    @endforeach
                                                </div>
                        
                                                <div class="form-group">
                                                    <div class="col-md-6 col-md-offset-4">
                                                        <button tyoe = "submit" class="btn btn-primary submit">
                                                            Add result
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                {{--  </div>  --}}
            </div>
        </div>
        <!-- /Row -->
    </div>

</div>
<!-- /Main Content -->
@endsection

@section('scripts')
    <script src="vendors/custom_js/visuals/echarts/echarts_new.js"></script>
    <script src="vendors/custom_js/electionday/trait.js"></script>
    <script>
        var baseUrl = "{{ url('/api/') }}";
    </script>
    <script src="vendors/custom_js/electionday/create-results.js"></script>
@endsection
