<div class="box-body table-responsive no-padding">
  <table class="table table-hover table-bordered">
    <tr>
      <th>DOCTOR ID</th>
      <th>PROVIDER</th>
      <th>NAME</th>
      <th>SPECIALIZATION</th>
      <th>DATE ADDED</th>
      <th>STATUS</th>
      <th>ACTION</th>
    </tr>
    @foreach($_doctor_active as $doctor_active)
    <tr>
      <td>{{sprintf("%05d",$doctor_active->doctor_id)}}</td>
      <td>
        @foreach($doctor_active->provider as  $provider)
        <span class="label label-default">{{$provider->provider_name}}</span>
        @endforeach
      </td>
      <td>{{$doctor_active->doctor_first_name}} {{$doctor_active->doctor_last_name}}</td>
      <td>
        @foreach($doctor_active->specialization as $specialization)
        <span class="label label-default">{{$specialization->specialization_name}}</span>
        @endforeach
      </td>
      <td>{{date("F j, Y",strtotime($doctor_active->doctor_created))}}</td>
      <td>
        <span class="label label-success">active</span>
      </td>
      <td>
        <div class="btn-group">
          <button type="button" class="btn btn-danger">Action</button>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
            <li><button type="button" data-doctor_id="{{$doctor_active->doctor_id}}" class="btn btn-link view-doctor-details"><i class="fa fa-eye btn-icon"></i>  View Doctor</button></li>
            <li><button type="button" data-id="{{$doctor_active->doctor_id}}" data-name="DOCTOR" class="btn btn-link archived"><i class="fa fa-trash btn-icon"></i> Archived Doctor</button></li>
          </ul>
        </div>
      </td>
    </tr>
    @endforeach
  </table>
</div>
<div class="box-footer clearfix">
  @include('globals.pagination', ['paginator' => $_doctor_active])
</div>