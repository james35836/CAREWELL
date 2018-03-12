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
    @foreach($_member_active as $member_active)
    <tr>
      <td>{{$member_active->member_universal_id}}</td>
      <td>{{$member_active->member_first_name}} {{$member_active->member_last_name}}</td>
      <td>{{$member_active->member_carewell_id}}</td>
      <td>{{$member_active->company_name}}</td>
      <td>{{date("F j, Y",strtotime($member_active->member_created))}}</td>
      <td>
        <div class="btn-group">
          <button type="button" class="btn btn-danger">Action</button>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
            <li><button type="button" data-member_id="{{$member_active->member_id}}" class="btn btn-link view-member-details"><i class="fa fa-eye btn-icon"></i>  View Member</button></li>
            <li><button type="button" data-id="{{$member_active->member_id}}" data-name="MEMBER" class="btn btn-link archived"><i class="fa fa-trash btn-icon"></i> Archived Member</button></li>
          </ul>
        </div>
      </td>
    </tr>
    @endforeach
  </table>
</div>
<div class="box-footer clearfix">
  @include('globals.pagination', ['paginator' => $_member_active])
</div>