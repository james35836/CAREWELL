<div class="box-body table-responsive no-padding">
    <table class="table table-hover table-bordered">
        <tr>
            <th class="live-search">UNIVERSAL ID</th>
            <th class="live-search">FULL NAME</th>
            <th class="live-search">CAREWELL ID</th>
            <th class="live-search">COMPANY</th>
            <th class="live-search">DATE ADDED</th>
            <th class="live-search">ACTION</th>
        </tr>
        @foreach($_return_data as $return_data)
        <tr>
            <td>{{$return_data->member_universal_id}}</td>
            <td>{{$return_data->member_first_name}} {{$return_data->member_last_name}}</td>
            <td>{{$return_data->member_carewell_id}}</td>
            <td>{{$return_data->company_name}}</td>
            <td>{{date("F j, Y",strtotime($return_data->member_created))}}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                        @if($archived==0)
                        <li><button type="button" data-member_id="{{$return_data->member_id}}" class="btn btn-link view-member-details"><i class="fa fa-eye btn-icon"></i>  View Member</button></li>
                        <li><button type="button" data-id="{{$return_data->member_id}}" class="btn btn-link page-action" data-status="1" data-alert = "archive" data-name="MEMBER"><i class="fa fa-trash btn-icon"></i> Archive Member</button></li>
                        <li><button type="button" data-id="{{$return_data->member_id}}" class="btn btn-link page-action" data-status="1" data-alert = "terminate" data-name="MEMBER"><i class="fa fa-trash btn-icon"></i> Terminate Member</button></li>
                        @elseif($archived==2)
                        <li><button type="button" data-member_id="{{$return_data->member_id}}" class="btn btn-link view-member-details"><i class="fa fa-eye btn-icon"></i>  View Member</button></li>
                        <li><button type="button" data-id="{{$return_data->member_id}}" class="btn btn-link page-action" data-status="0" data-alert = "restore" data-name="MEMBER"><i class="fa fa-trash btn-icon"></i> Restore Member</button></li>
                        @elseif($archived==1)
                        <li><button type="button" data-member_id="{{$return_data->member_id}}" class="btn btn-link view-member-details"><i class="fa fa-eye btn-icon"></i>  View Member</button></li>
                        <li><button type="button"  class="btn btn-link member-adjustment" data-member_id="{{$return_data->member_id}}"><i class="fa fa-plus btn-icon"></i>  Make Adjustment</button></li>
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