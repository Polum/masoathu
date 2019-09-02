@extends('admin.app')

@section('content')
    {{--<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                           value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email"
                                           value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                           name="password_confirmation" required>
                                </div>
                            </div>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}

    <div class="page-wrapper pa-0 ma-0">
        <div class="container-fluid">
            <!-- Row -->
            <div class="table-struct full-width full-height">
                <div class="table-cell vertical-align-middle">
                    <div class="auth-form  ml-auto mr-auto no-float">

                        <div class="panel panel-default card-view mb-0">

                            <div class="panel-heading">
                                <div class="text-center">
                                    <h6 class="panel-title txt-dark">Add New Observer</h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-wrap">

                                                <form class="form-horizontal" method="POST" action="{{ url('/observer-resources`') }}">
                                                    {{ csrf_field() }}
                                                    <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                                                        <label class="control-label mb-10 text-left">Name</label>
                                                        <input type="text" id="first_name" class="form-control" name="first_name" placeholder="First Name"
                                                               value="{{ old('first_name') }}" required autofocus>
                                                        @if ($errors->has('first_name'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('first_name') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                                                        <label class="control-label mb-10 text-left">Name</label>
                                                        <input type="text" id="last_name" class="form-control" name="last_name" placeholder="Last Name"
                                                               value="{{ old('last_name') }}" required autofocus>
                                                        @if ($errors->has('last_name'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('last_name') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                                        <label class="control-label mb-10 text-left"
                                                               for="example-email">Phone Number</label>
                                                        <input type="text" id="phone_number" name="phone_number"
                                                               class="form-control" value="{{ old('phone_number') }}"
                                                               placeholder="Phone Number" required>
                                                        @if ($errors->has('phone_number'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('phone_number') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                   {{-- <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                        <label class="control-label mb-10 text-left">Password</label>
                                                        <input type="password" name="password" id="password" class="form-control">
                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label mb-10 text-left">Password</label>
                                                        <input type="password" id="password-confirm" class="form-control" name="password_confirmation" required>
                                                    </div>--}}
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Select Gender</label>
                                                        <select name="gender" id="gender" class="form-control">
                                                            <option value="M">Male</option>
                                                            <option value="F">Female</option>

                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-6 col-md-offset-4">
                                                            <button type="submit" class="btn btn-primary">
                                                                Create
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
                    </div>
                </div>
            </div>
            <!-- /Row -->
        </div>

    </div>
@endsection

@section('scripts')

    <!-- Bootstrap Select JavaScript -->
    <script src="vendors/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <!-- Bootstrap Select JavaScript -->
    <script type="text/javascript">
        /* Bootstrap Select Init*/
        $('.selectpicker').selectpicker();
    </script>
@stop

