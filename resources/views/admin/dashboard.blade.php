@extends('layouts.admin')
@section('page_heading','App Management Panel')
@section('content')

    <!-- /.row -->
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-comments fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$commentsCount}}</div>
                                <div>Comments</div>
                            </div>
                        </div>
                    </div>
                    {{--<a href="#">--}}
                        {{--<div class="panel-footer">--}}
                            {{--<span class="pull-left">View Details</span>--}}
                            {{--<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>--}}
                            {{--<div class="clearfix"></div>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-image fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$imagesCount}}</div>
                                <div>Photos</div>
                            </div>
                        </div>
                    </div>
                    {{--<a href="#">--}}
                        {{--<div class="panel-footer">--}}
                            {{--<span class="pull-left">View Details</span>--}}
                            {{--<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>--}}
                            {{--<div class="clearfix"></div>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-file-image-o fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$albumsCount}}</div>
                                <div>Albums</div>
                            </div>
                        </div>
                    </div>
                    {{--<a href="#">--}}
                        {{--<div class="panel-footer">--}}
                            {{--<span class="pull-left">View Details</span>--}}
                            {{--<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>--}}
                            {{--<div class="clearfix"></div>--}}
                        {{--</div>--}}
                    {{--</a>--}}
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-users fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">{{$usersCount}}</div>
                                <div>Users</div>
                            </div>
                        </div>
                    </div>
                    <a href="{{url('admin/users')}}">
                        <div class="panel-footer">
                            <span class="pull-left">View Users</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.row -->

    <!-- /.col-lg-4 -->

@stop
