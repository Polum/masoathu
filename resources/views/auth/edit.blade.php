@extends('admin.app')

@section('content')
    <div class="page-wrapper pa-0 ma-0">
        <div class="container-fluid">
            <!-- Row -->
            <div class="table-struct full-width full-height">
                <div class="table-cell vertical-align-middle">
                    <div class="auth-form  ml-auto mr-auto no-float">

                        <div class="panel panel-default card-view mb-0">

                            <div class="panel-heading">
                                <div class="text-center">
                                    <h6 class="panel-title txt-dark">Edit User</h6>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-wrapper collapse in">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-wrap">
                                                <form class="form-horizontal" method="POST" action="{{ url('update-user') }}">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                                        <label class="control-label mb-10 text-left">Name</label>
                                                        <input type="text" id="name" class="form-control" name="name" placeholder="Name"
                                                               value="{{ $user->name }}" required autofocus>
                                                        @if ($errors->has('name'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                        <label class="control-label mb-10 text-left"
                                                               for="example-email">Email</label>
                                                        <input type="email" id="email" name="email"
                                                               class="form-control" value="{{ $user->email }}"
                                                               placeholder="Email" required>
                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
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
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Select User Type</label>
                                                        <select name="user_type" id="user-type" class="form-control">
                                                            <option value="1">Administrator</option>
                                                            <option value="2">System User</option>
                                                            <option value="3">Data Clerk</option>
                                                            <option value="4">RCO</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label mb-10">Select Region</label>
                                                        <select name="region_id" id="user-type" class="form-control">
                                                            <option value="0">None</option>
                                                            <option value="1">Northen</option>
                                                            <option value="2">Central</option>
                                                            <option value="3">Southern</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-6 col-md-offset-4">
                                                            <button type="submit" class="btn btn-primary">
                                                                Register
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
@endsection

