@extends('carewell.layout.layout')
@section('content')
<div class="container">
    <div class="row">
        <div class=" col-md-3 col-xs-12 pull-right no-padding">
            <button class="btn btn-primary top-element create-payable" type="button" ><i class="fa fa-plus btn-icon "></i>CREATE PAYABLE</button>
        </div>
    </div>
    <div class="row">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#open" data-toggle="tab">OPEN</a></li>
                <li><a href="#close" data-toggle="tab">CLOSE</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="open">
                    <div class="row">
                        <div class=" col-md-3 col-xs-12 pull-left">
                            <select class="form-control filtering">
                                <option >SELECT PROVIDER</option>
                                @foreach($_provider as $provider)
                                <option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
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
                    <div id="showTable" class="load-data load-open-payable" data-target="load-open-payable">
                        <div class="table-responsive no-padding">
                            <table class="table table-hover table-bordered" >
                                <tr>
                                    <th class="live-search">ID</th>
                                    <th class="live-search">PROVIDER</th>
                                    <th class="live-search">SOA NUMBER</th>
                                    <th class="live-search">DATE RECEIVED</th>
                                    <th class="live-search">DUE DATE</th>
                                    <th class="live-search">AGE</th>
                                    <th class="live-search">APPROVAL NUMBER</th>
                                    <th class="live-search">APPROVED BY</th>
                                    <th class="live-search">PREPARATION DATE</th>
                                    <th class="live-search">ACTION</th>
                                </tr>
                                @foreach($_payable_open as $payable)
                                <tr>
                                    
                                    <td>{{$payable->payable_number}}</td>
                                    <td>{{$payable->provider_name}}</td>
                                    <td>{{$payable->payable_soa_number}}</td>
                                    <td>{{date("F j, Y",strtotime($payable->payable_recieved))}}</td>
                                    <td>{{date("F j, Y",strtotime($payable->payable_due))}}</td>
                                    <td><span class="label label-warning">{{$payable->payable_age}}</span></td>
                                    <td>
                                        @foreach($payable->approval_number as $approval_number)
                                        <span class="label label-default">{{$approval_number->approval_number}} Prepared by: {{$approval_number->user_first_name." ".$approval_number->user_last_name}}</span>
                                        @endforeach
                                    </td>
                                    <td>{{$payable->user_first_name." ".$payable->user_last_name}}</td>
                                    <td>{{date("F j, Y",strtotime($payable->payable_created))}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                <li><button type="button" data-payable_id="{{$payable->payable_id}}" class="btn btn-link view-payable-details"><i class="fa fa-eye btn-icon"></i>  View Payable</button></li>
                                                <li><button type="button" data-payable_id="{{$payable->payable_id}}" class="btn btn-link payable-mark-close"><i class="fa fa-trash btn-icon"></i> Mark as Close</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            @include('globals.pagination', ['paginator' => $_payable_open])
                        </div>
                    </div>
                </div>
                <div class="tab-pane " id="close">
                    <div class="row">
                        <div class=" col-md-3 col-xs-12 pull-left">
                            <select class="form-control filtering">
                                <option >SELECT PROVIDER</option>
                                @foreach($_provider as $provider)
                                <option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
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
                    <div id="showTable" class="load-data load-close-payable" data-target="load-close-payable">
                        <div class="table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th class="live-search">ID</th>
                                    <th class="live-search">PROVIDER</th>
                                    <th class="live-search">SOA NUMBER</th>
                                    <th class="live-search">DATE RECEIVED</th>
                                    <th class="live-search">DUE DATE</th>
                                    <th class="live-search">AGE</th>
                                    <th class="live-search">APPROVAL NUMBER</th>
                                    <th class="live-search">APPROVED BY</th>
                                    <th class="live-search">PREPARATION DATE</th>
                                    <th class="live-search">ACTION</th>
                                </tr>
                                @foreach($_payable_close as $payable)
                                <tr>
                                    
                                    <td>{{$payable->payable_number}}</td>
                                    <td >{{$payable->provider_name}}</td>
                                    <td>{{$payable->payable_soa_number}}</td>
                                    <td>{{date("F j, Y",strtotime($payable->payable_recieved))}}</td>
                                    <td>{{date("F j, Y",strtotime($payable->payable_due))}}</td>
                                    <td><span class="label label-warning">{{$payable->payable_age}}</span></td>
                                    <td>
                                        @foreach($payable->approval_number as $approval_number)
                                        <span class="label label-default">{{$approval_number->approval_number}} Prepared by: {{$approval_number->user_first_name." ".$approval_number->user_last_name}}</span>
                                        @endforeach
                                    </td>
                                    <td>{{$payable->user_first_name." ".$payable->user_last_name}}</td>
                                    <td>{{date("F j, Y",strtotime($payable->payable_created))}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                <li><button type="button" data-payable_id="{{$payable->payable_id}}" class="btn btn-link view-payable-details"><i class="fa fa-eye btn-icon"></i>  View Payable</button></li>
                                                <li><button type="button" data-payable_id="{{$payable->payable_id}}" class="btn btn-link payable-mark-close"><i class="fa fa-trash btn-icon"></i> Mark as Close</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            @include('globals.pagination', ['paginator' => $_payable_close])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection