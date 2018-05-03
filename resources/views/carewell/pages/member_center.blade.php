@extends('carewell.layout.layout')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3 col-xs-12 pull-right no-padding">
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
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#activeCompany" data-toggle="tab">ACTIVE </a></li>
        <li><a href="#inActiveCompany" data-toggle="tab">INACTIVE </a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="activeCompany">
          <div class="row">
            <div class=" col-md-3 col-xs-12 pull-left">
              <select class="form-control top-element filtering" data-archived="0" data-name="member">
                <option>SELECT COMPANY</option>
                @foreach($_company as $company)
                <option value="{{$company->company_id}}">{{$company->company_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3 col-xs-12 pull-right">
              <div class="input-group top-element">
                <input type="text" class="form-control search-key">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default searching" data-name="member" data-archived="0"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </div>
          </div>
          <div id="showTable">
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-bordered">
                <tr>
                  <th class="live-search">UNIVERSAL ID</th>
                  <th class="live-search">FULL NAME</th>
                  <th class="live-search">CAREWELL ID</th>
                  <th class="live-search">COMPANY</th>
                  <th class="live-search">DATE ADDED</th>
                  <th class="live-search">ACTION</th>
                </tr>
                @foreach($_member_active as $member_active)
                <tr>
                  <td>{{$member_active->member_universal_id}}</td>
                  <td>{{$member_active->member_first_name}} {{$member_active->member_last_name}}</td>
                  <td>{{$member_active->member_carewell_id}}</td>
                  <td>{{$member_active->company_name}}</td>
                  <td>{{date("F j, Y",strtotime($member_active->member_created))}}</td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-danger">Action</button>
                      <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                        <li><button type="button" data-member_id="{{$member_active->member_id}}" class="btn btn-link view-member-details"><i class="fa fa-eye btn-icon"></i>  View Member</button></li>
                        <li><button type="button" data-id="{{$member_active->member_id}}" data-name="MEMBER" class="btn btn-link archived"><i class="fa fa-trash btn-icon"></i> Archived Member</button></li>
                      </ul>
                    </div>
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
            <div class="box-footer clearfix">
              @include('globals.pagination', ['paginator' => $_member_active])
            </div>
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="inActiveCompany">
          <div class="row">
            <div class="col-md-3 col-xs-12 pull-left">
              <select class="form-control top-element filtering" data-archived="1" data-name="member">
                <option>SELECT COMPANY</option>
                @foreach($_company as $company)
                <option value="{{$company->company_id}}">{{$company->company_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3 col-xs-12 pull-right">
              <div class="input-group top-element">
                <input type="text" class="form-control search-key">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default searching" data-name="member" data-archived="1"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </div>
          </div>
          <div id="showTable">
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover table-bordered">
                <tr>
                  <th>UNIVERSAL ID</th>
                  <th>FULL NAME</th>
                  <th>CAREWELL ID</th>
                  <th>COMPANY</th>
                  <th>DATE ADDED</th>
                  <th>ACTION</th>
                </tr>
                @foreach($_member_inactive as $member_inactive)
                <tr>
                  <td>{{$member_inactive->member_universal_id}}</td>
                  <td>{{$member_inactive->member_first_name}} {{$member_inactive->member_last_name}}</td>
                  <td>{{$member_inactive->member_carewell_id}}</td>
                  <td>{{$member_inactive->company_name}}</td>
                  <td>{{date("F j, Y",strtotime($member_inactive->member_created))}}</td>
                  <td>
                    <div class="btn-group">
                      <button type="button" class="btn btn-danger">Action</button>
                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                      <span class="caret"></span>
                      <span class="sr-only">Toggle Dropdown</span>
                      </button>
                      <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                        <li><button type="button" data-member_id="{{$member_inactive->member_id}}" class="btn btn-link view-member-details"><i class="fa fa-eye btn-icon"></i>  View Member</button></li>
                        <li><button type="button" class="btn btn-link restore" data-id="{{$member_inactive->member_id}}" data-name="MEMBER"><i class="fa fa-trash btn-icon"></i> Restore Member</button></li>
                      </ul>
                    </div>
                  </td>
                </tr>
                @endforeach
              </table>
            </div>
            <div class="box-footer clearfix">
              @include('globals.pagination', ['paginator' => $_member_inactive])
            </div>
          </div>
        </div>
      </div>
      <!-- /.tab-content -->
    </div>
  </div>
</div>
@endsection