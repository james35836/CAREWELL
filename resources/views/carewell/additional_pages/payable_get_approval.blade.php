<div class="form-holder">
    <div class="form-holder">
        <div class=" col-md-4 col-xs-12 pull-left">
            <h4 class="box-title medical-btn-sample">APPROVAL LIST</h4>
        </div>
        <div class="col-md-3 col-xs-12 pull-right">
            <input type="text" data-ref="approval" data-name="member-approval" class="form-control search-key">
        </div>
    </div>
    <!-- <div class=" col-md-4 col-xs-12 pull-left">
        <div class="input-group top-element">
            <input type="text" class="form-control datepicker" id="payable_from"/>
            <span class="input-group-addon">TO</span>
            <input type="text" class="form-control datepicker" id="payable_to"/>
        </div>
    </div> -->
</div>
<div class="form-holder">
    <div class="load-data load-member-approval" data-target="load-member-approval">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered">
                <tr>
                    <th><input type="checkbox"  class="checkAllCheckbox"></th>
                    <th class="live-search">APPROVAL #</th>
                    <th class="live-search">UNIVERSAL ID</th>
                    <th class="live-search">CAREWELL ID</th>
                    <th class="live-search">MEMBER NAME</th>
                    <th class="live-search">COMPANY</th>
                    <th class="live-search">PROVIDER</th>
                    <th class="live-search">DATE ISSUED</th>
                </tr>
                @foreach($_approval_active as $approval_active)
                <tr>
                    <td><input type="checkbox" name="approval_id[]" value="{{$approval_active->approval_id}}"></td>
                    <td><span class="label label-success view-approval-details" data-size="md" data-approval_id="{{$approval_active->approval_id}}">{{$approval_active->approval_number}}</span></td>
                    <td>{{$approval_active->member_universal_id}}</td>
                    <td>{{$approval_active->member_carewell_id}}</td>
                    <td>{{$approval_active->member_first_name." ".$approval_active->member_last_name }}</td>
                    <td>{{$approval_active->company_name}}</td>
                    <td>{{$approval_active->provider_name}}</td>
                    <td>{{date("F j, Y",strtotime($approval_active->approval_created))}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>