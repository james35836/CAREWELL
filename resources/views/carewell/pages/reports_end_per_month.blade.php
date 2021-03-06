@extends('carewell.layout.layout')
@section('content')
<script type="text/javascript">
$(document).ready(function(){
settings_reports.calculateSum('sum-jan');
settings_reports.calculateSum('sum-feb');
settings_reports.calculateSum('sum-mar');
settings_reports.calculateSum('sum-apr');
settings_reports.calculateSum('sum-may');
settings_reports.calculateSum('sum-jun');
settings_reports.calculateSum('sum-jul');
settings_reports.calculateSum('sum-aug');
settings_reports.calculateSum('sum-sep');
settings_reports.calculateSum('sum-oct');
settings_reports.calculateSum('sum-nov');
settings_reports.calculateSum('sum-dec');
$('body').on('click','.year-picker',function(e)
{
$(this).datepicker({
format: " yyyy",
startView: "years",
viewMode: "years",
minViewMode: "years",
autoclose: true
});
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
          <div class="tab-pane active showReportContent" id="open">
            <div class="row top-element">
  <!--             <div class="col-md-3 col-xs-12 pull-left">
                <select class="form-control">
                  <option value="">SELECT COMPANY</option>
                  @foreach($_company as $company)
                  <option>{{$company->company_name}}</option>
                  @endforeach
                </select>
              </div> -->
              <div class="col-md-3 col-xs-12">
                <div class="btn-group">
                  <a href="{{$link}}"><button type="button" class="btn btn-success">EXPORT EXCEL</button></a>
                </div>
              </div>
              <div class="col-md-6 col-xs-12 pull-right">
                <div class="col-md-4">
                  <label style="display:inline-block;">Filter Report:</label>
                </div>
                <div class="col-md-8">
                  <input class="form-control year-picker" id="datepicker-filtering" value="{{$date}}" data-ref="end_per_month" >
                </div>
                
              </div>
            </div>
            <div class="table-responsive no-padding">
              <table class="table table-hover table-bordered sum_table">
                <tr class="titlerow">
                  <th>COMPANY</th>
                  <th>PREM</th>
                  <th>DATE ACQUIRED</th>
                  <th>JAN</th>
                  <th>FEB</th>
                  <th>MAR</th>
                  <th>APR</th>
                  <th>MAY</th>
                  <th>JUNE</th>
                  <th>JULY</th>
                  <th>AUG</th>
                  <th>SEPT</th>
                  <th>OCT</th>
                  <th>NOV</th>
                  <th>DEC</th>
                </tr>
                @foreach($_company as $company)
                <tr>
                  <td>{{$company->company_name}}</td>
                  <td>{{$company->coverage_plan_premium}}</td>
                  <td>{{substr($company->company_created,0,10)}}</td>
                  <td class="sum-jan">{{$company->count_jan}}</td>
                  <td class="sum-feb">{{$company->count_feb}}</td>
                  <td class="sum-mar">{{$company->count_mar}}</td>
                  <td class="sum-apr">{{$company->count_apr}}</td>
                  <td class="sum-may">{{$company->count_may}}</td>
                  <td class="sum-jun">{{$company->count_jun}}</td>
                  <td class="sum-jul">{{$company->count_jul}}</td>
                  <td class="sum-aug">{{$company->count_aug}}</td>
                  <td class="sum-sep">{{$company->count_sep}}</td>
                  <td class="sum-oct">{{$company->count_oct}}</td>
                  <td class="sum-nov">{{$company->count_nov}}</td>
                  <td class="sum-dec">{{$company->count_dec}}</td>
                </tr>
                @endforeach
                <tr>
                  <td>TOTAL</td>
                  <td></td>
                  <td></td>
                  <td id="sum-jan">{{$company->count_jan_total}}</td>
                  <td id="sum-feb">{{$company->count_feb_total}}</td>
                  <td id="sum-mar">{{$company->count_mar_total}}</td>
                  <td id="sum-apr">{{$company->count_apr_total}}</td>
                  <td id="sum-may">{{$company->count_may_total}}</td>
                  <td id="sum-jun">{{$company->count_jun_total}}</td>
                  <td id="sum-jul">{{$company->count_jul_total}}</td>
                  <td id="sum-aug">{{$company->count_aug_total}}</td>
                  <td id="sum-sep">{{$company->count_sep_total}}</td>
                  <td id="sum-oct">{{$company->count_oct_total}}</td>
                  <td id="sum-nov">{{$company->count_nov_total}}</td>
                  <td id="sum-dec">{{$company->count_dec_total}}</td>
                </tr>
              </table>
            </div>
            <div class="box-footer clearfix">
              @include('globals.pagination', ['paginator' => $_company])
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection