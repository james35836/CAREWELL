@extends('carewell.layout.layout')
@section('content')
<div class="container">
    <div class="row">
        <div class=" col-md-3 col-xs-12 pull-right no-padding">
            <button class="btn btn-primary top-element create-cal" type="button" ><i class="fa fa-plus btn-icon "></i>CREATE CAL</button>
        </div>
    </div>
    <div class="row">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#open" data-toggle="tab">OPEN  </a></li>
                <li><a href="#pending" data-toggle="tab">PENDING </a></li>
                <li><a href="#close" data-toggle="tab">CLOSE </a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="open">
                    <div class="row">
                        <div class=" col-md-3 col-xs-12 pull-left">
                            <select class="form-control top-element filtering" data-archived="0" data-name="billing">
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
                                    <button type="button" class="btn btn-default searching" data-name="billing" data-archived="0"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="showTable" class="load-data load-open-cal" data-target="load-open-cal">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>CAL #</th>
                                    <th>COMPANY</th>
                                    <th>REVENUE YEAR</th>
                                    <th>MODE OF PAYMENT</th>
                                    <th># OF MEMBER</th>
                                    <th>DATE CREATED</th>
                                    <th>ACTION</th>
                                </tr>
                                @foreach($_cal_open as $cal_open)
                                <tr>
                                    <td>{{$cal_open->cal_number}}</td>
                                    <td>{{$cal_open->company_name}}</td>
                                    <td>{{$cal_open->cal_reveneu_period_year}}</td>
                                    <td>{{$cal_open->cal_payment_mode}}</td>
                                    <td>{{$cal_open->members +  $cal_open->new_member}}</td>
                                    <td>{{date("F j, Y",strtotime($cal_open->cal_created))}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                <li><button type="button" data-cal_id="{{$cal_open->cal_id}}" data-reference="{{$cal_open->reference}}" data-company_id="{{$cal_open->company_id}}" class="btn btn-link cal-view-details"><i class="fa fa-eye btn-icon"></i>  View Details</button></li>
                                                <?php $total = $cal_open->members + $cal_open->new_member; ?>
                                                @if($total!=0)
                                                <li><button type="button" data-cal_id="{{$cal_open->cal_id}}" class="btn btn-link close-cal"><i class="fa fa-trash btn-icon"></i> Mark as Close</button></li>
                                                <li><button type="button" data-cal_id="{{$cal_open->cal_id}}" class="btn btn-link cal-pending-confirm"><i class="fa fa-trash btn-icon"></i> Mark as Pending</button></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            @include('globals.pagination_v2', ['paginator' => $_cal_open])
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="pending">
                    <div class="row">
                        <div class=" col-md-3 col-xs-12 pull-left">
                            <select class="form-control top-element filtering" data-archived="2" data-name="billing">
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
                                    <button type="button" class="btn btn-default searching" data-name="billing" data-archived="2"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="showTable" class="load-data load-pending-cal" data-target="load-pending-cal">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>CAL #</th>
                                    <th>COMPANY</th>
                                    <th>REVENUE YEAR</th>
                                    <th>MODE OF PAYMENT</th>
                                    <th># OF MEMBER</th>
                                    <th>DATE CREATED</th>
                                    <th>ACTION</th>
                                </tr>
                                @foreach($_cal_pending as $cal_pending)
                                <tr>
                                    <td>{{$cal_pending->cal_number}}</td>
                                    <td>{{$cal_pending->company_name}}</td>
                                    <td>{{$cal_pending->cal_reveneu_period_year}}</td>
                                    <td>{{$cal_pending->cal_payment_mode}}</td>
                                    <td>{{$cal_pending->members}}</td>
                                    <td>{{date("F j, Y",strtotime($cal_pending->cal_created))}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                <li><button type="button" data-cal_id="{{$cal_pending->cal_id}}" data-reference="{{$cal_pending->reference}}" data-company_id="{{$cal_pending->company_id}}" class="btn btn-link cal-view-details"><i class="fa fa-eye btn-icon"></i>  View Details</button></li>
                                                <li><button type="button" data-cal_id="{{$cal_pending->cal_id}}" class="btn btn-link close-cal"><i class="fa fa-trash btn-icon"></i> Mark as Close</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="box-footer clearfix">
                        @include('globals.pagination_v2', ['paginator' => $_cal_pending])
                    </div>
                </div>
                <div class="tab-pane" id="close">
                    <div class="row">
                        <div class=" col-md-3 col-xs-12 pull-left">
                            <select class="form-control top-element filtering" data-archived="1" data-name="billing">
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
                                    <button type="button" class="btn btn-default searching" data-name="billing" data-archived="1"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="showTable" class="load-data load-close-cal" data-target="load-close-cal">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>CAL #</th>
                                    <th>COMPANY</th>
                                    <th>REVENUE YEAR</th>
                                    <th>MODE OF PAYMENT</th>
                                    <th># OF MEMBER</th>
                                    <th>DATE CREATED</th>
                                    <th>ACTION</th>
                                </tr>
                                @foreach($_cal_close as $cal_close)
                                <tr>
                                    <td>{{$cal_close->cal_number}}</td>
                                    <td>{{$cal_close->company_name}}</td>
                                    <td>{{$cal_close->cal_reveneu_period_year}}</td>
                                    <td>{{$cal_close->cal_payment_mode}}</td>
                                    <td>{{$cal_close->members}}</td>
                                    <td>{{date("F j, Y",strtotime($cal_close->cal_created))}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                <li><button type="button" data-cal_id="{{$cal_close->cal_id}}" data-reference="{{$cal_close->reference}}" data-company_id="{{$cal_close->company_id}}" class="btn btn-link cal-view-details"><i class="fa fa-eye btn-icon"></i>  View Details</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            @include('globals.pagination_v2', ['paginator' => $_cal_close])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection