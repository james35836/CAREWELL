@extends('carewell.layout.layout')
@section('content')
<!-- <script type="text/javascript">
  $( document ).ready(function() {
  datepickerdate();
});

  function datepickerdate()
{
  var d = new Date(); 
  var month = d.getMonth()+1;

  var output = (month<10 ? '0' : '') + month + '/' + d.getFullYear();
  var date = document.getElementById('datepicker');
  var wd = new Date(d.getFullYear(),d.getMonth());
  date.value = output;

  // var date_string = wd.toDateString();
  // var date_month = date_string.substring(4,7);
  // var date_year = date_string.substring(11,15);
  // var td_month = document.getElementById('th-date');
  //  td_month.value = date_month+" "+date_year;
  // console.log(td_month);
}


</script> -->

<div class="container">
  <div class="row">
    <div class="">
      <!-- Custom Tabs -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#open" data-toggle="tab">MONTHLY MONITORING</a></li>
          <li><a href="#close" data-toggle="tab">MONTHLY SUMMARY</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="open">
            <div class="row">
              <div class="col-md-3 col-xs-12 pull-left">
                <select class="form-control top-element" data-archived="0" data-name="member">
                  <option>SELECT COMPANY</option>
                  @foreach($_company as $company)
                  <option value="{{$company->company_id}}">{{$company->company_name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3 col-xs-12">
                <input class="datepicker" id="datepicker-filtering" data-date-format="yyyy-mm" data-ref="breakdown">
                <a href="/reports_breakdown/filter_date"><button>date</button></a>
              </div>
              
              <div class="col-md-3 col-xs-12 pull-right">
                <select class="form-control">
                  <option value="2018">2018</option>
                </select>
              </div>
            </div>
        <div id="showTable" class="load-data load-reports-breakdown" data-target="load-reports-breakdown">
            <div class="table-responsive no-padding">
              <table class="table table-hover table-bordered sum_table" id="showReport">
                <tr class="titlerow">
                  <th>COMPANY</th>
                  <th>NUMBER OF MEMBER</th>
                  <th>AVAILMENT AS OF</th>
                  <th>YEAR TO DATE AVAIL</th>
                  <th>APE</th>
                  <th>CONFINEMENT-MED</th>
                  <th>CONFINEMENT-SURG</th>
                  <th>CONS/OP</th>
                  <th>DENTAL</th>
                  <th>LAB</th>
                  <th>MO</th>
                  <th>FA</th>
                  <th>DB</th>
                  <th>HIB</th>
                  <th>TOTAL</th>
                </tr>
                @foreach($_company as $company)
                <tr>
                  <td>{{$company->company_name}}</td>
                  <td>{{$company->count_mem}}</td>
                  <td>DEC-NOV</td>
                  <td>DEC-NOV</td>
                  <td>{{$company->count_ape}}</td>
                  <td>DEC-NOV</td>
                  <td>DEC-NOV</td>
                  <td>DIGIMA</td>
                  <td>DIGIMA</td>
                  <td><span class="label label-success">active</span></td>
                  <td><span class="label label-success pop-up-lg action-span" data-modalname="APPROVAL DETAILS" data-link="/medical/approval/details">view details</span></td>
                  <td>DEC-NOV</td>
                  <td>DEC-NOV</td>
                  <td>DIGIMA</td>
                  <td>DIGIMA</td>
                </tr>
                @endforeach
                
              </table>
            </div>
          </div>  
            {{-- <div class="box-footer clearfix">
              @include('globals.pagination', ['paginator' => $_company])
            </div> --}}
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="close">
            <div class="row">
              <div class="col-md-3 col-xs-12 pull-left">
                <select class="form-control top-element filtering" data-archived="0" data-name="member">
                  <option>SELECT AVAILMENT</option>
                  @foreach($_company as $company)
                  <option value="{{$company->company_id}}">{{$company->company_name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-3 col-xs-12 pull-right">
                <div class="input-group margin">
                  <input type="text" class="form-control">
                  <span class="input-group-btn">
                    <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </span>
                </div>
              </div>
            </div>
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-bordered sum_table">
                <tr class="titlerow">
                  <th>COMPANY</th>
                  <th>AVAILMENT TYPE</th>
                  <th>JAN</th>
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
                  <th>TOTAL</th>
                </tr>
                <tr>
                  <td>fgfh</td>
                  <td>fhdfd</td>
                  <td>5</td>
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
            {{-- <div class="box-footer clearfix">
              @include('globals.pagination', ['paginator' => $_company])
            </div> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection