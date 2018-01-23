@extends('carewell.layout.layout')
@section('content')
@include('carewell.modals.company_center_modals')
<div class="container">
  <div class="row ">
    <div class=" col-md-2 pull-right">
      <button type="button" class="btn btn-primary  button-lg create-company"><i class="fa fa-plus btn-icon "></i>CREATE COMPANY</button>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-header">
          <h3 class="box-title">Company List</h3>
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
              <th>Company Code</th>
              <th>Company Name</th>
              <th>Coverage PLan</th>
              <th>Contract Number</th>
              <th>Date Created</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
            @foreach($_company as $company)
            <tr>
              <td>{{$company->company_code}}</td>
              <td>{{$company->company_name}}</td>
              <td>
                @foreach($company->coverage_plan as $coverage_plan)
                <span class="label label-default">{{$coverage_plan->availment_plan_name}}</span>
                @endforeach
              </td>
              <td>{{$company->contract_number}}</td>
              <td>{{date("F j, Y",strtotime($company->company_date_created))}}</td>
              <td>
                @if($company->company_status=='active')
                <span class="label label-success">Active</span>
                @else
                <span class="label label-danger">Not Active</span>
                @endif
              </td>
              <td>
                <div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                    <li><button type="button" data-id="{{$company->company_id}}" class="btn btn-link view-company-details"><i class="fa fa-eye btn-icon"></i>  View Company</button></li>
                    <li><button type="button" class="btn btn-link"><i class="fa fa-trash btn-icon"></i> Archived Company</button></li>
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
          @include('globals.pagination', ['paginator' => $_company])
        </div>
      </div>
    </div>
  </div>
  
</div>
@endsection