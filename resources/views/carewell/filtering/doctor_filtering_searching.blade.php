<div class="box-body table-responsive no-padding">
    <table class="table table-hover table-bordered">
        <tr>
            <th>DOCTOR ID</th>
            <th>PROVIDER</th>
            <th>NAME</th>
            <th>DATE ADDED</th>
            <th>ACTION</th>
        </tr>
        @foreach($_return_data as $return_data)
        <tr>
            <td>{{sprintf("%05d",$return_data->doctor_id)}}</td>
            <td>
                @foreach($return_data->provider as  $provider)
                <span class="label label-default">{{$provider->provider_name}}</span>
                @endforeach
            </td>
            <td>{{$return_data->doctor_full_name}}</td>
            <td>{{date("F j, Y",strtotime($return_data->doctor_created))}}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                        @if($archived==0)
                        <li><button type="button" data-doctor_id="{{$return_data->doctor_id}}" class="btn btn-link view-doctor-details"><i class="fa fa-eye btn-icon"></i>  View Doctor</button></li>
                        <li><button type="button" data-id="{{$return_data->doctor_id}}" class="btn btn-link page-action" data-status="1" data-alert = "archive" data-name="DOCTOR"><i class="fa fa-trash btn-icon"></i> Archive Doctor</button></li>
                        @elseif($archived==1)
                        <li><button type="button" data-doctor_id="{{$return_data->doctor_id}}" class="btn btn-link view-doctor-details"><i class="fa fa-eye btn-icon"></i>  View Doctor</button></li>
                        <li><button type="button" data-id="{{$return_data->doctor_id}}" class="btn btn-link page-action" data-status="0" data-alert = "restore" data-name="DOCTOR"><i class="fa fa-trash btn-icon"></i> Restore Doctor</button></li>
                        @endif
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div class="box-footer clearfix">
    @include('globals.pagination_v2', ['paginator' => $_return_data])
</div>