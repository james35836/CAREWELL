<div class="box-body table-responsive no-padding">
    <table class="table table-hover table-bordered">
        <tr>
            <th class="live-search">APPROVAL #</th>
            <th class="live-search">UNIVERSAL ID</th>
            <th class="live-search">CAREWELL ID</th>
            <th class="live-search">MEMBER NAME</th>
            <th class="live-search">COMPANY</th>
            <th class="live-search">PROVIDER</th>
            <th class="live-search">DATE ISSUED</th>
            <th class="live-search">ACTION</th>
        </tr>
        @foreach($_return_data as $return_data)
        <tr>
            <td>{{$return_data->approval_number}}</td>
            <td>{{$return_data->member_universal_id}}</td>
            <td>{{$return_data->member_carewell_id}}</td>
            <td>{{$return_data->member_first_name." ".$return_data->member_last_name }}</td>
            <td>{{$return_data->company_name}}</td>
            <td>{{$return_data->provider_name}}</td>
            <td>{{date("F j, Y",strtotime($return_data->approval_created))}}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                        @if($archived==0)
                        <li><button type="button" data-approval_id="{{$return_data->approval_id}}" class="btn btn-link view-approval-details"><i class="fa fa-eye btn-icon"></i>  View Approval</button></li>
                        <li><button type="button" data-id="{{$return_data->approval_id}}" class="btn btn-link page-action" data-status="3" data-alert = "cancel" data-name="APPROVAL"><i class="fa fa-trash btn-icon"></i> Cancel Approval</button></li>
                        <li><button type="button" data-id="{{$return_data->approval_id}}" class="btn btn-link page-action" data-status="4" data-alert = "disapprove" data-name="APPROVAL"><i class="fa fa-trash btn-icon"></i> Disapprove Approval</button></li>
                        @elseif($archived==1)
                        <li><button type="button" data-approval_id="{{$return_data->approval_id}}" class="btn btn-link view-approval-details"><i class="fa fa-eye btn-icon"></i>  View Approval</button></li>
                        @elseif($archived==2)
                        <li><button type="button" data-approval_id="{{$return_data->approval_id}}" class="btn btn-link view-approval-details"><i class="fa fa-eye btn-icon"></i>  View Approval</button></li>
                        @elseif($archived==3)
                        <li><button type="button" data-approval_id="{{$return_data->approval_id}}" class="btn btn-link view-approval-details"><i class="fa fa-eye btn-icon"></i>  View Approval</button></li>
                        <li><button type="button" data-id="{{$return_data->approval_id}}" class="btn btn-link page-action" data-status="0" data-alert = "restore" data-name="APPROVAL"><i class="fa fa-trash btn-icon"></i> Restore Approval</button></li>
                        @elseif($archived==4)
                        <li><button type="button" data-approval_id="{{$return_data->approval_id}}" class="btn btn-link view-approval-details"><i class="fa fa-eye btn-icon"></i>  View Approval</button></li>
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