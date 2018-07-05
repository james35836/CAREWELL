@extends('carewell.layout.layout')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3 col-xs-12 pull-right no-padding">
            <div class="dropdown">
                <button class="btn btn-primary top-element dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-plus btn-icon "></i>CREATE MEMBER
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <button type="button" class="btn btn-link  create-member"><i class="fa   fa-pencil-square btn-icon" ></i>CREATE MANUALLY</button>
                    <button type="button" class="btn btn-link   import-member"><i class="fa fa-file-excel-o btn-icon" ></i>IMPORT EXCEL</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#activeTab" data-toggle="tab">ACTIVE </a></li>
                <li><a href="#inActiveTab" data-toggle="tab">INACTIVE </a></li>
                <li><a href="#terminatedTab" data-toggle="tab">TERMINATED</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="activeTab">
                    <div class="row">
                        <div class=" col-md-3 col-xs-12 pull-left">
                            <select class="form-control top-element filtering" data-archived="0" data-name="member">
                                <option>SELECT COMPANY</option>
                                @foreach($_company as $company)
                                <option value="{{$company->company_id}}">{{$company->company_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-xs-12 pull-right">
                            <div class="input-group top-element">
                                <input type="text" class="form-control search-key">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default searching" data-name="member" data-archived="0"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="showTable" class="load-data load-active-member" data-target="load-active-member">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th class="live-search">UNIVERSAL ID</th>
                                    <th class="live-search">FULL NAME</th>
                                    <th class="live-search">CAREWELL ID</th>
                                    <th class="live-search">COMPANY</th>
                                    <th class="live-search">DATE ADDED</th>
                                    <th class="live-search">ACTION</th>
                                </tr>
                                @foreach($_member_active as $member)
                                <tr>
                                    <td>{{$member->member_universal_id}}</td>
                                    <td>{{$member->member_first_name}} {{$member->member_last_name}}</td>
                                    <td>{{$member->member_carewell_id}}</td>
                                    <td>{{$member->company_name}}</td>
                                    <td>{{date("F j, Y",strtotime($member->member_created))}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                <li><button type="button" data-member_id="{{$member->member_id}}" class="btn btn-link view-member-details"><i class="fa fa-eye btn-icon"></i>  View Member</button></li>
                                                <li><button type="button" data-id="{{$member->member_id}}" class="btn btn-link page-action" data-status="2" data-alert = "archive" data-name="MEMBER"><i class="fa fa-trash btn-icon"></i> Archive Member</button></li>
                                                <li><button type="button" data-id="{{$member->member_id}}" class="btn btn-link page-action" data-status="1" data-alert = "terminate" data-name="MEMBER"><i class="fa fa-trash btn-icon"></i> Terminate Member</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            @include('globals.pagination_v2', ['paginator' => $_member_active])
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="inActiveTab">
                    <div class="row">
                        <div class="col-md-3 col-xs-12 pull-left">
                            <select class="form-control top-element filtering" data-archived="2" data-name="member">
                                <option>SELECT COMPANY</option>
                                @foreach($_company as $company)
                                <option value="{{$company->company_id}}">{{$company->company_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-xs-12 pull-right">
                            <div class="input-group top-element">
                                <input type="text" class="form-control search-key">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default searching" data-name="member" data-archived="2"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="showTable" class="load-data load-inactive-member" data-target="load-inactive-member">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>UNIVERSAL ID</th>
                                    <th>FULL NAME</th>
                                    <th>CAREWELL ID</th>
                                    <th>COMPANY</th>
                                    <th>DATE ADDED</th>
                                    <th>ACTION</th>
                                </tr>
                                @foreach($_member_inactive as $member)
                                <tr>
                                    <td>{{$member->member_universal_id}}</td>
                                    <td>{{$member->member_first_name}} {{$member->member_last_name}}</td>
                                    <td>{{$member->member_carewell_id}}</td>
                                    <td>{{$member->company_name}}</td>
                                    <td>{{date("F j, Y",strtotime($member->member_created))}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                <li><button type="button" data-member_id="{{$member->member_id}}" class="btn btn-link view-member-details"><i class="fa fa-eye btn-icon"></i>  View Member</button></li>
                                                <li><button type="button" data-id="{{$member->member_id}}" class="btn btn-link page-action" data-status="0" data-alert = "restore" data-name="MEMBER"><i class="fa fa-trash btn-icon"></i> Restore Member</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            @include('globals.pagination_v2', ['paginator' => $_member_inactive])
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="terminatedTab">
                    <div class="row">
                        <div class="col-md-3 col-xs-12 pull-left">
                            <select class="form-control top-element filtering" data-archived="1" data-name="member">
                                <option>SELECT COMPANY</option>
                                @foreach($_company as $company)
                                <option value="{{$company->company_id}}">{{$company->company_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3 col-xs-12 pull-right">
                            <div class="input-group top-element">
                                <input type="text" class="form-control search-key">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default searching" data-name="member" data-archived="1"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="showTable" class="load-data load-inactive-member" data-target="load-inactive-member">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>UNIVERSAL ID</th>
                                    <th>FULL NAME</th>
                                    <th>CAREWELL ID</th>
                                    <th>COMPANY</th>
                                    <th>DATE ADDED</th>
                                    <th>ACTION</th>
                                </tr>
                                @foreach($_member_terminated as $member)
                                <tr>
                                    <td>{{$member->member_universal_id}}</td>
                                    <td>{{$member->member_first_name}} {{$member->member_last_name}}</td>
                                    <td>{{$member->member_carewell_id}}</td>
                                    <td>{{$member->company_name}}</td>
                                    <td>{{date("F j, Y",strtotime($member->member_created))}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                <li><button type="button" data-member_id="{{$member->member_id}}" class="btn btn-link view-member-details"><i class="fa fa-eye btn-icon"></i>  View Member</button></li>
                                                <li><button type="button"  class="btn btn-link member-adjustment" data-member_id="{{$member->member_id}}"><i class="fa fa-plus btn-icon"></i>  Make Adjustment</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            @include('globals.pagination_v2', ['paginator' => $_member_inactive])
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection