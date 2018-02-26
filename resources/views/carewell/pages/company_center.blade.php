@extends('carewell.layout.layout')
@section('content')
@include('carewell.modals.company_center_modals')
<div class="container">
  <div class="row">
    <div class=" col-md-2 col-xs-6 pull-right no-padding">
      <button class="btn btn-primary top-element create-company" type="button" ><i class="fa fa-plus btn-icon "></i>CREATE COMPANY</button>
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
                <th>COMPANY CODE</th>
                <th>COMPANY NAME</th>
                <th>COVERAGE PLAN</th>
                <th>CONTRACT NUMBER</th>
                <th>DATE ADDED</th>
                <th>ACTION</th>
              </tr>
              @foreach($_company_active as $company_active)
              <tr>
                <td>{{$company_active->company_code}}</td>
                <td>{{$company_active->company_name}}</td>
                <td>
                  @foreach($company_active->coverage_plan as $coverage_plan)
                  <span class="label label-default">{{$coverage_plan->coverage_plan_name}}</span>
                  @endforeach
                </td>
                <td>{{$company_active->contract_number}}</td>
                <td>{{date("F j, Y",strtotime($company_active->company_created))}}</td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                      <li><button type="button" data-company_id="{{$company_active->company_id}}" class="btn btn-link view-company-details"><i class="fa fa-eye btn-icon"></i>  View Company</button></li>
                      <li><button type="button" class="btn btn-link archived" data-id="{{$company_active->company_id}}" data-name="COMPANY"><i class="fa fa-trash btn-icon"></i> Archived Company</button></li>
                    </ul>
                  </div>
                </td>
              </tr>
              @endforeach
              <tr style="height:70px;">
              </tr>
            </table>
          </div>
          <div class="box-footer clearfix">
            @include('globals.pagination', ['paginator' => $_company_active])
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="inActiveCompany">
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
                <th>COMPANY CODE</th>
                <th>COMPANY NAME</th>
                <th>COVERAGE PLAN</th>
                <th>CONTRACT NUMBER</th>
                <th>DATE CREATED</th>
                <th>ACTION</th>
              </tr>
              @foreach($_company_inactive as $company_inactive)
              <tr>
                <td>{{$company_inactive->company_code}}</td>
                <td>{{$company_inactive->company_name}}</td>
                <td>
                  @foreach($company_inactive->coverage_plan as $coverage_plan)
                  <span class="label label-default">{{$coverage_plan->coverage_plan_name}}</span>
                  @endforeach
                </td>
                <td>{{$company_inactive->contract_number}}</td>
                <td>{{date("F j, Y",strtotime($company_inactive->company_created))}}</td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                      <li><button type="button" data-company_id="{{$company_inactive->company_id}}" class="btn btn-link view-company-details"><i class="fa fa-eye btn-icon"></i>  View Company</button></li>
                      <li><button type="button" data-id="{{$company_inactive->company_id}}" data-name="COMPANY" class="btn btn-link restore"><i class="fa fa-trash btn-icon "></i> Restore Company</button></li>
                    </ul>
                  </div>
                </td>
              </tr>
              @endforeach
              <tr style="height:70px;">
              </tr>
            </table>
          </div>
          <div class="box-footer clearfix">
            @include('globals.pagination', ['paginator' => $_company_inactive])
          </div>
        </div>
      </div>
      <!-- /.tab-content -->
    </div>
  </div>
</div>
@endsection