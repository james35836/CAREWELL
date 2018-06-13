@extends('carewell.layout.layout')
@section('content')
<div class="container">
    <div class="row">
        <div class=" col-md-2 col-xs-6 pull-right no-padding">
            <button class="btn btn-primary top-element create-position" type="button" ><i class="fa fa-plus btn-icon "></i>CREATE POSITION</button>
        </div>
    </div>
    <div class="row">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#activeUser" data-toggle="tab">ACTIVE </a></li>
                <li><a href="#inActiveUser" data-toggle="tab">INACTIVE </a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="activeUser">
                    <div class="row">
                        
                        <div class="col-md-3 col-xs-12 pull-right">
                            <div class="input-group margin">
                                <input type="text" class="form-control " id="search_key">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    <div class=" box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>USER ID</th>
                                <th>ID NUMBER</th>
                                <th>FULL NAME</th>
                                <th>EMAIL</th>
                                <th>GENDER</th>
                                <th>STATUS</th>
                                <th>DATE ADDED</th>
                                <th>ACTION</th>
                            </tr>
                            @foreach($_user_active as $user_active)
                            <tr>
                                <td>{{$user_active->user_id}}</td>
                                <td>{{$user_active->user_number}}</td>
                                <td>{{$user_active->user_first_name." ".$user_active->user_last_name}}</td>
                                <td>{{$user_active->user_email}}</td>
                                <td>{{$user_active->user_gender}}</td>
                                <td><span class="label label-success">active</span></td>
                                <td>{{date("F j, Y",strtotime($user_active->user_created))}}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger">Action</button>
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                            <li><button type="button" data-user_id="{{$user_active->user_id}}" class="btn btn-link view-user-details"><i class="fa fa-eye btn-icon"></i>  View User</button></li>
                                            <li><button type="button" data-id="{{$user_active->user_id}}" data-name="USER" class="btn btn-link archived"><i class="fa fa-trash btn-icon"></i> Archived User</button></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        @include('globals.pagination', ['paginator' => $_user_active])
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="inActiveUser">
                    <div class="row">
                        <div class="col-md-4 col-xs-12 pull-right">
                            <div class="input-group margin">
                                <input type="text" class="form-control">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="box-body table-responsive no-padding">
                        <table class="table table-hover table-bordered">
                            <tr>
                                <th>USER ID</th>
                                <th>ID NUMBER</th>
                                <th>FULL NAME</th>
                                <th>EMAIL</th>
                                <th>GENDER</th>
                                <th>STATUS</th>
                                <th>DATE ADDED</th>
                                <th>ACTION</th>
                            </tr>
                            @foreach($_user_archived as $user_archived)
                            <tr>
                                <td>{{$user_archived->user_id}}</td>
                                <td>{{$user_archived->user_number}}</td>
                                <td>{{$user_archived->user_first_name." ".$user_archived->user_last_name}}</td>
                                <td>{{$user_archived->user_email}}</td>
                                <td>{{$user_archived->user_gender}}</td>
                                <td><span class="label label-success">active</span></td>
                                <td>{{date("F j, Y",strtotime($user_archived->user_created))}}h</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger">Action</button>
                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                            <li><button type="button" data-user_id="{{$user_archived->user_id}}" class="btn btn-link view-user-details"><i class="fa fa-eye btn-icon"></i>  View User</button></li>
                                            <li><button type="button" data-id="{{$user_archived->user_id}}" data-name="USER" class="btn btn-link restore" ><i class="fa fa-trash btn-icon"></i> Restore User </button></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="box-footer clearfix">
                        @include('globals.pagination', ['paginator' => $_user_archived])
                    </div>
                </div>
            </div>
            <!-- /.tab-content -->
        </div>
    </div>
</div>
@endsection