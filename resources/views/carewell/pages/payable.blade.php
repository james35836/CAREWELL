@extends('carewell.layout.layout')
@section('content')
@include('carewell.modals.payable_center_modals')
<div class="container">
  <div class="row">
    <div class=" col-md-2 col-xs-6 pull-right">
      <button type="button" class="btn btn-primary create-payable button-lg"><i class="fa fa-plus btn-icon"></i>CREATE PAYABLE</button>
    </div>
  </div>
  <div class="row">
    <div class="">
      <!-- Custom Tabs -->
      <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#open" data-toggle="tab">OPEN</a></li>
          <li><a href="#close" data-toggle="tab">CLOSE</a></li>
        </ul>
        <div class="tab-content">
          <div class="tab-pane active" id="open">
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