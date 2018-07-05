@extends('carewell.layout.layout')
@section('content')
<div class="container">
    <div class="row">
        <div class=" col-md-3 col-xs-12 pull-right no-padding">
            <button class="btn btn-primary top-element prompt-modal" type="button" ><i class="fa fa-plus btn-icon "></i>CREATE COMPANY</button>
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
                        
                        <div class="col-md-3 col-xs-12 pull-right">
                            <div class="input-group top-element">
                                <input type="text" class="form-control search-key">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default searching" data-name="company" data-archived="0"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="showTable" class="load-data load-active-company" data-target="load-active-company">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>COMPANY CODE</th>
                                    <th>COMPANY NAME</th>
                                    <th>COVERAGE PLAN</th>
                                    <th>CONTRACT NUMBER</th>
                                    <th>DATE ADDED</th>
                                    <th>ACTION</th>
                                </tr>
                                @foreach($_company_active as $company)
                                <tr>
                                    <td>{{$company->company_code}}</td>
                                    <td>{{$company->company_name}}</td>
                                    <td>
                                        @foreach($company->coverage_plan as $coverage_plan)
                                        <span class="label label-default">{{$coverage_plan->coverage_plan_name}}</span>
                                        @endforeach
                                    </td>
                                    <td>{{$company->contract_number}}</td>
                                    <td>{{date("F j, Y",strtotime($company->company_created))}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                <li><button type="button" data-company_id="{{$company->company_id}}" class="btn btn-link view-company-details"><i class="fa fa-eye btn-icon"></i>  View Company</button></li>
                                                <li><button type="button" data-id="{{$company->company_id}}" class="btn btn-link page-action" data-status="1" data-alert = "archive" data-name="COMPANY" @if($company->member!=0) disabled @endif><i class="fa fa-trash btn-icon"></i> Archive Company</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            @include('globals.pagination_v2', ['paginator' => $_company_active])
                        </div>
                    </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="inActiveCompany">
                    <div class="row">
                        <div class="col-md-3 col-xs-12 pull-right">
                            <div class="input-group top-element">
                                <input type="text" class="form-control search-key">
                                <span class="input-group-btn">
                                    <button type="button" class="btn btn-default searching" data-name="company" data-archived="1"><i class="fa fa-search"></i></button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div id="showTable" class="load-data load-inactive-company" data-target="load-inactive-company">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover table-bordered">
                                <tr>
                                    <th>COMPANY CODE</th>
                                    <th>COMPANY NAME</th>
                                    <th>COVERAGE PLAN</th>
                                    <th>CONTRACT NUMBER</th>
                                    <th>DATE CREATED</th>
                                    <th>ACTION</th>
                                </tr>
                                @foreach($_company_inactive as $company)
                                <tr>
                                    <td>{{$company->company_code}}</td>
                                    <td>{{$company->company_name}}</td>
                                    <td>
                                        @foreach($company->coverage_plan as $coverage_plan)
                                        <span class="label label-default">{{$coverage_plan->coverage_plan_name}}</span>
                                        @endforeach
                                    </td>
                                    <td>{{$company->contract_number}}</td>
                                    <td>{{date("F j, Y",strtotime($company->company_created))}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-danger">Action</button>
                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                                                <li><button type="button" data-company_id="{{$company->company_id}}" class="btn btn-link view-company-details"><i class="fa fa-eye btn-icon"></i>  View Company</button></li>
                                                <li><button type="button" data-id="{{$company->company_id}}" class="btn btn-link page-action" data-status="0" data-alert = "restore" data-name="COMPANY"><i class="fa fa-trash btn-icon"></i> Restore Company</button></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="box-footer clearfix">
                            @include('globals.pagination_v2', ['paginator' => $_company_inactive])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection