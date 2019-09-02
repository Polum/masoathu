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

        <div class="row">

            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pa-0">
                            <div class="sm-data-box bg-green">
                                <div class="row ma-0">
                                    <div class="col-xs-5 text-center pa-0 icon-wrap-left">
                                        <i class="icon-drawar txt-light"></i>
                                    </div>
                                    <div class="col-xs-7 text-center data-wrap-right">
                                        <h6 class="txt-light">TOTAL REPORTS</h6>
                                        <span class="txt-light counter counter-anim">{{ $data["reported"] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pa-0">
                            <div class="sm-data-box bg-blue">
                                <div class="row ma-0">
                                    <div class="col-xs-5 text-center pa-0 icon-wrap-left">
                                        <i class="icon-check txt-light"></i>
                                    </div>
                                    <div class="col-xs-7 text-center data-wrap-right">
                                        <h6 class="txt-light">RESOLVED REPORTS</h6>
                                        <span class="txt-light counter counter-anim">{{ $data["resolved"] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                <div class="panel panel-default card-view pa-0">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body pa-0">
                            <div class="sm-data-box bg-red">
                                <div class="row ma-0">
                                    <div class="col-xs-5 text-center pa-0 icon-wrap-left">
                                        <i class="icon-close txt-light"></i>
                                    </div>
                                    <div class="col-xs-7 text-center data-wrap-right">
                                        <h6 class="txt-light">UNRESOLVED REPORTS</h6>
                                        <span class="txt-light counter counter-anim">{{ $data["unresolved"] }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{--  <div class="row loader-overlay-parent">
            <div class="loader-overlay" style="position: absolute; height: 500px; width:500px; background: rgb(238,238,238); z-index:1;">
                <div class="loader" style="margin-left: auto;margin-right: auto;"></div>
                <div class="progress" style="margin-left: auto;margin-right: auto; padding:40px; text-align: center; height: 100px; width: 500px; background: inherit;">
                    <h4>Loading Registration Centers</h4>
            </div>
        </div>  --}}
    </div>

<?php  $userId = Auth::user()->id ?>
@stop

@section('scripts')
    
@stop