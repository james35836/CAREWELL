<div class="box-body table-responsive no-padding">
  <table class="table table-hover table-bordered">
    <tr>
      <th>UNIVERSAL ID</th>
      <th>FULL NAME</th>
      <th>CAREWELL ID</th>
      <th>COMPANY</th>
      <th>DATE ADDED</th>
      <th>ACTION</th>
    </tr>
    @foreach($_member_inactive as $member_inactive)
    <tr>
      <td>{{$member_inactive->member_universal_id}}</td>
      <td>{{$member_inactive->member_first_name}} {{$member_inactive->member_last_name}}</td>
      <td>{{$member_inactive->member_carewell_id}}</td>
      <td>{{$member_inactive->company_name}}</td>
      <td>{{date("F j, Y",strtotime($member_inactive->member_created))}}</td>
      <td>
        <div class="btn-group">
          <button type="button" class="btn btn-danger">Action</button>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
            <li><button type="button" data-member_id="{{$member_inactive->member_id}}" class="btn btn-link view-member-details"><i class="fa fa-eye btn-icon"></i>  View Member</button></li>
            <li><button type="button" class="btn btn-link restore" data-id="{{$member_inactive->member_id}}" data-name="MEMBER"><i class="fa fa-trash btn-icon"></i> Restore Member</button></li>
          </ul>
        </div>
      </td>
    </tr>
    @endforeach
  </table>
</div>
<div class="box-footer clearfix">
  @include('globals.pagination', ['paginator' => $_member_inactive])
</div>