@extends('carewell.layout.layout')
@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-3 col-xs-12 pull-right no-padding">
      <div class="dropdown">
        <button class="btn btn-primary top-element dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-plus btn-icon "></i>CREATE PROVIDER
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <button type="button" class="btn btn-link  create-provider"><i class="fa   fa-pencil-square btn-icon" ></i>CREATE PROVIDER</button>
          <button type="button" class="btn btn-link   import-provider"><i class="fa fa-file-excel-o btn-icon" ></i>IMPORT EXCEL</button>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#activeTab" data-toggle="tab">ACTIVE </a></li>
        <li><a href="#inActiveTab" data-toggle="tab">INACTIVE </a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="activeTab">
          <div class="row">
            <div class="col-md-3 col-xs-12 pull-right">
              <div class="input-group top-element">
                <input type="text" class="form-control search-key">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default searching" data-name="provider" data-archived="0"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </div>
          </div>
          <div id="showTable">
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered">
              <tr>
                <th>PROVIDER NUMBER</th>
                <th>PROVIDER NAME</th>
                <th>DATE ADDED</th>
                <th>ACTION</th>
              </tr>
              @foreach($_provider_active as $provider_active)
              <tr>
                <td>{{sprintf("%05d",$provider_active->provider_id)}}</td>
                <td>{{$provider_active->provider_name}}</td>
                <td>{{date("F j, Y",strtotime($provider_active->provider_created))}}</td>
                <td>
                  <div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                    <li><button type="button" data-provider_id="{{$provider_active->provider_id}}" class="btn btn-link view-provider-details"><i class="fa fa-eye btn-icon"></i>  View Provider</button></li>
                    <li><button type="button" data-id="{{$provider_active->provider_id}}" data-name="PROVIDER" class="btn btn-link archived"><i class="fa fa-trash btn-icon"></i> Archived Provider</button></li>
                  </ul>
                </div>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
          <div class="box-footer clearfix">
            @include('globals.pagination', ['paginator' => $_provider_active])
          </div>
        </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="inActiveTab">
          <div class="row">
            <div class="col-md-3 col-xs-12 pull-right">
              <div class="input-group top-element">
                <input type="text" class="form-control search-key">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default searching" data-name="provider" data-archived="1"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </div>
          </div>
          <div class="box-body table-responsive no-padding">
            <table class="table table-hover table-bordered">
              <tr>
                <th>PROVIDER NUMBER</th>
                <th>PROVIDER NAME</th>
                <th>DATE ADDED</th>
                <th>ACTION</th>
              </tr>
              @foreach($_provider_inactive as $provider_inactive)
              <tr>
                <td>{{sprintf("%05d",$provider_inactive->provider_id)}}</td>
                <td>{{$provider_inactive->provider_name}}</td>
                <td>{{date("F j, Y",strtotime($provider_inactive->provider_created))}}</td>
                <td>
                  <div class="btn-group">
                  <button type="button" class="btn btn-danger">Action</button>
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                  <span class="caret"></span>
                  <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <ul class="dropdown-menu" role="menu" style="position: absolute !important;">
                    <li><button type="button" data-provider_id="{{$provider_inactive->provider_id}}" class="btn btn-link view-provider-details"><i class="fa fa-eye btn-icon"></i>  View Provider</button></li>
                    <li><button type="button" class="btn btn-link restore" data-id="{{$provider_inactive->provider_id}}" data-name="PROVIDER" ><i class="fa fa-undo btn-icon"></i> Restore Provider</button></li>
                  </ul>
                </div>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
          <div class="box-footer clearfix">
            @include('globals.pagination', ['paginator' => $_provider_inactive])
          </div>
        </div>
      </div>
      <!-- /.tab-content -->
    </div>
  </div>
</div>
@endsection