<div class="box-body table-responsive no-padding">
  <table class="table table-hover table-bordered">
    <tr>
      <th>PROVIDER NUMBER</th>
      <th>PROVIDER NAME</th>
      <th>PAYEE</th>
      <th>DATE ADDED</th>
      <th>ACTION</th>
    </tr>
    @foreach($_provider_active as $provider_active)
    <tr>
      <td>{{sprintf("%05d",$provider_active->provider_id)}}</td>
      <td>{{$provider_active->provider_name}}</td>
      <td>
        @foreach($provider_active->provider_payee as $payee)
        <span class="label label-default">{{$payee->provider_payee_name}}</span>
        @endforeach
      </td>
      <td>{{date("F j, Y",strtotime($provider_active->provider_created))}}</td>
      <td>
        <div class="btn-group">
          <button type="button" class="btn btn-danger">Action</button>
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
          </button>
          <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
            <li><button type="button" data-provider_id="{{$provider_active->provider_id}}" class="btn btn-link view-provider-details"><i class="fa fa-eye btn-icon"></i>  View Provider</button></li>
            <li><button type="button" data-id="{{$provider_active->provider_id}}" data-name="PROVIDER" class="btn btn-link archived"><i class="fa fa-trash btn-icon"></i> Archived Provider</button></li>
          </ul>
        </div>
      </td>
    </tr>
    @endforeach
  </table>
</div>
<div class="box-footer clearfix">
  @include('globals.pagination', ['paginator' => $_provider_active])
</div>