@extends('carewell.layout.layout')
@section('content')
@include('carewell.modals.medical_center_modals')
<div class="container">
  
  <div class="row">
    
    <div class=" col-md-2 col-xs-6 pull-right">
      <button type="button" class="btn btn-primary create-approval top-element"><i class="fa fa-plus btn-icon"></i>CREATE APPROVAL</button>
    </div>
  </div>
  <div class="row">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#activeCompany" data-toggle="tab">ACTIVE </a></li>
        <li><a href="#inActiveCompany" data-toggle="tab">INACTIVE </a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="activeCompany">
          <div class="row">
            <div class="col-md-3 col-xs-12 pull-left">
              <select class="form-control top-element">
                <option>SELECT COMPANY</option>
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
                <td>{{$approval->member_carewell_id}}</td>
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
            </table>
          </div>
          <div class="box-footer clearfix">
            @include('globals.pagination', ['paginator' => $_approval])
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="inActiveCompany">
          <div class="row">
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
                <td>{{$approval->member_carewell_id}}</td>
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
            </table>
          </div>
          <div class="box-footer clearfix">
            @include('globals.pagination', ['paginator' => $_approval])
          </div>
        </div>
      </div>
      <!-- /.tab-content -->
    </div>
  </div>
</div>
@endsection