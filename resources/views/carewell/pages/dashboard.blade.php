@extends('carewell.layout.layout')
@section('content')
<script>
function date_time(id)
{
date = new Date;
year = date.getFullYear();
month = date.getMonth();
months = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
d = date.getDate();
day = date.getDay();
days = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
h = date.getHours();
if(h<10)
{
h = "0"+h;
}
m = date.getMinutes();
if(m<10)
{
m = "0"+m;
}
s = date.getSeconds();
if(s<10)
{
s = "0"+s;
}
result = ''+days[day]+'<br> '+months[month]+' '+d+', '+year+'<br><p class="clock-time"> '+h+':'+m+':'+s+"</p>";
document.getElementById(id).innerHTML = result;
setTimeout('date_time("'+id+'");','1000');
return true;
}
</script>
<style>
.clock-time
{
font-weight: bold;
font-size: 20px;
text-align: center;
}
</style>
<!-- Info boxes -->

<div class="row">
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
      <div class="info-box-content">
        <span class="info-box-text modals-ko">MEMBER</span>
        <span class="info-box-number"  style="padding-top: 20px;">{{$member_active}}</span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-building"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">COMPANY</span>
        <span class="info-box-number" style="padding-top: 20px;">{{$company_active}}</span>
      </div>
    </div>
  </div>
  <div class="clearfix visible-sm-block"></div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="ion ion-ios-medkit"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">NETWORK PROVIDER</span>
        <span class="info-box-number" style="padding-top: 20px;">{{$provider_active}}</span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="ion ion-clock"></i></span>
      <div class="info-box-content" style="text-align: center;">
        <span id="date_time" class="clock-font"></span>
        <script type="text/javascript">window.onload = date_time('date_time');</script>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">TOTAL PROGRESS..</h3>
      </div>
      <div class="box-body">
        <div class="row">
          <div class="col-md-8">
            <p class="text-center">
              <strong>STATISTIC</strong>
            </p>
            <div class="chart">
              <script>
                $(document).ready(function()
                {
                  dashboard.barGraph('#approvalChart',{{$January}},{{$February}},{{$March}},{{$April}},{{$May}},{{$June}},{{$July}},{{$August}},{{$September}},{{$October}},{{$November}},{{$December}});
                });
                
              </script>
              <canvas id="approvalChart" style="height: 300px;"></canvas>
            </div>
          </div>
          <div class="col-md-4">
            <p class="text-center">
              <strong>LATEST APPROVAL</strong>
            </p>
            <div class="box-body" style="max-height: 300px;overflow-x: hidden;overflow-y: scroll;">
              <table class="table table-bordered">
                <thead>
                <tr>
                  <th >APPROVAL #</th>
                  <th>MEMBER NAME</th>
                  <th style="width: 40px">ACTION</th>
                </tr>
                </thead>
                <tbody>
                @foreach($_approval as $approval)
                <tr>
                  <td style="width: 147px !important;">{{$approval->approval_number}}</td>
                  <td>{{$approval->member_first_name." ".$approval->member_last_name}}</td>
                  <td><button class="btn btn-link latest-approval" data-approval_id="{{$approval->approval_id}}">view</button></td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div class="box-footer">
        <div class="row">
          <div class="col-sm-3 col-xs-6">
            <div class="description-block border-right">
              <h5 class="description-header">{{$total_approval}}</h5>
              <span class="description-text">TOTAL APPROVAL</span>
            </div>
          </div>
          <div class="col-sm-3 col-xs-6">
            <div class="description-block border-right">
              <h5 class="description-header">&#8369; {{number_format($sum_approval->total_charge_carewell,2)}}</h5>
              <span class="description-text">TOTAL OUTSTANDING PAYABLE</span>
            </div>
          </div>
          <div class="col-sm-3 col-xs-6">
            <div class="description-block">
              <h5 class="description-header">&#8369; {{number_format($total_paid->total_charge_carewell,2)}}</h5>
              <span class="description-text">TOTAL PAID</span>
            </div>
          </div>
          <div class="col-sm-3 col-xs-6">
            <div class="description-block border-right">
              <h5 class="description-header">{{$member_inactive}}</h5>
              <span class="description-text">INACTIVE MEMBER</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection