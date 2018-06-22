<div class="box-body table-responsive no-padding">
    <table class="table table-hover table-bordered">
        <tr class="titlerow">
            <th>UNIVERSAL ID</th>
            <th>CAREWELL ID</th>
            <th>EMPLOYEE NUMBER</th>
            <th>MEMBER NAME</th>
            <th>COMPANY NAME</th>
            <th>ALL REPORTS</th>
        </tr>
        @foreach($_member as $member)
        <tr>
            <td>{{$member->member_universal_id}}</td>
            <td>{{$member->member_carewell_id}}</td>
            <td>{{$member->member_employee_number}}</td>
            <td>{{$member->member_first_name}} {{$member->member_last_name}}</td>
            <td>{{$member->company_name}}</td>
            <td><span class="label label-success member-report" data-title="PAYMENT REPORTS"  data-member_id="{{$member->member_id}}">VIEW ALL REPORTS</span></td>
        </tr>
        @endforeach
    </table>
</div>
<div class="box-footer clearfix">
    @include('globals.pagination_v2', ['paginator' => $_member])
</div>