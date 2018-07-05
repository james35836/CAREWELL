<div class="box-body table-responsive no-padding">
    <table class="table table-hover table-bordered">
        <tr>
            <th>CAL #</th>
            <th>COMPANY</th>
            <th>REVENEU YEAR</th>
            <th>MODE OF PAYMENT</th>
            <th># OF MEMBER</th>
            <th>DATE CREATED</th>
            <th>ACTION</th>
        </tr>
        @foreach($_return_data as $return_data)
        <tr>
            <td>{{$return_data->cal_number}}</td>
            <td>{{$return_data->company_name}}</td>
            <td>{{$return_data->cal_reveneu_period_year}}</td>
            <td>{{$return_data->cal_payment_mode}}</td>
            <td>{{$return_data->members +  $return_data->new_member}}</td>
            <td>{{date("F j, Y",strtotime($return_data->cal_created))}}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                        <li><button type="button" data-cal_id="{{$return_data->cal_id}}" data-company_id="{{$return_data->company_id}}" class="btn btn-link cal-view-details"><i class="fa fa-eye btn-icon"></i>  View Details</button></li>
                        <?php $total = $return_data->members + $return_data->new_member; ?>
                        @if($total!=0)
                            @if($archived==0)
                            <li><button type="button" data-cal_id="{{$return_data->cal_id}}" class="btn btn-link close-cal"><i class="fa fa-trash btn-icon"></i> Mark as Close</button></li>
                            <li><button type="button" data-cal_id="{{$return_data->cal_id}}" class="btn btn-link cal-pending-confirm"><i class="fa fa-trash btn-icon"></i> Mark as Pending</button></li>
                            @elseif($archived==2)
                            <li><button type="button" data-cal_id="{{$return_data->cal_id}}" class="btn btn-link close-cal"><i class="fa fa-trash btn-icon"></i> Mark as Close</button></li>
                            @endif
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