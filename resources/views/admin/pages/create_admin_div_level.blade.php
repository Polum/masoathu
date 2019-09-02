@extends('admin.app')

@section('content')

    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg bg-yellow">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-light">Administrative Divisions</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <ol class="breadcrumb">
                    <li><a href="index-2.html">Dashboard</a></li>
                    <li class="active"><span>Administrative Divisions</span></li>
                </ol>
            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->
        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6 class="panel-title txt-dark">Create Administrative Division</h6>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="form-wrap">
                                <form action="{{ url('/admin-division-level') }}" method="POST" class="form-inline">
                                    {{ csrf_field() }}
                                    <div class="form-group mr-15">
                                        <label class="control-label mr-10" for="pwd_inline">Name:</label>
                                        <input type="text" class="form-control" id="pwd_inline" name="name">
                                    </div>
                                    <button type="submit" class="btn btn-success btn-anim"><i class="icon-rocket"></i><span class="btn-text">submit</span></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->

    </div>
@stop

@section('scripts')

@stop