@extends('admin.app')

@section('content')
{{--
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

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
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
--}}

<!-- Main Content -->
<div class="page-wrapper pa-0 ma-0">
    <div class="container-fluid">
        <!-- Row -->
        <div class="table-struct full-width full-height">
            <div class="table-cell vertical-align-middle">
                <div class="auth-form  ml-auto mr-auto no-float">

                    <div class="panel panel-default card-view mb-0">
                        <div class="text-center">
                            <img class="brand-img " src="{{url('dist/img/logo.png')}}" alt="Maso Athu"/>
                        </div>
                        <div class="panel-heading">
                            <div class="pull-left">
                                <h6 class="panel-title txt-dark">Sign In</h6>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel-wrapper collapse in">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-12 col-xs-12">
                                        <div class="form-wrap">

                                            <form method="POST" action="{{ route('login') }}">
                                                {{ csrf_field() }}
                                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10" for="exampleInputEmail_2">Email address</label>
                                                    <div class="input-group">
                                                        <input type="email" class="form-control" required="" autofocus name="email" value="{{ old('email') }}" id="exampleInputEmail_2" placeholder="Enter email">
                                                        <div class="input-group-addon"><i class="icon-envelope-open"></i></div>
                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                    <label class="control-label mb-10" for="exampleInputpwd_2">Password</label>
                                                    <div class="input-group">
                                                        <input type="password" name="password" class="form-control" required="" id="exampleInputpwd_2" placeholder="Enter pwd">
                                                        <div class="input-group-addon"><i class="icon-lock"></i></div>
                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('password') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="checkbox checkbox-success pr-10 pull-left">
                                                        <input id="checkbox_2"  type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                                        <label for="checkbox_2"> keep me logged in </label>
                                                    </div>
                                                    <a class="capitalize-font txt-danger block pt-5 pull-right" href="{{ route('password.request') }}">forgot password</a>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-success btn-block">sign in</button>
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
<!-- /Main Content -->
@endsection
