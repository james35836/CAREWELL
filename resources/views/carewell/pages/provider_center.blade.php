@extends('carewell.layout.layout')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 col-xs-12 pull-right no-padding">
            <div class="dropdown">
                <button class="btn btn-primary top-element dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-plus btn-icon "></i>CREATE PROVIDER
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <button type="button" class="btn btn-link  create-provider"><i class="fa   fa-pencil-square btn-icon" ></i>CREATE PROVIDER</button>
                    <button type="button" class="btn btn-link   import-provider"><i class="fa fa-file-excel-o btn-icon" ></i>IMPORT EXCEL</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#activeTab" data-toggle="tab">ACTIVE </a></li>
                <li><a href="#inActiveTab" data-toggle="tab">INACTIVE </a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="activeTab">
                    <div class="row">
                        <div class="col-md-3 col-xs-12 pull-right">
                            <div class="input-group top-element">
                                <input type="text" class="form-control search-key">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default searching" data-name="provider" data-archived="0"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="showTable" class="load-data load-active-provider" data-target="load-active-provider">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>PROVIDER NUMBER</th>
                                    <th>PROVIDER NAME</th>
                                    <th>DATE ADDED</th>
                                    <th>ACTION</th>
                                </tr>
                                @foreach($_provider_active as $provider)
                                <tr>
                                    <td>{{sprintf("%05d",$provider->provider_id)}}</td>
                                    <td>{{$provider->provider_name}}</td>
                                    <td>{{date("F j, Y",strtotime($provider->provider_created))}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                <li><button type="button" data-provider_id="{{$provider->provider_id}}" class="btn btn-link view-provider-details"><i class="fa fa-eye btn-icon"></i>  View Provider</button></li>
                                                <li><button type="button" data-id="{{$provider->provider_id}}" class="btn btn-link page-action" data-status="1" data-alert = "archive" data-name="PROVIDER"><i class="fa fa-trash btn-icon"></i> Archive Provider</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            @include('globals.pagination_v2', ['paginator' => $_provider_active])
                        </div>
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="inActiveTab">
                    <div class="row">
                        <div class="col-md-3 col-xs-12 pull-right">
                            <div class="input-group top-element">
                                <input type="text" class="form-control search-key">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default searching" data-name="provider" data-archived="1"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="showTable" class="load-data load-inactive-provider" data-target="load-inactive-provider">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>PROVIDER NUMBER</th>
                                    <th>PROVIDER NAME</th>
                                    <th>DATE ADDED</th>
                                    <th>ACTION</th>
                                </tr>
                                @foreach($_provider_inactive as $provider)
                                <tr>
                                    <td>{{sprintf("%05d",$provider->provider_id)}}</td>
                                    <td>{{$provider->provider_name}}</td>
                                    <td>{{date("F j, Y",strtotime($provider->provider_created))}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                <li><button type="button" data-provider_id="{{$provider->provider_id}}" class="btn btn-link view-provider-details"><i class="fa fa-eye btn-icon"></i>  View Provider</button></li>
                                                <li><button type="button" data-id="{{$provider->provider_id}}" class="btn btn-link page-action" data-status="0" data-alert = "restore" data-name="PROVIDER"><i class="fa fa-trash btn-icon"></i> Restore Provider</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            @include('globals.pagination_v2', ['paginator' => $_provider_inactive])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection