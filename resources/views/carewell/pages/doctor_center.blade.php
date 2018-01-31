@extends('carewell.layout.layout')
@section('content')
@include('carewell.modals.doctor_center_modals')
<div class="container">
  <div class="row">
    <div class=" col-md-2 col-xs-6 pull-left">
      <select class="form-control">
        <option>SELECT PROVIDER</option>
      </select>
    </div>
    <div class=" col-md-2 col-xs-6 pull-right">
      <div class="dropdown">
        <button class="btn btn-primary button-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-plus btn-icon "></i>CREATE DOCTOR
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <button type="button" class="btn btn-link  create-doctor"><i class="fa   fa-pencil-square btn-icon" ></i>CREATE MANUALLY</button>
          <button type="button" class="btn btn-link   import-doctor"><i class="fa fa-file-excel-o btn-icon" ></i>IMPORT EXCEL</button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">DOCTOR's LIST</h3>
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
              <th>DOCTOR ID</th>
              <th>PROVIDER</th>
              <th>NAME</th>
              <th>SPECIALIZATION</th>
              <th>DATE ADDED</th>
              <th>STATUS</th>
              <th>ACTION</th>
            </tr>
            @foreach($_doctor as $doctor)
            <tr>
              <td>{{sprintf("%05d",$doctor->doctor_id)}}</td>
              <td>{{$doctor->provider_name}}</td>
              <td>{{$doctor->doctor_first_name}} {{$doctor->doctor_last_name}}</td>
              <td>
                @foreach($doctor->specialization as $specialization)
                  <span class="label label-default">{{$specialization->specialization_name}}</span>
                @endforeach
              </td>
              <td>{{date("F j, Y",strtotime($doctor->doctor_created))}}</td>
              <td>
                <span class="label label-success">active</span>
              </td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                    <li><button type="button" data-id="{{$doctor->doctor_id}}" class="btn btn-link view-member-details"><i class="fa fa-eye btn-icon"></i>  View Member</button></li>
                    <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Archived Member</button></li>
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
          @include('globals.pagination', ['paginator' => $_doctor])
        </div>
      </div>
    </div>
  </div>
</div>
@endsection