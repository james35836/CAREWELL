@extends('carewell.layout.layout')
@section('content')
<div class="container">
  
  <div class="row">
    
    <div class=" col-md-3 col-xs-12 pull-right no-padding">
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
            <div class=" col-md-3 col-xs-12 pull-left">
              <select class="form-control top-element filtering" data-archived="0" data-name="availment">
                <option>SELECT PROVIDER</option>
                @foreach($_provider as $provider)
                <option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3 col-xs-12 pull-right">
              <div class="input-group top-element">
                <input type="text" class="form-control search-key">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default searching" data-name="availment" data-archived="0"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </div>
          </div>
          <div id="showTable">
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-bordered">
                <tr>
                  <th class="live-search">APPROVAL #</th>
                  <th class="live-search">UNIVERSAL ID</th>
                  <th class="live-search">CAREWELL ID</th>
                  <th class="live-search">MEMBER NAME</th>
                  <th class="live-search">COMPANY</th>
                  <th class="live-search">PROVIDER</th>
                  <th class="live-search">DATE ISSUED</th>
                  <th class="live-search">ACTION</th>
                </tr>
                @foreach($_approval as $approval)
                <tr>
                  <td>{{$approval->approval_number}}</td>
                  <td>{{$approval->member_universal_id}}</td>
                  <td>{{$approval->member_carewell_id}}</td>
                  <td>{{$approval->member_first_name." ".$approval->member_last_name }}</td>
                  <td>{{$approval->company_name}}</td>
                  <td>{{$approval->provider_name}}</td>
                  <td>{{date("F j, Y",strtotime($approval->approval_created))}}</td>
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
                <th>MEMBER NAME</th>
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