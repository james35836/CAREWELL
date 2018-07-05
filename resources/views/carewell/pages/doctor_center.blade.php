@extends('carewell.layout.layout')
@section('content')
<div class="container">
    <div class="row">
        <div class=" col-md-3 col-xs-12 pull-right no-padding">
            <button class="btn btn-primary top-element add-doctor" type="button" ><i class="fa fa-plus btn-icon "></i>ADD DOCTOR</button>
        </div>
    </div>
    <div class="row">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#activeCompany" data-toggle="tab">ACTIVE </a></li>
                <li><a href="#inActiveCompany" data-toggle="tab">INACTIVE </a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="activeCompany">
                    <div class="row">
                        <div class=" col-md-3 col-xs-12 pull-left">
                            <select class="form-control top-element filtering" data-archived="0" data-name="doctor">
                                <option>SELECT PROVIDER</option>
                                @foreach($_provider as $provider)
                                <option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-xs-12 pull-right">
                            <div class="input-group top-element">
                                <input type="text" class="form-control search-key">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default searching" data-name="doctor" data-archived="0"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="showTable" class="load-data load-active-doctor" data-target="load-active-doctor">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>DOCTOR ID</th>
                                    <th>NAME</th>
                                    <th>PROVIDER</th>
                                    <th>DATE ADDED</th>
                                    <th>ACTION</th>
                                </tr>
                                @foreach($_doctor_active as $doctor)
                                <tr>
                                    <td>{{sprintf("%05d",$doctor->doctor_id)}}</td>
                                    <td>{{$doctor->doctor_full_name}}</td>
                                    <td>
                                        @foreach($doctor->provider as  $provider)
                                        <span class="label label-default">{{$provider->provider_name}}</span>
                                        @endforeach
                                    </td>
                                    <td>{{date("F j, Y",strtotime($doctor->doctor_created))}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                <li><button type="button" data-doctor_id="{{$doctor->doctor_id}}" class="btn btn-link view-doctor-details"><i class="fa fa-eye btn-icon"></i>  View Doctor</button></li>
                                                <li><button type="button" data-id="{{$doctor->doctor_id}}" class="btn btn-link page-action" data-status="1" data-alert = "archive" data-name="DOCTOR"><i class="fa fa-trash btn-icon"></i> Archive Doctor</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            @include('globals.pagination_v2', ['paginator' => $_doctor_active])
                        </div>
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="inActiveCompany">
                    <div class="row">
                        <div class=" col-md-3 col-xs-12 pull-left">
                            <select class="form-control top-element filtering" data-archived="1" data-name="doctor">
                                <option>SELECT PROVIDER</option>
                                @foreach($_provider as $provider)
                                <option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-xs-12 pull-right">
                            <div class="input-group top-element">
                                <input type="text" class="form-control search-key">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default searching" data-name="doctor" data-archived="1"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="showTable" class="load-data load-inactive-doctor" data-target="load-inactive-doctor">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>DOCTOR ID</th>
                                    <th>NAME</th>
                                    <th>PROVIDER</th>
                                    <th>DATE ADDED</th>
                                    <th>ACTION</th>
                                </tr>
                                @foreach($_doctor_inactive as $doctor)
                                <tr>
                                    <td>{{sprintf("%05d",$doctor->doctor_id)}}</td>
                                    <td>{{$doctor->doctor_full_name}}</td>
                                    <td>
                                        @foreach($doctor->provider as  $provider)
                                        <span class="label label-default">{{$provider->provider_name}}</span>
                                        @endforeach
                                    </td>
                                    <td>{{date("F j, Y",strtotime($doctor->doctor_created))}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                <li><button type="button" data-doctor_id="{{$doctor->doctor_id}}" class="btn btn-link view-doctor-details"><i class="fa fa-eye btn-icon"></i>  View Doctor</button></li>
                                                <li><button type="button" data-id="{{$doctor->doctor_id}}" class="btn btn-link page-action" data-status="0" data-alert = "restore" data-name="DOCTOR"><i class="fa fa-trash btn-icon"></i> Restore Doctor</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            @include('globals.pagination_v2', ['paginator' => $_doctor_inactive])
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.tab-content -->
        </div>
    </div>
</div>
@endsection