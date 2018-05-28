<div class="box-body table-responsive no-padding">
  <table class="table table-hover table-bordered">
    <tr>
      <th>DOCTOR ID</th>
      <th>PROVIDER</th>
      <th>NAME</th>
      <th>DATE ADDED</th>
      <th>ACTION</th>
    </tr>
    @foreach($_doctor_inactive as $doctor_inactive)
    <tr>
      <td>{{sprintf("%05d",$doctor_inactive->doctor_id)}}</td>
      <td>
        @foreach($doctor_inactive->provider as  $provider)
        <span class="label label-default">{{$provider->provider_name}}</span>
        @endforeach
      </td>
      <td>{{$doctor_inactive->doctor_full_name}}</td>
      <td>{{date("F j, Y",strtotime($doctor_inactive->doctor_created))}}</td>
      <td>
        <div class="btn-group">
          <button type="button" class="btn btn-danger">Action</button>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
            <li><button type="button" data-doctor_id="{{$doctor_inactive->doctor_id}}" class="btn btn-link view-doctor-details"><i class="fa fa-eye btn-icon"></i>  View Doctor</button></li>
            <li><button type="button" data-id="{{$doctor_inactive->doctor_id}}" data-name="DOCTOR" class="btn btn-link restore"><i class="fa fa-trash btn-icon"></i> Restore Doctor</button></li>
          </ul>
        </div>
      </td>
    </tr>
    @endforeach
  </table>
</div>
<div class="box-footer clearfix">
  @include('globals.pagination_v2', ['paginator' => $_doctor_inactive])
</div>