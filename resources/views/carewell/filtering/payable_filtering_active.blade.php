<div class="table-responsive no-padding">
    <table class="table table-hover table-bordered" >
        <tr>
            <th class="live-search">ID</th>
            <th class="live-search">PROVIDER</th>
            <th class="live-search">SOA NUMBER</th>
            <th class="live-search">DATE RECEIVED</th>
            <th class="live-search">DUE DATE</th>
            <th class="live-search">AGE</th>
            <th class="live-search">APPROVAL NUMBER</th>
            <th class="live-search">APPROVED BY</th>
            <th class="live-search">PREPARATION DATE</th>
            <th class="live-search">ACTION</th>
        </tr>
        @foreach($_payable_open as $payable)
        <tr>
            <td>{{$payable->payable_number}}</td>
            <td>{{$payable->provider_name}}</td>
            <td>{{$payable->payable_soa_number}}</td>
            <td>{{date("F j, Y",strtotime($payable->payable_recieved))}}</td>
            <td>{{date("F j, Y",strtotime($payable->payable_due))}}</td>
            <td><span class="label label-warning">{{$payable->payable_age}}</span></td>
            <td>
                @foreach($payable->approval_number as $approval_number)
                <span class="label label-default">{{$approval_number->approval_number}} Prepared by: {{$approval_number->user_first_name." ".$approval_number->user_last_name}}</span>
                @endforeach
            </td>
            <td>{{$payable->user_first_name." ".$payable->user_last_name}}</td>
            <td>{{date("F j, Y",strtotime($payable->payable_created))}}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                        <li><button type="button" data-payable_id="{{$payable->payable_id}}" class="btn btn-link view-payable-details"><i class="fa fa-eye btn-icon"></i>  View Payable</button></li>
                        <li><button type="button" data-payable_id="{{$payable->payable_id}}" class="btn btn-link payable-mark-close"><i class="fa fa-trash btn-icon"></i> Mark as Close</button></li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </table>
</div>
<div class="box-footer clearfix">
    @include('globals.pagination', ['paginator' => $_payable_open])
</div>