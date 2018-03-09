@extends('carewell.layout.layout')
@section('content')
@include('carewell.modals.doctor_center_modals')
<div class="container">
  <div class="row">
    <div class="col-md-3 col-xs-12 pull-right no-padding">
      <div class="dropdown">
        <button class="btn btn-primary top-element dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-plus btn-icon "></i>ADD DOCTOR
        </button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <button type="button" class="btn btn-link  add-doctor"><i class="fa   fa-pencil-square btn-icon" ></i>ADD MANUALLY</button>
          <button type="button" class="btn btn-link   import-doctor"><i class="fa fa-file-excel-o btn-icon" ></i>IMPORT EXCEL</button>
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
              <select class="form-control top-element select2">
                <option>SELECT PROVIDER</option>
                @foreach($_provider as $provider)
                <option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-3 col-xs-12 pull-right">
              <div class="input-group top-element">
                <input type="text" class="form-control " id="search_key">
                <span class="input-group-btn">
                  <button type="button" class="btn btn-default"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </div>
          </div>
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
              @foreach($_doctor_active as $doctor_active)
              <tr>
                <td>{{sprintf("%05d",$doctor_active->doctor_id)}}</td>
                <td>
                  @foreach($doctor_active->provider as  $provider)
                  <span class="label label-default">{{$provider->provider_name}}</span>
                  @endforeach
                </td>
                <td>{{$doctor_active->doctor_first_name}} {{$doctor_active->doctor_last_name}}</td>
                <td>
                  @foreach($doctor_active->specialization as $specialization)
                  <span class="label label-default">{{$specialization->specialization_name}}</span>
                  @endforeach
                </td>
                <td>{{date("F j, Y",strtotime($doctor_active->doctor_created))}}</td>
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
                      <li><button type="button" data-doctor_id="{{$doctor_active->doctor_id}}" class="btn btn-link view-doctor-details"><i class="fa fa-eye btn-icon"></i>  View Doctor</button></li>
                      <li><button type="button" data-id="{{$doctor_active->doctor_id}}" data-name="DOCTOR" class="btn btn-link archived"><i class="fa fa-trash btn-icon"></i> Archived Doctor</button></li>
                    </ul>
                  </div>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
          <div class="box-footer clearfix">
            @include('globals.pagination', ['paginator' => $_doctor_active])
          </div>
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="inActiveCompany">
          <div class="row">
            <div class=" col-md-3 col-xs-12 pull-left">
              <select class="form-control top-element">
                <option>SELECT PROVIDER</option>
                @foreach($_provider as $provider)
                <option value="{{$provider->provider_id}}">{{$provider->provider_name}}</option>
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
                <th>DOCTOR ID</th>
                <th>PROVIDER</th>
                <th>NAME</th>
                <th>SPECIALIZATION</th>
                <th>DATE ADDED</th>
                <th>STATUS</th>
                <th>ACTION</th>
              </tr>
              @foreach($_doctor_inactive as $doctor_inactive)
              <tr>
                <td>{{sprintf("%05d",$doctor_inactive->doctor_id)}}</td>
                <td>
                  @foreach($doctor_inactive->provider as  $provider)
                  <span class="label label-default">{{$provider->provider_name}}</span>
                  @endforeach
                </td>
                <td>{{$doctor_inactive->doctor_first_name}} {{$doctor_inactive->doctor_last_name}}</td>
                <td>
                  @foreach($doctor_inactive->specialization as $specialization)
                  <span class="label label-default">{{$specialization->specialization_name}}</span>
                  @endforeach
                </td>
                <td>{{date("F j, Y",strtotime($doctor_inactive->doctor_created))}}</td>
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
                      <li><button type="button" data-doctor_id="{{$doctor_inactive->doctor_id}}" class="btn btn-link view-doctor-details"><i class="fa fa-eye btn-icon"></i>  View Doctor</button></li>
                      <li><button type="button" data-id="{{$doctor_active->doctor_id}}" data-name="DOCTOR" class="btn btn-link restore"><i class="fa fa-trash btn-icon"></i> Restore Doctor</button></li>
                    </ul>
                  </div>
                </td>
              </tr>
              @endforeach
            </table>
          </div>
          <div class="box-footer clearfix">
            @include('globals.pagination', ['paginator' => $_doctor_inactive])
          </div>
        </div>
      </div>
      <!-- /.tab-content -->
    </div>
  </div>
</div>
@endsection