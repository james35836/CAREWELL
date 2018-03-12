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
  </table>
</div>
<div class="box-footer clearfix">
  @include('globals.pagination', ['paginator' => $_company_inactive])
</div>