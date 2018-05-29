<div class="box-body table-responsive no-padding">
  <table class="table table-hover table-bordered">
    <tr>
      <th>PLAN ID</th>
      <th>PLAN NAME</th>
      <th>PLAN MBL</th>
      <th>PLAN ABL</th>
      <th>PLAN PRE-EXISTING</th>
      <th>PLAN PREMIUM</th>
      <th>PLAN ADDED</th>
      <th>ACTION</th>
    </tr>
    @foreach($_active_coverage_plan as $coverage_plan)
    <tr>
      <td>{{$coverage_plan->coverage_plan_id}}</td>
      <td>{{$coverage_plan->coverage_plan_name}}</td>
      <td>{{number_format($coverage_plan->coverage_plan_maximum_benefit)}}</td>
      <td>{{number_format($coverage_plan->coverage_plan_annual_benefit)}}</td>
      <td>{{$coverage_plan->coverage_plan_preexisting}}</td>
      <td>{{number_format($coverage_plan->coverage_plan_premium)}}</td>
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