@extends('carewell.layout.layout')
@section('content')
<script >
$(document).ready(function() {
$(".sum_table tr:not(:first,:last)  td:last-child").text(function()
{
var t = 0;
$(this).prevAll().each(function(){
t += parseInt( $(this).text(), 10 ) || 0;
});
return t;
});
$(".sum_table tr:last td").text(function(i)
{
var t = 0;
$(this).parent().prevAll().find("td:nth-child("+(++i)+")").each(function()
{
t += parseInt( $(this).text(), 10 ) || 0;
});
if(t==0)
{
t="";
}
return  t;
});
});
</script>

<div class="container">
  <div class="row">
    <div class="">
      <!-- Custom Tabs -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#open" data-toggle="tab">MONTHLY MONITORING</a></li>        
        </ul>
        <div class="tab-content">
            <div class="table-responsive no-padding">
              <table class="table table-hover table-bordered">
                <tr class="titlerow">
                  <th>UNIVERSAL ID</th>
                  <th>CAREWELL ID</th>
                  <th>EMPLOYEE NUMBER</th>
                  <th>MEMBER NAME</th>
                  <th>MONTHLY REPORTS</th>
                  <th>YEARLY REPORTS</th>
                  <th>ALL REPORTS</th>
                </tr>
                @foreach($_member as $member)
                <tr>
                  <td>{{$member->member_universal_id}}</td>
                  <td>{{$member->member_carewell_id}}</td>
                  <td>{{$member->member_employee_number}}</td>
                  <td>{{$member->member_first_name}} {{$member->member_last_name}}</td>
                  <td><span class="label label-success member-report" data-ref="monthly" data-title="MONTHLY REPORTS"  data-member_id="{{$member->member_id}}">VIEW MONTHLY REPORTS</span></td>
                  <td><span class="label label-primary member-report" data-ref="yearly" data-title="YEARLY REPORTS" data-member_id="{{$member->member_id}}">VIEW YEARLY REPORTS</span></td>
                  <td><span class="label label-warning member-report" data-ref="all_data" data-title="ALL REPORTS"  data-member_id="{{$member->member_id}}">VIEW ALL REPORTS</span></td>
                </tr>
                @endforeach
              </table>
            </div>
            <div class="box-footer clearfix">
              @include('globals.pagination', ['paginator' => $_member])
            </div>
        </div>
          <!-- /.tab-pane -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection