<div class="box-body table-responsive no-padding">
    <table class="table table-hover table-bordered">
        <tr>
            <th>PROVIDER NUMBER</th>
            <th>PROVIDER NAME</th>
            <th>DATE ADDED</th>
            <th>ACTION</th>
        </tr>
        @foreach($_return_data as $return_data)
        <tr>
            <td>{{sprintf("%05d",$return_data->provider_id)}}</td>
            <td>{{$return_data->provider_name}}</td>
            <td>{{date("F j, Y",strtotime($return_data->provider_created))}}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                        @if($archived==0)
                        <li><button type="button" data-provider_id="{{$return_data->provider_id}}" class="btn btn-link view-provider-details"><i class="fa fa-eye btn-icon"></i>  View Provider</button></li>
                        <li><button type="button" data-id="{{$return_data->provider_id}}" class="btn btn-link page-action" data-status="1" data-alert = "archive" data-name="PROVIDER"><i class="fa fa-trash btn-icon"></i> Archive Provider</button></li>
                        @elseif($archived==1)
                        <li><button type="button" data-provider_id="{{$return_data->provider_id}}" class="btn btn-link view-provider-details"><i class="fa fa-eye btn-icon"></i>  View Provider</button></li>
                        <li><button type="button" data-id="{{$return_data->provider_id}}" class="btn btn-link page-action" data-status="0" data-alert = "restore" data-name="PROVIDER"><i class="fa fa-trash btn-icon"></i> Restore Provider</button></li>
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