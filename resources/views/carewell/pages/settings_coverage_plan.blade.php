@extends('carewell.layout.layout')
@section('content')
@include('carewell.modals.settings_coverage_modals')
<div class="container">
  <div class="row">
    <div class=" col-md-2 pull-right">
      <button type="button" class="btn btn-primary  create-coverage-plan button-lg"><i class="fa fa-plus btn-icon"></i>CREATE NEW PLAN</button>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">COVERAGE PLAN LIST</h3>
          <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px;">
              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
              <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search" ></i></button>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
          <table class="table table-hover table-bordered">
            <tr>
              <th>PLAN ID</th>
              <th>PLAN NAME</th>
              <th>PLAN CONFINEMENT</th>
              <th>PLAN MAX BENEFIT</th>
              <th>PLAN CASE HANDLING</th>
              <th>PLAN AGE BRACKET</th>
              <th>PLAN MONTHLY PREMIUM</th>
              <th>STATUS</th>
              <th>ACTION</th>
            </tr>
            @foreach($_coverage_plan as $coverage_plan)
            <tr>
              <td>{{$coverage_plan->coverage_plan_id}}</td>
              <td>{{$coverage_plan->coverage_name}}</td>
              <td>{{$coverage_plan->coverage_patient_confinement}}</td>
              <td>{{$coverage_plan->coverage_maximum_benefit}}</td>
              <td>{{$coverage_plan->coverage_case_handling}}</td>
              <td>{{$coverage_plan->coverage_age_bracket}}</td>
              <td>{{$coverage_plan->coverage_monthly_premium}}</td>
              <td><span class="label label-success">Active</span></td>
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
            <tr style="height: 70px;">
            </tr>
          </table>
        </div>
        <div class="box-footer clearfix">
          @include('globals.pagination', ['paginator' => $_coverage_plan])
        </div>
      </div>
    </div>
  </div>
</div>
@endsection