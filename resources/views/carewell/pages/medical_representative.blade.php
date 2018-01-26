@extends('carewell.layout.layout')
@section('content')
@include('carewell.modals.medical_center_modals')
<style type="text/css">
  .approval-modal 
  { 
    overflow-y:scroll ;
  }
</style>
<script>
  
</script>
  <div class="container">
    <div class="row">
      <div class=" col-md-2 col-xs-6 pull-left">
        <select class="form-control">
          <option>SELECT COMPANY</option>
        </select>
      </div>
      <div class=" col-md-2 col-xs-6 pull-right">
        <button type="button" class="btn btn-primary create-approval button-lg"><i class="fa fa-plus btn-icon"></i>CREATE APPROVAL</button> 
      </div>
      
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Period List</h3>
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
                <th>APPROVAL ID</th>
                <th>UNIVERSAL ID</th>
                <th>CAREWELL ID</th>
                <th>PATIENT NAME</th>
                <th>COMPANY</th>
                <th>PROVIDER</th>
                <th>STATUS</th>
                <th>ACTION</th>
              </tr>
              @foreach($_approval as $approval)
              <tr>
                <td>{{$approval->approval_id}}</td>
                <td>DEC-NOV</td>
                <td>DEC-NOV</td>
                <td>DIGIMA</td>
                <td>DEC-NOV</td>
                <td>DEC-NOV</td>
                <td><span class="label label-success">active</span></td>
                <td><span class="label label-success pop-up-lg action-span" data-modalname="APPROVAL DETAILS" data-link="/medical/approval/details">view details</span></td>
              </tr>
              @endforeach
              
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
        </div>
        <!-- /.box -->
      </div>
    </div>
  </div>


@endsection