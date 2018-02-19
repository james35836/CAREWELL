@extends('carewell.layout.layout')
@section('content')
@include('carewell.modals.medical_center_modals')
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
          <li><a href="#close" data-toggle="tab">MONTHLY SUMMARY</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="open">
            <div class="row">
              <div class="col-xs-12">
                <div class="box-header">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <select class="form-control">
                      <option value="">SELECT COMPANY</option>
                      @foreach($_company as $company)
                      <option>{{$company->company_name}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" ></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                
                <!-- /.box-header -->
                
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
                    @foreach($_company as $company)
                    @foreach($company->company_availment as $company_availment)
                    <tr>
                      <td>{{$company->company_name}}</td>
                      <td>{{$company_availment->availment_name}}</td>
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
                    @endforeach
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
                
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul>
                </div>
                
                <!-- /.box -->
              </div>
            </div>
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="close">
            <div class="row">
              <div class="col-xs-12">
                <div class="box-header">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <select class="form-control">
                      <option value="">SELECT PROVIDER</option>
                    </select>
                  </div>
                  <div class="box-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                      <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
                      <div class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="fa fa-search" ></i></button>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover table-bordered">
                    <tr>
                      <th>PAYABLE ID</th>
                      <th>APPROVAL #</th>
                      <th>UNIVERSAL ID</th>
                      <th>MEMBER NAME</th>
                      <th>COMPANY</th>
                      <th>DX</th>
                      <th>PROCEDURE/LAB</th>
                      <th>AMOUNT</th>
                      <th>PHYSICIAN</th>
                      <th>PF</th>
                      <th>D/A</th>
                      <th>CHARGE TO CAREWELL</th>
                      <th>REMARKS</th>
                      <th>PROVIDER</th>
                      <th>DATE</th>
                      <th>ACTION</th>
                    </tr>
                    <tr>
                      <td>CAL 01</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td>DIGIMA</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td>CAL 01</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td>DIGIMA</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td><span class="label label-success">active</span></td>
                      <td><span class="label label-success pop-up-lg action-span" data-modalname="APPROVAL DETAILS" data-link="/medical/approval/details">view details</span></td>
                    </tr>
                    <tr>
                      <td>CAL 01</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td>DIGIMA</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td>CAL 01</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td>DIGIMA</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td><span class="label label-success">active</span></td>
                      <td><span class="label label-success pop-up-lg action-span" data-modalname="APPROVAL DETAILS" data-link="/medical/approval/details">view details</span></td>
                    </tr>
                    <tr>
                      <td>CAL 01</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td>DIGIMA</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td>CAL 01</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td>DIGIMA</td>
                      <td>DEC-NOV</td>
                      <td>DEC-NOV</td>
                      <td><span class="label label-success">active</span></td>
                      <td><span class="label label-success pop-up-lg action-span" data-modalname="APPROVAL DETAILS" data-link="/medical/approval/details">view details</span></td>
                    </tr>
                  </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                  <ul class="pagination pagination-sm no-margin pull-right">
                    <li><a href="#">&laquo;</a></li>
                    <li><a href="#">1</a></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">&raquo;</a></li>
                  </ul>
                </div>
                
                <!-- /.box -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection