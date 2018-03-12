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
  </table>
</div>
<div class="box-footer clearfix">
  @include('globals.pagination', ['paginator' => $_company_active])
</div>