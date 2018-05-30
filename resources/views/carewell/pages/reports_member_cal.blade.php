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
          <li class="active"><a href="#open" data-toggle="tab">PAYMENT MONITORING</a></li>        
        </ul>
        <div class="tab-content">
            <div class="table-responsive no-padding">
              <div class="col-md-3 col-xs-12 pull-right">
                <div class="input-group ">
                  <input type="text" id= "search_member_cal" class="form-control">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </span>
                </div>
              </div>
               <div id="showTable" class="load-data load-active-company" data-target="load-active-company">
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
                        <td><span class="label label-success member-report" data-ref="monthly" data-title="MONTHLY REPORTS"  data-member_id="{{$member->member_id}}">VIEW ALL REPORTS</span></td>
                      </tr>
                      @endforeach
                    </table>
                </div>
                <div class="box-footer clearfix">
                    @include('globals.pagination_v2', ['paginator' => $_member])
                </div>
             </div>
             
            
            </div>  
        </div>
          <!-- /.tab-pane -->
        </div>
      </div>
    </div>
  </div>
</div>
@endsection