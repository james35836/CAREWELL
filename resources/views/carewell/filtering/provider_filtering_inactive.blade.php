<div class="box-body table-responsive no-padding">
    <table class="table table-hover table-bordered">
        <tr>
            <th>PROVIDER NUMBER</th>
            <th>PROVIDER NAME</th>
            <th>DATE ADDED</th>
            <th>ACTION</th>
        </tr>
        @foreach($_provider_inactive as $provider_inactive)
        <tr>
            <td>{{sprintf("%05d",$provider_inactive->provider_id)}}</td>
            <td>{{$provider_inactive->provider_name}}</td>
            <td>{{date("F j, Y",strtotime($provider_inactive->provider_created))}}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                        <li><button type="button" data-provider_id="{{$provider_inactive->provider_id}}" class="btn btn-link view-provider-details"><i class="fa fa-eye btn-icon"></i>  View Provider</button></li>
                        <li><button type="button" class="btn btn-link restore" data-id="{{$provider_inactive->provider_id}}" data-name="PROVIDER" ><i class="fa fa-undo btn-icon"></i> Restore Provider</button></li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div class="box-footer clearfix">
    @include('globals.pagination_v2', ['paginator' => $_provider_inactive])
</div>