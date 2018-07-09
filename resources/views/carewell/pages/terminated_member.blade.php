@extends('carewell.layout.layout')
@section('content')
<div class="container">
    <div class="row">
        <div class=" col-md-3 col-xs-6 pull-right no-padding">
            <button class="btn btn-primary top-element upload-terminated-member" type="button" ><i class="fa fa-plus btn-icon "></i>UPLOAD TERMINATED MEMBER</button>
        </div>
    </div>
    <div class="row">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#activeUser" data-toggle="tab">TERMINATED </a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="terminatedTab">
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
                            @include('globals.pagination_v2', ['paginator' => $_member_terminated])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection