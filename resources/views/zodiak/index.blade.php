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
                        <div class="text-center">
                            <img class="brand-img " src="{{url('dist/img/zodiak.png')}}" alt="Zodiak"/>
                        </div>
                        <div class="panel-heading">
                            <div class="pull-center">
                            </div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-wrap">

                                            <form method="POST" action="{{ route('zodiak-results') }}">
                                                {{ csrf_field() }}
                                                <div class="row">
                                                    <input type="hidden" name="phoneNumber" value="0999123456">
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label mb-10">Select District</label>
                                                        <select name="constituencyCode" id="constituencyCode" class="form-control candidate" required>
                                                            <option value="120">ONE CONSTITUENCY</option>
                                                            <option value="200">TWO CONSTITUENCY</option>
                                                            <option value="210">THREE CONSTITUENCY</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label mb-10">Form serial number</label>
                                                        <input type="text" class="form-control" required placeholder="234567"
                                                         name="formSerialNumber" id="serial">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label mb-10">Dr. Lazarus Chakwera</label>
                                                        <input type="text" class="form-control" required placeholder="20"
                                                         name="Lazarus Chakwera" id="Lazarus Chakwera">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label mb-10">Professor John Eugene Chisi</label>
                                                        <input type="text" class="form-control" required placeholder="20"
                                                         name="Professor John Eugene Chisi" id="Professor John Eugene Chisi">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label mb-10">Mr. Peter Dominic Sinosi Driver Kuwani</label>
                                                        <input type="text" class="form-control" required placeholder="20"
                                                         name="Peter Dominic Sinosi Driver Kuwani" id="Peter Dominic Sinosi Driver Kuwani">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label mb-10">Dr. Joyce Hilda Banda</label>
                                                        <input type="text" class="form-control" required placeholder="20"
                                                         name="Joyce Hilda Banda" id="Joyce Hilda Banda">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label mb-10">Saulos Klaus Chilima</label>
                                                        <input type="text" class="form-control" required placeholder="20"
                                                         name="Saulos Klaus Chilima" id="Saulos Klaus Chilima">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label mb-10">Mr. Atupele Austin Muluzia</label>
                                                        <input type="text" class="form-control" required placeholder="20"
                                                         name="Atupele Austin Muluzia" id="Atupele Austin Muluzia">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label mb-10">Mr. Reverend Hadwick Kaliya</label>
                                                        <input type="text" class="form-control" required placeholder="20"
                                                         name="Reverend Hadwick Kaliya" id="Reverend Hadwick Kaliya">
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="control-label mb-10">Professor Arthur Peter Mutharika</label>
                                                        <input type="text" class="form-control" required placeholder="20"
                                                         name="Professor Arthur Peter Mutharika" id="Professor Arthur Peter Mutharika">
                                                    </div>


                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success btn-block">Send reults</button>
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
    <script>
        var baseUrl = "{{ url('/') }}";
    </script>
    <script src="vendors/custom_js/electionday/zodiak.js"></script>
@endsection
