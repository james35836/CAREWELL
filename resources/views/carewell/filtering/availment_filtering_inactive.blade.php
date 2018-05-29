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
        @foreach($_approval_inactive as $approval_inactive)
        <tr>
            <td>{{$approval_inactive->approval_number}}</td>
            <td>{{$approval_inactive->member_universal_id}}</td>
            <td>{{$approval_inactive->member_carewell_id}}</td>
            <td>{{$approval_inactive->member_first_name." ".$approval_inactive->member_last_name }}</td>
            <td>{{$approval_inactive->company_name}}</td>
            <td>{{$approval_inactive->provider_name}}</td>
            <td>{{date("F j, Y",strtotime($approval_inactive->approval_created))}}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                        <li><button type="button" data-approval_id="{{$approval_inactive->approval_id}}" class="btn btn-link view-approval-details"><i class="fa fa-eye btn-icon"></i>  View Approval</button></li>
                        {{-- <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Archived Approval</button></li> --}}
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div class="box-footer clearfix">
    @include('globals.pagination_v2', ['paginator' => $_approval_inactive])
</div>