@extends('carewell.layout.layout')
@section('content')
@include('carewell.modals.member_center_modals')
<div class="container">
  <div class="row">
    <div class=" col-md-2 col-xs-6 pull-left">
      <select class="form-control top-element">
        <option>SELECT COMPANY</option>
        @foreach($_company as $company)
        <option value="{{$company->company_id}}">{{$company->company_name}}</option>
        @endforeach
      </select>
    </div>
    <div class=" col-md-2 col-xs-6 pull-right">
      <div class="dropdown">
        <button class="btn btn-primary top-element dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-plus btn-icon "></i>CREATE MEMBER
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <button type="button" class="btn btn-link  create-member"><i class="fa   fa-pencil-square btn-icon" ></i>CREATE MANUALLY</button>
          <button type="button" class="btn btn-link   import-member"><i class="fa fa-file-excel-o btn-icon" ></i>IMPORT EXCEL</button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Member List</h3>
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
              <th>UNIVERSAL ID</th>
              <th>FULL NAME</th>
              <th>CAREWELL ID</th>
              <th>COMPANY</th>
              <th>STATUS</th>
              <th>DATE ADDED</th>
              <th>ACTION</th>
            </tr>
            @foreach($_member as $member)
            <tr>
              <td>{{$member->member_universal_id}}</td>
              <td>{{$member->member_first_name}} {{$member->member_last_name}}</td>
              <td>{{$member->member_company_carewell_id}}</td>
              <td>{{$member->company_name}}</td>
              <td>
                @if($member->member_company_status=='active')
                <span class="label label-success">active</span>
                @else
                <span class="label label-danger">inactive</span>
                @endif
              </td>
              <td>{{date("F j, Y",strtotime($member->member_date_created))}}</td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                    <li><button type="button" data-id="{{$member->member_id}}" class="btn btn-link view-member-details"><i class="fa fa-eye btn-icon"></i>  View Member</button></li>
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
          @include('globals.pagination', ['paginator' => $_member])
        </div>
      </div>
    </div>
  </div>
</div>
@endsection