@extends('carewell.layout.layout')
@section('content')
<div class="container">
  <div class="row">
    <div class=" col-md-3 col-xs-12 pull-right no-padding">
      <button class="btn btn-primary top-element create-coverage-plan" type="button" ><i class="fa fa-plus btn-icon "></i>CREATE PLAN</button>
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
                <th>PLAN ID</th>
                <th>PLAN NAME</th>
                <th>PLAN MBL</th>
                <th>PLAN ABL</th>
                <th>PLAN CASE HANDLING</th>
                <th>PLAN PRE-EXISTING</th>
                <th>PLAN PREMIUM</th>
                <th>PLAN ADDED</th>
                <th>ACTION</th>
              </tr>
              @foreach($_active_coverage_plan as $coverage_plan)
              <tr>
                <td>{{$coverage_plan->coverage_plan_id}}</td>
                <td>{{$coverage_plan->coverage_plan_name}}</td>
                <td>{{$coverage_plan->coverage_plan_maximum_benefit}}</td>
                <td>{{$coverage_plan->coverage_plan_annual_benefit}}</td>
                <td>{{$coverage_plan->coverage_plan_case_handling}}</td>
                <td>{{$coverage_plan->coverage_plan_preexisting}}</td>
                <td>{{$coverage_plan->coverage_plan_premium}}</td>
                <td>{{date("F j, Y",strtotime($coverage_plan->coverage_plan_created))}}</td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                      <li><button type="button" data-coverage_plan_id="{{$coverage_plan->coverage_plan_id}}" class="btn btn-link coverage-plan-details"><i class="fa fa-eye btn-icon"></i>  View Plan</button></li>
                      <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Archived Plan</button></li>
                    </ul>
                  </div>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
          <div class="box-footer clearfix">
            @include('globals.pagination', ['paginator' => $_active_coverage_plan])
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="inActiveCompany">
          <div class="row">
            <div class="col-md-3 col-xs-12 pull-right">
              <div class="input-group top-element">
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
                <th>PLAN ID</th>
                <th>PLAN NAME</th>
                <th>PLAN MBL</th>
                <th>PLAN ABL</th>
                <th>PLAN CASE HANDLING</th>
                <th>PLAN PRE-EXISTING</th>
                <th>PLAN PREMIUM</th>
                <th>PLAN ADDED</th>
                <th>ACTION</th>
              </tr>
              @foreach($_inactive_coverage_plan as $coverage_plan)
              <tr>
                <td>{{$coverage_plan->coverage_plan_id}}</td>
                <td>{{$coverage_plan->coverage_plan_name}}</td>
                <td>{{$coverage_plan->coverage_plan_maximum_benefit}}</td>
                <td>{{$coverage_plan->coverage_plan_annual_benefit}}</td>
                <td>{{$coverage_plan->coverage_plan_case_handling}}</td>
                <td>{{$coverage_plan->coverage_plan_preexisting}}</td>
                <td>{{$coverage_plan->coverage_plan_premium}}</td>
                <td>{{date("F j, Y",strtotime($coverage_plan->coverage_plan_created))}}</td>
                <td>
                  <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                      <li><button type="button" data-coverage_plan_id="{{$coverage_plan->coverage_plan_id}}" class="btn btn-link coverage-plan-details"><i class="fa fa-eye btn-icon"></i>  View Plan</button></li>
                      <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Archived Plan</button></li>
                    </ul>
                  </div>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
          <div class="box-footer clearfix">
            @include('globals.pagination', ['paginator' => $_inactive_coverage_plan])
          </div>
        </div>
      </div>
      <!-- /.tab-content -->
    </div>
  </div>
</div>
@endsection