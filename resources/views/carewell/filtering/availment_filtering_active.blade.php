<div class="box-body table-responsive no-padding">
  <table class="table table-hover table-bordered">
    <tr>
      <th>APPROVAL #</th>
      <th>UNIVERSAL ID</th>
      <th>CAREWELL ID</th>
      <th>MEMBER NAME</th>
      <th>COMPANY</th>
      <th>PROVIDER</th>
      <th>DATE ISSUED</th>
      <th>ACTION</th>
    </tr>
    @foreach($_approval as $approval)
    <tr>
      <td>{{$approval->approval_number}}</td>
      <td>{{$approval->member_universal_id}}</td>
      <td>{{$approval->member_carewell_id}}</td>
      <td>{{$approval->member_first_name." ".$approval->member_last_name }}</td>
      <td>{{$approval->company_name}}</td>
      <td>{{$approval->provider_name}}</td>
      <td>{{date("F j, Y",strtotime($approval->approval_created))}}</td>
      <td>
        <div class="btn-group">
          <button type="button" class="btn btn-danger">Action</button>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
            <li><button type="button" data-approval_id="{{$approval->approval_id}}" class="btn btn-link view-approval-details"><i class="fa fa-eye btn-icon"></i>  View Approval</button></li>
            <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Archived Approval</button></li>
          </ul>
        </div>
      </td>
    </tr>
    @endforeach
  </table>
</div>
<div class="box-footer clearfix">
  @include('globals.pagination', ['paginator' => $_approval])
</div>