@extends('carewell.layout.layout')
@section('content')
@include('carewell.modals.admin_center_modals')
<div class="container">
  <div class="row">
    <div class=" col-md-2 col-xs-6 pull-left">
      <select class="form-control">
        <option>SELECT COMPANY</option>
      </select>
    </div>
    <div class=" col-md-2 col-xs-6 pull-right">
      <button class="btn btn-primary button-lg create-user" type="button" ><i class="fa fa-plus btn-icon "></i>CREATE USER</button>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">USER LIST</h3>
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
              <th>USER ID</th>
              <th>ID NUMBER</th>
              <th>FULL NAME</th>
              <th>EMAIL</th>
              <th>GENDER</th>
              <th>STATUS</th>
              <th>DATE ADDED</th>
              <th>ACTION</th>
            </tr>
            @foreach($_user_data as $user_data)
            <tr>
              <td>{{$user_data->user_id}}</td>
              <td>{{$user_data->user_id_number}}</td>
              <td>{{$user_data->user_first_name." ".$user_data->user_last_name}}</td>
              <td>{{$user_data->user_email}}</td>
              <td>{{$user_data->user_gender}}</td>
              <td><span class="label label-success">active</span></td>
              <td>{{date("F j, Y",strtotime($user_data->user_created))}}</td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                    <li><button type="button" data-user_id="{{$user_data->user_id}}" class="btn btn-link view-user-details"><i class="fa fa-eye btn-icon"></i>  View</button></li>
                    <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Archived </button></li>
                  </ul>
                </div>
              </td>
            </tr>
            @endforeach
          <tr style="height:80px;">
          </tr>
        </table>
      </div>
      <div class="box-footer clearfix">
        @include('globals.pagination', ['paginator' => $_user_data])
      </div>
    </div>
  </div>
</div>
</div>
@endsection