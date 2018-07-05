<div class="box-body table-responsive no-padding">
    <table class="table table-hover table-bordered">
        <tr>
            <th>COMPANY CODE</th>
            <th>COMPANY NAME</th>
            <th>COVERAGE PLAN</th>
            <th>CONTRACT NUMBER</th>
            <th>DATE ADDED</th>
            <th>ACTION</th>
        </tr>
        @foreach($_return_data as $return_data)
        <tr>
            <td>{{$return_data->company_code}}</td>
            <td>{{$return_data->company_name}}</td>
            <td>
                @foreach($return_data->coverage_plan as $coverage_plan)
                <span class="label label-default">{{$coverage_plan->coverage_plan_name}}</span>
                @endforeach
            </td>
            <td>{{$return_data->contract_number}}</td>
            <td>{{date("F j, Y",strtotime($return_data->company_created))}}</td>
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-danger">Action</button>
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                        @if($archived==0)
                        <li><button type="button" data-company_id="{{$return_data->company_id}}" class="btn btn-link view-company-details"><i class="fa fa-eye btn-icon"></i>  View Company</button></li>
                        <li><button type="button" data-id="{{$return_data->company_id}}" class="btn btn-link page-action" data-status="1" data-alert = "archive" data-name="COMPANY" @if($return_data->member!=0) disabled @endif><i class="fa fa-trash btn-icon"></i> Archive Company</button></li>
                        @elseif($archived==1)
                        <li><button type="button" data-company_id="{{$company->company_id}}" class="btn btn-link view-company-details"><i class="fa fa-eye btn-icon"></i>  View Company</button></li>
                        <li><button type="button" data-id="{{$return_data->company_id}}" class="btn btn-link page-action" data-status="0" data-alert = "restore" data-name="COMPANY"><i class="fa fa-trash btn-icon"></i> Restore Company</button></li>
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