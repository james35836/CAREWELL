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
        <select class="form-control ">
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
            <h3 class="box-title medical-btn-sample">APPROVAL LIST</h3>
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
                <th>APPROVAL #</th>
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
                <td>{{$approval->approval_number}}</td>
                <td>{{$approval->member_universal_id}}</td>
                <td>{{$approval->member_company_carewell_id}}</td>
                <td>{{$approval->member_first_name." ".$approval->member_last_name }}</td>
                <td>{{$approval->company_name}}</td>
                <td>{{$approval->provider_name}}</td>
                <td><span class="label label-success">active</span></td>
                <td>
                  <div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                    <li><button type="button" data-approval_id="{{$approval->approval_id}}" class="btn btn-link view-approval-details"><i class="fa fa-eye btn-icon"></i>  View Approval</button></li>
                    <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Archived Approval</button></li>
                  </ul>
                </div>
                </td>
              </tr>
              @endforeach
              <tr style="height:70px;">
              </tr>
            </table>
          </div>
          <div class="box-footer clearfix">
            @include('globals.pagination', ['paginator' => $_approval])
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection