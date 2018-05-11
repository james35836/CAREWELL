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
          <div class="tab-pane active" id="open">
            <div class="row top-element">
              <div class="col-md-3 col-xs-12 pull-right">
                <div class="input-group ">
                  <input type="text" class="form-control">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </span>
                </div>
              </div>
            </div>
            <div class="table-responsive no-padding">
              <table class="table table-hover table-bordered sum_table">
                <tr class="titlerow">
                  <th>UNIVERSAL ID</th>
                  <th>CAREWELL ID</th>
                  <th>EMPLOYEE NUMBER</th>
                  <th>MEMBER NAME</th>
                  <th>MONTHLY REPORTS</th>
                  <th>FEB</th>
                  <th>MAR</th>
                  <th>APR</th>
                  <th>MAY</th>
                  <th>JUNE</th>
                  <th>JULY</th>
                  <th>AUG</th>
                  <th>SEP</th>
                  <th>OCT</th>
                  <th>NOV</th>
                  <th>DEC</th>
                </tr>
                @foreach($_member as $member)
                <tr>
                  <td>{{$member->member_universal_id}}</td>
                  <td>{{$member->member_carewell_id}}</td>
                  <td>{{$member->member_employee_number}}</td>
                  <td>{{$member->member_first_name}} {{$member->member_last_name}}</td>
                  <td><span class="label label-success member-monthly-report" data-member_id="{{$member->member_id}}">view report</span></td>
                  <td>DIGIMA</td>
                  <td>DEC-NOV</td>
                  <td>DEC-NOV</td>
                  <td>DEC-NOV</td>
                  <td>DEC-NOV</td>
                  <td>CAL 01</td>
                  <td>DEC-NOV</td>
                  <td>DEC-NOV</td>
                  <td>DIGIMA</td>
                  <td>DIGIMA</td>
                  <td><span class="label label-success">active</span></td>
                  <td><span class="label label-success pop-up-lg action-span" data-modalname="APPROVAL DETAILS" data-link="/medical/approval/details">view details</span></td>
                </tr>
                @endforeach
                <tr>
                  <td></td>
                  <td>TOTAL</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td>0.0</td>
                  <td></td>
                </tr>
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